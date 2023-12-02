<?php
/**
 *  __________________________________________ 
 * |                                          |
 * |   ╭━━━━┳━━━┳╮╱╱╭━━━┳━━━┳━━━┳╮╱╭┳━╮╭━╮    |
 * |   ┃╭╮╭╮┃╭━╮┃┃╱╱┃╭━╮┃╭━━┻╮╭╮┃┃╱┃┃┃╰╯┃┃    |
 * |   ╰╯┃┃╰┫┃╱┃┃┃╱╱┃╰━━┫╰━━╮┃┃┃┃┃╱┃┃╭╮╭╮┃    |
 * |   ╱╱┃┃╱┃┃╱┃┃┃╱╭╋━━╮┃╭━━╯┃┃┃┃┃╱┃┃┃┃┃┃┃    |
 * |   ╱╱┃┃╱┃╰━╯┃╰━╯┃╰━╯┃╰━━┳╯╰╯┃╰━╯┃┃┃┃┃┃    |
 * |   ╱╱╰╯╱╰━━━┻━━━┻━━━┻━━━┻━━━┻━━━┻╯╰╯╰╯    |
 * |__________________________________________|
 * |                                          |
 * | Permission is hereby granted, free of    |
 * | charge, to any person obtaining a copy of|
 * | of this software and accompanying files, |
 * | to use them without restriction,         |
 * | including, without limitation, the       |
 * | rights to use, copy, modify, merge,      |
 * | publish, distribute, sublicense and/or   |
 * | sell copies of the software. The authors |
 * | or copyright holders shall not be liable |
 * | for any claims, damages or other         |
 * | liability, whether in contract, tort or  |
 * | otherwise, arising out of or in          |
 * | connection with the software or your use |
 * | or other dealings with the software.     |
 * |__________________________________________|
 * |   website: tolsedum.ru                   |
 * |   email: tolsedum@gmail.com              |
 * |   email: tolsedum@yandex.ru              |
 * |__________________________________________|
 */

namespace App\Mailing\unisender\Request;

use App\Mailing\IApiRequest;
use App\Mailing\unisender\Api\ApiRequest;
use App\Mailing\unisender\ExceptionUnisender;

class UManager implements IApiRequest{
    /** @var string API access key */
    protected $api_key;
    /** @var string API server message language (currently supported ru, en, ua) */
    protected $lang;
    /** @var bool  */
    protected $compression = false;

    protected ApiRequest $apiRequest;

    public function __construct(
        string $api_key, 
        string $lang = "ru", 
        $compression = false
    ){
        $this->api_key = $api_key;
        $this->lang = $lang;
        $this->compression = $compression;
        $this->apiRequest = new ApiRequest(); 
    }

    /**
     * Get unisender api host
     * @return string
     */
    protected function getApiHost(){
        return sprintf('https://api.unisender.com/%s/api/', $this->lang);
    }

    protected function getRequestUrl($methode){
        $url = $this->getApiHost()
            . $methode 
            . "?format=json";

        if ($this->compression) {
            $url .= '&request_compression=bzip2';
        }else{
            $url .= "&api_key=" . $this->api_key;
        }
        return $url;
    }

    protected function compresData($url, &$request_params){
        if ($this->compression) {
            $request_params = [];
            return $url . "/" .bzcompress(http_build_query($request_params));
        } 
        return $url;
    }

    protected function getReturnParams($params){
        foreach (["method", "url_part", "data", "extra"] as $var) {
            if(isset($params[$var])){
                $$var = $params[$var];
            }else{
                throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS, $var);
            }
        }
        return [
            "method" => $method,
            "url" => $this->compresData(
                $this->getRequestUrl($url_part),
                $data
            ),
            "data" => $data,
            "extra" => $extra
        ];
    }

    /**
     * Получение списка групп контактов
     */
    public function getContactList(array $param = []){
        $request_data = $this->apiRequest->getLists();
        return $this->getReturnParams($request_data);
    }

    /**
     * Добавление новой адресной базы
     * @param array $param = [
     *      string title                 => Название списка. Должно быть уникальным
     *      string before_subscribe_url  => URL для редиректа на страницу «перед подпиской»
     *      string after_subscribe_url   => URL для редиректа на страницу «после подписки»
     * ]
     *      
     */
    public function addContactList(array $param){
        $request_data = $this->apiRequest->createList($param);
        return $this->getReturnParams($request_data);
    }

    /**
     * Обновление контактной информации адресной базы
     * @param array $param = [
     *      int list_id   => Код списка, полученный методом getLists или createList.
     *      string title  => Название списка. Должно быть уникальным
     *      string before_subscribe_url  => URL для редиректа на страницу «перед подпиской»
     *      string after_subscribe_url   => URL для редиректа на страницу «после подписки»
     * ]
     */
    public function updateContactList(array $param){
        $request_data = $this->apiRequest->updateList($param);
        return $this->getReturnParams($request_data);
    }
}