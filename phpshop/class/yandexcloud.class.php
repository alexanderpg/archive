<?php

/*
 * Библиотека работы с YandexGPT API
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 * @todo https://yandex.cloud/ru/docs/foundation-models/concepts/yandexgpt/models
 * @todo https://yandex.cloud/ru/docs/foundation-models/text-generation/api-ref/TextGeneration/completion
 */

class YandexGPT {

    const TextGeneration = "https://llm.api.cloud.yandex.net/foundationModels/v1/completion";
    const GET_TOKEN = 'https://iam.api.cloud.yandex.net/iam/v1/tokens';

    function __construct() {
        $this->PHPShopSystem = new PHPShopSystem();

        $this->TOKEN = $this->PHPShopSystem->getSerilizeParam('ai.yandexgpt_token');
        $this->FOLDER = $this->PHPShopSystem->getSerilizeParam('ai.yandexgpt_id');
        $this->API_URL = $this->PHPShopSystem->getSerilizeParam('ai.yandexgpt_model');
    }

    public function html($text) {
        if (class_exists('Parsedown')) {
            $Parsedown = new Parsedown();
            $text = $Parsedown->text($text);
        }
        return $text;
    }

    public function text($user, $system, $temperature = "0.3", $maxTokens = 1000) {

        $params = [
            "modelUri" => 'gpt://' . $this->FOLDER . '/' . $this->API_URL,
            "completionOptions" => [
                "stream" => false,
                "temperature" => (float) $temperature,
                "maxTokens" => (int) $maxTokens
            ],
            "messages" => [
                [
                    "role" => "user",
                    "text" => (string) PHPShopString::win_utf8($user)
                ],
                [
                    "role" => "system",
                    "text" => (string) PHPShopString::win_utf8($system)
                ],
            ]
        ];

        $result = $this->request(self::TextGeneration, $params);
        return $result;
    }

    private function getIAM() {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => self::GET_TOKEN,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode(["yandexPassportOauthToken" => $this->TOKEN]),
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    private function request($url, $data = []) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $this->getIAM()['iamToken'],
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

}

/*
 * Библиотека работы с Yandex Search API
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 * @todo https://yandex.cloud/ru/docs/search-api/concepts/response#response-format
 * @todo https://rookee.ru/blog/yazyk-zaprosov-yandex/
 */

class YandexSearch {

    const API_URL = 'https://yandex.ru/search/xml';

    function __construct() {
        $this->PHPShopSystem = new PHPShopSystem();

        $this->TOKEN = $this->PHPShopSystem->getSerilizeParam('ai.yandexsearch_token');
        $this->FOLDER = $this->PHPShopSystem->getSerilizeParam('ai.yandexgpt_id');
    }

    private function request($text) {
        $query = '<?xml version="1.0" encoding="UTF-8"?>
<request>
  <query>' . $text . '</query>
  <sortby order="descending">rlv</sortby>
  <maxpassages>1</maxpassages>
  <page>0</page>
  <groupings>
    <groupby attr="d" mode="deep" groups-on-page="1" docs-in-group="1" />
  </groupings>
</request>';

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => self::API_URL . '?folderid=' . $this->FOLDER . '&apikey=' . $this->TOKEN . '&filter=strict&l10n=ru',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_POSTFIELDS => $query,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $this->TOKEN,
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function search($text) {
        $response = $this->request($text);
        $xml = simplexml_load_string($response);

        if (!empty($xml->response[0]->results[0]->grouping[0]->group)) {
            foreach ($xml->response[0]->results[0]->grouping[0]->group as $item) {
                $result[] = ['title' => (string) $item->doc[0]->title, 'url' => (string) $item->doc[0]->url];
            }

            return $result;
        }
    }

}