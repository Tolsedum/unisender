<?php

namespace App\Mailing\unisender\Request;

use App\Mailing\unisender\Request\Authorization;
use App\Mailing\unisender\Api\traits\Contacts;
use App\Mailing\unisender\Api\traits\Fields;
use App\Mailing\unisender\Api\traits\Messages;
use App\Mailing\unisender\Api\traits\Notes;
use App\Mailing\unisender\Api\traits\Statistics;
use App\Mailing\unisender\Api\traits\Templates;

class URequest extends Authorization{
    use Contacts;
    use Fields;
    use Messages;
    use Notes;
    use Statistics;
    use Templates;

    public function __construct(string $api_key, string $lang = "ru"){
        parent::__construct($api_key, $lang);
    }

    private function recursiveForString($params, $name_field = ""){
        static $iter = 0;
        $ret_value = "";
        if(!empty($params)){
            foreach ($params as $key => $value) {
                if(is_array($value)){
                    $iter++;
                    $ret_value .= $this->recursiveForString($value, $key);
                    $iter--;
                    if($iter == 0){
                        $ret_value = "&{$name_field}" . $ret_value;
                        
                    }else{
                        $ret_value = "[{$key}]" . $ret_value;
                    }
                }else{
                    if($iter == 0){
                        $ret_value .= "&{$name_field}[{$key}]" . "=" . $value;
                    }else{
                        $ret_value .= "[{$key}]" . "=" . $value;
                    }
                }
            }
        }
        return $ret_value;
    }
    
    private function generateParamsToString($params = []){
        $ret_value = "";
        if(!empty($params)){
            foreach ($params as $name_main_field => $value) {
                if(is_array($value)){
                    $ret_value .=  $this->recursiveForString(
                        $value, $name_main_field
                    );
                }else{
                    $ret_value .= "&" . $name_main_field ."=".$value;
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
    }
}