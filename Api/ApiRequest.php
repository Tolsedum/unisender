<?php

namespace App\Mailing\unisender\Api;

use App\Mailing\unisender\Api\traits\Contacts;
use App\Mailing\unisender\Api\traits\Fields;
use App\Mailing\unisender\Api\traits\Messages;
use App\Mailing\unisender\Api\traits\Notes;
use App\Mailing\unisender\Api\traits\Statistics;
use App\Mailing\unisender\Api\traits\Templates;
use App\Mailing\unisender\Api\ApiTools;

class ApiRequest extends ApiTools{
    use Contacts;
    use Fields;
    use Messages;
    use Notes;
    use Statistics;
    use Templates;


    public function __call($methode, $args){
        $params = isset($args[0]) ? $args[0] : [];
        if($methode !== "compresData"){
            $methode_data = $this->{$methode}($params);
            list($field_exist, $field_missing) = $this->checkFields(
                $methode_data["pattern"], $params
            );
            $request_params = $this->formParams(
                $field_exist, $field_missing, $params
            );
            
            return [
                'method' => 'post',
                "url_part" => $methode_data["url"],
                "data" =>  $request_params,
                "extra" => [
                    "header" => "Content-type: application/x-www-form-urlencoded",
                ],
            ];
        }
    }
}