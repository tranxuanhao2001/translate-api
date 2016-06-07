<?php
namespace TranslateApi;

abstract class TranslateAbstract
{
    /**
     * Key to connect with provider
     * @var string
     */
    private $apiKey = '';

    /**
     * @var array Container all query string
     */
    private $options = [];

    /**
     * Constructor
     * @param $apiKey
     */
    public function __construct($apiKey) {
        $this->setApiKey($apiKey);
    }

    /**
     * Set api key
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;

        return $this;
    }
    /**
     * Get api key
     * @return string
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * Set option
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOption($key, $value) {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * Get option
     * @param $key
     * @return mixed
     */
    public function getOption($key) {
        return $this->options[$key];
    }

    /**
     * Set options
     * @param array $opts
     * @return $this
     */
    public function setOptions($opts = array()) {
        foreach($opts as $key => $value) {
            $this->setOption($key, $value);
        }

        return $this;
    }

    /**
     * Get options
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * Translate
     * @param string $text
     * @param string $source
     * @param string $target
     * @param array $options
     * @return mixed
     */
    abstract public function translate($text, $source, $target, $options = []);
}