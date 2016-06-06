<?php
namespace TranslateApi;


class TranslateYandex extends TranslateAbstract
{
    /**
     * Link translate, response result json
     */
    const LINK_TRANSLATE_JSON = 'https://translate.yandex.net/api/v1.5/tr.json/translate';

    /**
     * Create url to translate
     * @return string
     */
    public function createLinkTranslate()
    {
        switch($this->getResponseType()) {
            case self::RESPONSE_TYPE_JSON:
                break;
            case self::RESPONSE_TYPE_XML:
                break;
            default:
                break;
        }
    }
}