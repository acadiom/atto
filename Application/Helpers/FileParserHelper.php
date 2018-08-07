<?php
namespace Application\Helpers;

class FileParserHelper
{
    /**
     * Filename to parse
     *
     * @var string
     */
    protected $filename;

    /**
     * FileParserHelper construct
     *
     * @param string $filename
     */
    public function __construct($filename)
    {
        if ( ! is_file($filename)) {
            throw new \RuntimeException("The filename [$filename] is invalid.");
        }

        $this->filename = $filename;
    }

    public function parse()
    {
        $contents = file_get_contents($this->filename);
        $lines = explode("\n", $contents);

        $codes = [];
        foreach ($lines as $line) {
            list($acronym, $dataType, $language, $code, $message) = explode(";", $line);

            $i18nCode = [];
            $i18nCode['acronym']  = $acronym;
            $i18nCode['data_type'] = $dataType;
            $i18nCode['language'] = $language;
            $i18nCode['code']     = $code;
            $i18nCode['acronym_code'] = $acronym . '_' . $code;
            $i18nCode['message']  = $message;

            $codes[] = $i18nCode;
        }
        
        return $codes;
    }
}