<?php
namespace TranslateApi;


class TranslateYandex extends TranslateAbstract
{
    /**
     * Link translate, response result json
     */
    const LINK_TRANSLATE_JSON = 'https://translate.yandex.net/api/v1.5/tr.json/translate';

    /**
     * Create query string
     * @return string
     */
    public function createQueryString($text, $source, $target, $options)
    {
        $opts = array_merge($this->getOptions(), $options);
        $textOpt = ['text' => $text];
        $langOpt = ['lang' => implode('-', [$source, $target])];
        $apiKey = ['key' => $this->getApiKey()];

        $queryStringData = array_merge($opts, $textOpt, $langOpt, $apiKey);

        return http_build_query(array_filter($queryStringData));
    }

    /**
     * Translate
     * @param string $text
     * @param string $source
     * @param string $target
     * @param array $options
     * @return mixed
     */
    public function translate($text, $source, $target, $options = [])
    {
        $queryString = $this->createQueryString($text, $source, $target, $options);

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, self::LINK_TRANSLATE_JSON);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);

        $output = curl_exec($ch);
        if($output === false) {
            return new ResponseObject(false, [], curl_error($ch));
        }

        return new ResponseObject(true, $output, null);

    }
}