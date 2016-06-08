<?php
namespace TranslateApi;

class TranslateYandex extends TranslateAbstract
{
    /**
     * Link translate, response result json
     */
    const BASE_URL = 'https://translate.yandex.net/api/v1.5/tr.json/';

    /**
     * Code success
     */
    const CODE_SUCCESS = 200;

    const NAME_PROVIDER = 'Yandex';


    private $errorMessage = [
        '401' => 'Invalid API key',
        '402' => 'Blocked API key',
        '404' => 'Exceeded the daily limit on the amount of translated text',
        '413' => 'Exceeded the maximum text size',
        '422' => 'The text cannot be translated',
        '501' => 'The specified translation direction is not supported'
    ];

    /**
     * Create query string
     * @return string
     */
    private function createQueryString($text, $source, $target, $options)
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
        $resultObject = $this->execute('translate', [
            'text' => $text,
            'lang' => implode('-', [$source, $target]),
            'format' => isset($options['format']) ? $options['format'] : 'plain'
        ]);

        if($resultObject->status) {
            $data = $resultObject->data;

            $resultObject->data = isset($data['text']) ? $data['text'][0] : '';
        }

        return (array)$resultObject;
    }

    /**
     * Detact language the text
     * @param string $text
     * @param array $options
     * @return mixed
     */
    public function detect($text, $options = [])
    {
        $resultObject = $this->execute('detect', [
            'text' => $text
        ]);

        if($resultObject->status) {
            $data = $resultObject->data;

            $resultObject->data = isset($data['lang']) ? $data['lang'] : '';
        }

        return (array)$resultObject;
    }

    /**
     * Get all supported languages
     * @param array $options [
     *      'ui' => ''
     * ]
     * @return mixed
     */
    public function getSupportedLanguages($options = [])
    {
        $resultObject = $this->execute('getLangs', [
            'ui' => isset($options['ui']) ? $options['ui'] : ''
        ]);

        if($resultObject->status) {
            $data = $resultObject->data;

            $resultObject->data = isset($data['langs']) ? $data['langs'] : '';
        }

        return (array)$resultObject;
    }

    /**
     * Execute url
     * @param string $url
     * @param array $parameters
     * @return ResponseObject
     */
    private function execute($url, $parameters = []) {
        try {
            // Create url
            $parameters['key'] = $this->getApiKey();
            $url = self::BASE_URL . $url .'?' . http_build_query(array_filter($parameters));

            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_URL, $url);

            $output = curl_exec($ch);

            if($output === false) {
                return new ResponseObject(false, null, curl_error($ch));
            }
            // close curl resource to free up system resources
            curl_close($ch);

            // Parse to array
            $result = json_decode($output, true);
            if(!$result) {
                return new ResponseObject(false, null, json_last_error_msg());
            }

            $code = isset($result['code']) ? $result['code'] : null;
            // Response invalid
            if($code && $code != self::CODE_SUCCESS) {
                return new ResponseObject(false, null, $this->errorMessage[$code]);
            }

            return new ResponseObject(true, $result, null);
        } catch(\Exception $e) {
            return new ResponseObject(false, null, $e->getMessage());
        }
    }


}