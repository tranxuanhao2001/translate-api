<?php
namespace TranslateApi;

class Translate
{
    private $provider;

    public function __construct(TranslateAbstract $provider) {
        $this->provider = $provider;
    }

    /**
     * Translate
     * @param string $text
     * @param string $source
     * @param string $target
     * @param array $options
     * @return mixed
     */
    public function translate($text, $source, $target, $options = []) {
        return $this->provider->translate($text, $source, $target, $options);
    }

    /**
     * Detact language the text
     * @param string $text
     * @param array $options
     * @return mixed
     */
    public function detect($text, $options = []) {
        return $this->provider->detect($text, $options);
    }

    /**
     * Get all supported languages
     * @param array $options [
     *      'ui' => ''
     * ]
     * @return mixed
     */
    public function getSupportedLanguages($options = []) {
        return $this->provider->getSupportedLanguages($options);
    }
}