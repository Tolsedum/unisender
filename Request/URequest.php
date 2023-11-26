<?php

namespace App\Mailing\unisender\Request;

use App\Mailing\unisender\Request\Authorization;
use App\Mailing\unisender\Api\traits\Contacts;
use App\Mailing\unisender\Api\traits\Fields;
use App\Mailing\unisender\Api\traits\Messages;
use App\Mailing\unisender\Api\traits\Notes;
use App\Mailing\unisender\Api\traits\Statistics;
use App\Mailing\unisender\Api\traits\Templates;
use PDO;

class URequest extends Authorization{
    use Contacts;
    use Fields;
    use Messages;
    use Notes;
    use Statistics;
    use Templates;

    public function __construct(string $api_key = "5", string $lang = "ru"){
        parent::__construct($api_key, $lang);
    }

    private function generateParamsToString($params = [], $name_main_field = ""){
        $ret_value = "";
        if(!empty($params)){
            foreach ($params as $key => $value) {
                if(is_array($value)){
                    $ret_value .= $this->generateParamsToString($value, $key);
                }else{
                    if(empty($name_main_field)){
                        $ret_value .= "&" . $key ."=".$value;
                    }else{
                        $ret_value .= "&" . "{$name_main_field}[{$key}]" ."=".$value;
                    }
                }
            }
        }
        return $ret_value;
    }

    private function getRequestUrl($methode, $request_params){
        $url = "https://api.unisender.com/"
            . "{$this->lang}/api/"
            . $methode 
            . "?format=json"
            . "&api_key=" . $this->api_key;
        $url .= $this->generateParamsToString($request_params);
        return $url;
    }

    public function __call($methode, $args){
        if(method_exists($this, $methode)){
            $params = isset($args[0]) ? $args[0] : [];
            $methode_data = $this->{$methode}($args[0]);
            list($field_exist, $field_missing) = $this->checkFields(
                $methode_data["pattern"], $params
            );
            $request_params = $this->formParams(
                $field_exist, $field_missing, $params
            );
            $url = $this->getRequestUrl($methode_data["url"], $request_params);
            return ["url" => $url, "request_params" => []];
        }
        dd($methode, $args);
    }
}