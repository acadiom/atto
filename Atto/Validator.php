<?php
namespace Atto;

/**
 * Class Validator
 *
 * Available validators
 *  - length:min,max
 *  - numeric
 *  - lessThan:value
 *  - greaterThan:value
 *  - between:min,max
 *  - required
 *  - email
 *  - minimum:length
 *  - maximum:length
 *  - regex:regex
 *  - match:fieldname
 *  - notMatch:fieldname
 *  - notEqual:value
 *  - equal:value
 *  - date
 *
 * @package Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Validator implements \ArrayAccess
{

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules;

    /**
     * Data to be validated
     *
     * @var array
     */
    protected $data;

    /**
     * The list of messages for the current input validation
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Validator constructor.
     *
     * @param array $rules
     */
    public function __construct(array $rules = [])
    {
        $this->rules = $rules;
    }

    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->rules[] = $value;
        } else {
            $this->rules[$offset] = $value;
        }
    }

    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists($offset)
    {
        return isset($this->rules[$offset]);
    }

    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        unset($this->rules[$offset]);
    }

    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet($offset)
    {
        return isset($this->rules[$offset]) ? $this->rules[$offset] : null;
    }

    /**
     * Returns the message for a field
     *
     * @param $field string The field name
     *
     * @return array|string The message if exists or an empty array
     */
    public function getMessagesFor($field)
    {
        if ($this->hasErrors($field)) {
            return $this->messages[$field];
        }

        return [];
    }

    /**
     * Returns the first message for a field name or empty string if does not exist
     *
     * @param $field string Field name
     *
     * @return string
     */
    public function getFirstMessageFor($field)
    {
        if ( ! $this->hasErrors($field)) {
            return '';
        }

        if (is_array($this->messages[$field])) {
            return $this->messages[$field][0];
        }

        return $this->messages[$field];
    }

    /**
     * Indicates if a field is erroneous
     *
     * @param $field string The field name
     *
     * @return bool
     */
    public function hasErrors($field)
    {
        return isset($this->messages[$field]);
    }

    /**
     * Returns the messages from the current validation
     *
     * @return array
     */
    public function getMessages()
    {
        $results = [];

        foreach ($this->messages as $message) {
            if (is_array($message)) {
                $results = array_merge($results, $message);
            } else {
                $results[] = $message;
            }
        }

        return $results;
    }

    /**
     * Negates the valid() method
     *
     * @param $data array Usually $_POST variable or any array can be validated
     *
     * @return bool
     */
    public function invalid($data)
    {
        return ! $this->valid($data);
    }

    /**
     * Validates the input data
     *
     * @param $data array Usually $_POST variable or any array can be validated
     *
     * @return bool
     */
    public function valid($data)
    {
        // Store data variable
        $this->data = $data;

        // Prepare all validators
        foreach ($this->rules as $name => $attributes) {
            $this->callValidators($attributes, $name);
        }

        return count($this->messages) === 0;
    }

    /**
     * Calls all validators and stores all messages
     *
     * @param $attributes
     * @param $name
     */
    protected function callValidators($attributes, $name)
    {
        $validators  = $attributes['validate'];
        $message     = $attributes['message'];
        $expressions = explode('|', $validators);

        $count = count($expressions);

        for ($i = 0; $i < $count; $i++) {
            if ( ! $this->callValidator($expressions[$i], $name)) {
                $this->storeMessage($name, $i, $message);
            }
        }
    }

    /**
     * Stores a message
     *
     * @param $name     string Name of the field that failed to validate
     * @param $index    int The index of the validator (starts in "0")
     * @param $messages string|array Message or messages in case of failure
     *
     * @throws \Exception
     */
    protected function storeMessage($name, $index, $messages)
    {
        if (is_string($messages)) {
            $this->messages[$name] = $messages;
        } else if (is_array($messages) && isset($messages[$index])) {
            $this->messages[$name][] = $messages[$index];
        } else {
            throw new \Exception("No message set for validating field [$name]", 3010);
        }
    }

    /**
     * Parses the callback indicated by the user and creates the format for the validator
     *
     * @param $expression string User declared validator min:50, required etc ...
     * @param $name
     *
     * @return bool
     * @throws \Exception
     */
    protected function callValidator($expression, $name)
    {
        // Check for a valid expression and store the results
        if (false === preg_match('/^([a-zA-Z0-9]+)(:(.+))?$/', $expression, $matches)) {
            throw new \Exception(__CLASS__ . " The expression [$expression] is not valid!", 3001);
        }

        if ( ! isset($matches[1])) {
            throw new \Exception(__CLASS__ . " The expression [$expression] is not valid!", 3002);
        }

        // Callback method and value (first parameter)
        $callback   = 'validate' . ucfirst($matches[1]);
        $value      = $this->getValue($name);
        $parameters = [$value];

        // Set validator callback parameters
        if (isset($matches[3])) {
            $parameters = array_merge($parameters, $this->getParameters($matches[3]));
        }

        // The callback function must exist
        if ( ! is_callable([$this, $callback])) {
            throw new \Exception(__CLASS__ . " The method [$callback] does not exists, please implement it before use it.", 3003);
        }

        return (boolean) call_user_func_array([$this, $callback], $parameters);
    }

    /**
     * Returns the parameters of the validator.
     * For example if you define a validation for length:10,2000 this method will return: [10, 2000]
     *
     * @param $parameters string The parameters defined for the validator
     *
     * @return array Parameters in array format
     */
    protected function getParameters($parameters)
    {
        return explode(',', $parameters);
    }

    /**
     * Returns the value of field
     *
     * @param $name string Field name
     *
     * @return null|string
     */
    protected function getValue($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    /**
     * Validates if the value has a length between $min and $max
     * Usage 'length:5,50'
     *
     * @param $value string The value that needs to be validated
     * @param $min int The minimum length
     * @param $max int The maximum length
     *
     * @return bool
     */
    protected function validateLength($value, $min, $max)
    {
        if ($value === null) {
            return false;
        }

        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * Indicates if the value is numeric
     *     Usage 'numeric'
     *
     * @param $value string The value that needs to be validated
     *
     * @return bool
     */
    protected function validateNumeric($value)
    {
        if ($value === null) {
            return false;
        }

        $value = trim($value);

        return is_numeric($value);
    }

    /**
     * Indicates if the value is less than number
     *     Usage 'lessThan:45'
     *
     * @param $value number The value that needs to be validated
     * @param $number number The number to compare to
     *
     * @return bool
     */
    protected function validateLessThan($value, $number)
    {
        if ($value === null || ! is_numeric($value)) {
            return false;
        }

        if (is_float($value)) {
            return floatval($value) < floatval($number);
        }

        // If we get here the value must be an integer
        return intval($value) < intval($number);
    }

    /**
     * Indicates if the value is greater than number
     *     Usage 'greaterThan:100'
     *
     * @param $value number The value that needs to be validated
     * @param $number number The number to compare to
     *
     * @return bool
     */
    protected function validateGreaterThan($value, $number)
    {
        if ($value === null || ! is_numeric($value)) {
            return false;
        }

        if (is_float($value)) {
            return floatval($value) > floatval($number);
        }

        // If we get here the value must be an integer
        return intval($value) > intval($number);
    }

    /**
     * Indicates if the value is between min and max
     *     Usage 'between:45,1000'
     *
     * @param $value number The value that needs to be validated
     * @param $from  number The number to compare to
     * @param $to    number The number to compare to
     *
     * @return bool
     */
    protected function validateBetween($value, $from, $to)
    {
        if ($value === null || ! is_numeric($value)) {
            return false;
        }

        $value = is_float($value) ? floatval($value) : intval($value);
        $from  = is_float($value) ? floatval($from)  : intval($from);
        $to    = is_float($value) ? floatval($to)    : intval($to);

        return $value >= $to && $value <= $to;
    }

    /**
     * Indicates if the value is empty or not
     *     Usage 'required'
     *
     * @param $value string The value that needs to be validated
     *
     * @return bool
     */
    protected function validateRequired($value)
    {
        if ($value === null) {
            return false;
        }

        if (is_array($value)) {
            return count($value) > 0;
        }

        return strlen(trim($value)) > 0;
    }

    /**
     * Indicates if the value is a valid email
     *     Usage 'email'
     *
     * @param $value string The value to be validated
     *
     * @return bool
     */
    protected function validateEmail($value)
    {
        if ($value === null) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validates a minimum length
     *     Usage 'minimum:5'
     *
     * @param $value string The value to be validated
     * @param $length int Minimum length
     *
     * @return bool
     */
    protected function validateMinimum($value, $length)
    {
        if ($value === null) {
            return false;
        }

        return strlen($value) >= $length;
    }

    /**
     * Validates a maximum length
     *     Usage 'maximum:2000'
     *
     * @param $value string The value to be validated
     * @param $length int Maximum length
     *
     * @return bool
     */
    protected function validateMaximum($value, $length)
    {
        if ($value === null) {
            return false;
        }

        return strlen($value) <= $length;
    }

    /**
     * Validates a regular expression
     *     Usage 'regex:/^[a-zA-Z0-9]+$/'
     *
     * Note* there are limitations, you cannot use pipe or comma in you're regex
     *
     * @param $value string The value to be validated
     * @param $expression string Regular expression
     *
     * @return bool
     */
    protected function validateRegex($value, $expression)
    {
        if ($value === null) {
            return false;
        }

        return preg_match($expression, $value);
    }

    /**
     * Validates that the value is equal to the field (have same values)
     *     Usage 'match:confirmed'
     *
     * @param $value string The value to be validated
     * @param $fields array Fields name used to compare to
     *
     * @return bool
     */
    protected function validateMatch($value, ...$fields)
    {
        if ($value === null) {
            return false;
        }

        foreach ($fields as $field) {
            if ($value !== $this->getValue($field)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validates that the value is NOT equal to the field(s)
     *     Usage 'notMatch:userName,firstName,lastName'
     *
     * @param $value string The value to be validated
     * @param $fields array Field name used to compare to
     *
     * @return bool
     */
    protected function validateNotMatch($value, ...$fields)
    {
        if ($value === null) {
            return false;
        }

        foreach ($fields as $field) {
            if ($value === $this->getValue($field)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validates that the value is not equal to any element in the $to array
     *     Usage 'notEqual:10,20,30,40,50,60'
     *
     * @param $value string The value to be validated
     * @param $to array List of values
     *
     * @return bool
     */
    protected function validateNotEqual($value, ...$to)
    {
        if ($value === null) {
            return false;
        }

        return ! in_array($value, $to);
    }

    /**
     * Validates that the field is equal to at least one element in the array
     *     Usage 'equal:male,female'
     *
     * @param $value string The value to be validated
     * @param $to array List of values
     *
     * @return bool
     */
    protected function validateEqual($value, ...$to)
    {
        if ($value === null) {
            return false;
        }

        return in_array($value, $to);
    }

    /**
     * Validates that the field has a date format and is a real date
     *     Usage: 'date:yyyy-mm-dd'
     *
     * @param      $value
     * @param null $format
     *
     * @return bool
     */
    protected function validateDate($value, $format = null)
    {
        if ($value === null) {
            return false;
        }

        // Validate format yyyy-mm-dd
        $date = \DateTime::createFromFormat($format, $value);

        return $date && $date->format($format) == $value;
    }
}
