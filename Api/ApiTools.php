<?php

namespace App\Mailing\unisender\Api;

use App\Mailing\unisender\ExceptionUnisender;

class ApiTools{
    protected function checkFields(array $pattern, array $params){
        $field_exist = [];
        $field_missing = [];
        if(!empty($pattern)){
            foreach ($pattern as $field => $compulsory) {
                if(isset($params[$field])){
                    $field_exist[$field] = $compulsory;
                }else{
                    $field_missing[$field] = $compulsory;
                }
            }
        }
        return [$field_exist, $field_missing];
    }

    protected function formParams($field_exist, $field_missing, $params){
        foreach ($field_missing as $field => $compulsory){
            if($compulsory){
                throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS, $field);
            }
        }
        $request_params = [];
        foreach ($field_exist as $var => $compulsory) {
            $request_params[$var] = $params[$var];
        }
        return $request_params;
    }
}