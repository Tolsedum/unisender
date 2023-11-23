<?php

namespace App\Mailing\Unisender\Api;

class ParamsCheck{
    protected function checkFields(array $pattern, array $params){
        $field_exist = [];
        $field_missing = [];
        if(!empty($pattern)){
            foreach ($pattern as $field) {
                if(isset($params[$field])){
                    $field_exist[$field] = $field;
                }else{
                    $field_missing[$field] = $field;
                }
            }
        }
        return [$field_exist, $field_missing];
    }
}