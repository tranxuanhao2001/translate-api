<?php
namespace TranslateApi;

class Translate
{
    /**
     * @param string $provider
     * @return TranslateAbstract
     */
    public static function factory($provider) {
        $translate = null;
        switch($provider) {
            case TranslateYandex::NAME_PROVIDER:
                $translate = new TranslateYandex();
                break;
            default:
                $translate = new TranslateYandex();
                break;
        }

        return $translate;
    }
}