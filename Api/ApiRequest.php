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

namespace App\Mailing\unisender\Api;

use App\Mailing\unisender\Api\traits\Contacts;
use App\Mailing\unisender\Api\traits\Fields;
use App\Mailing\unisender\Api\traits\Messages;
use App\Mailing\unisender\Api\traits\Notes;
use App\Mailing\unisender\Api\traits\Statistics;
use App\Mailing\unisender\Api\traits\Templates;
use App\Mailing\unisender\Api\ApiTools;
use App\Mailing\unisender\ExceptionUnisender;

/**
 * Объеденяет в себе все traits, для разделения логики (чтобы не одной партянкой)
 * @author Tolsedum
 */
class ApiRequest extends ApiTools{
    use Contacts;
    use Fields;
    use Messages;
    use Notes;
    use Statistics;
    use Templates;


    public function __call($methode, $args){
        if(method_exists($this, $methode)){
            $params = isset($args[0]) ? $args[0] : [];
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
                    "headers" => [
                        "Content-type: application/x-www-form-urlencoded"
                    ],
                ],
            ];
        }else{
            throw new ExceptionUnisender(ExceptionUnisender::METHOD_IS_NOT_EXISTS);
        }
    }
}