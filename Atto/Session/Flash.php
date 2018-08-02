<?php
/* ===========================================================================
 * Copyright 2013-2016 The Opis Project
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */
namespace Atto\Session;

class Flash {
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $session;

    /**
     * Flash constructor.
     *
     * @param array $session
     */
    public function __construct(array $session = []) {
        $this->session = $session;
    }

    /**
     * Stores a value
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return Flash
     */
    public function set($key, $value): self {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * Retrieve a value
     *
     * @param   string $key     Key
     * @param   mixed  $default (optional)  Default value
     *
     * @return  mixed
     */
    public function get($key, $default = null) {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return $this->session[$key] ?? $default;
    }

    /**
     * Retrieve the value associated with the specified key or associate
     * the specified key with the value returned by invoking the callback.
     *
     * @param   string   $key      Key
     * @param   callable $callback Callback
     *
     * @return  mixed
     */
    public function load($key, callable $callback) {
        if ( ! $this->has($key)) {
            $this->set($key, $callback($key));
        }

        return $this->get($key);
    }

    /**
     * Removes specified key
     *
     * @param $key
     *
     * @return Flash
     */
    public function delete($key): self {
        unset($this->data[$key]);

        return $this;
    }

    /**
     * Check if a key exists
     *
     * @param $key
     *
     * @return bool
     */
    public function has($key) {
        return isset($this->data[$key]) || isset($this->session[$key]);
    }

    /**
     * Clear or replace data
     *
     * @access  public
     *
     * @param   array $data (optional) Data
     *
     * @return  Flash
     */
    public function clear(array $data = []): self {
        $this->data = $data;
        $this->session = [];

        return $this;
    }

    /**
     * Reflash data
     *
     * @param   array $keys (optional) Data
     *
     * @return  Flash
     */
    public function reflash(array $keys = []): self {
        $data = empty($keys) ? $this->session : array_intersect_key($this->session, array_flip($keys));

        return $this->clear($data);
    }

    /**
     * Return saved data
     *
     * @return  array
     */
    public function toArray(): array {
        return $this->data;
    }
}
