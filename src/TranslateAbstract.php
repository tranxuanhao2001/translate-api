<?php
namespace TranslateApi;

abstract class TranslateAbstract
{
    const API_KEY = 'key';
    const API_SOURCE = 'source';
    const API_TARGET = 'target';
    const API_TEXT = 'text';
    const API_RESPONSE_TYPE = 'responseType';

    const RESPONSE_TYPE_JSON = 'json';
    const RESPONSE_TYPE_XML = 'xml';

    /**
     * @var array Container all query string
     */
    public $options = [];

    /**
     * Constructor
     * @param array $opts
     */
    public function __construct($opts = array()) {
        $this->setOptions($opts);
    }

    /**
     * Set api key
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey) {
        $this->setOption(self::API_KEY, $apiKey);

        return $this;
    }
    /**
     * Get api key
     * @return string
     */
    public function getApiKey() {
        return $this->getOption(self::API_KEY);
    }

    /**
     * Set source translate
     * @param string $source
     * @return $this
     */
    public function setSource($source) {
        $this->setOption(self::API_SOURCE, $source);

        return $this;
    }
    /**
     * Get source translate
     * @return string
     */
    public function getSource() {
        return $this->getOption(self::API_SOURCE);
    }

    /**
     * Set target translate
     * @param string $target
     * @return $this
     */
    public function setTarget($target) {
        $this->setOption(self::API_TARGET, $target);

        return $this;
    }
    /**
     * Get target translate
     * @return string
     */
    public function getTarget() {
        return $this->getOption(self::API_TARGET);
    }

    /**
     * Set text translate
     * @param string $text
     * @return $this
     */
    public function setText($text) {
        $this->setOption(self::API_TEXT, $text);

        return $this;
    }
    /**
     * Set text translate
     * @return string
     */
    public function getText() {
        return $this->getOption(self::API_TEXT);
    }

    /**
     * Set response type
     * @param string $responseType
     * @return $this
     */
    public function setResponseType($responseType) {
        $this->setOption(self::API_RESPONSE_TYPE, $responseType);

        return $this;
    }

    /**
     * Get response type
     * @return string
     */
    public function getResponseType() {
        $responseType = $this->getOption(self::API_RESPONSE_TYPE);
        if(!$responseType) {
            $responseType = self::RESPONSE_TYPE_JSON;
        }

        return $responseType;
    }

    public function setOption($key, $value) {
        $this->options[$key] = $value;

        return $this;
    }

    public function getOption($key) {
        return $this->options[$key];
    }

    public function setOptions($opts = array()) {
        foreach($opts as $key => $value) {
            $this->setOption($key, $value);
        }

        return $this;
    }

    public function getOptions() {
        return $this->options;
    }

    /**
     * Create url to translate
     * @return string
     */
    abstract public function createLinkTranslate();
}