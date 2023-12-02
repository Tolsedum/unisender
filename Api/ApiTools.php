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

use App\Mailing\unisender\ExceptionUnisender;

/**
 * Различние инструменты для работы с данными
 * @author Tolsedum
 */
class ApiTools{
    public function is_not_empty(mixed $param){
        if(empty($param) 
            && !is_bool($param)
            && !is_numeric($param)
        ){
            return false;
        }
        return true;
    }

    public function checkFields(array $pattern, array $params){
        $field_exist = [];
        $field_missing = [];
        if(!empty($pattern)){
            foreach ($pattern as $field => $compulsory) {
                if($this->is_not_empty($params[$field])){
                    $field_exist[$field] = $compulsory;
                }else{
                    $field_missing[$field] = $compulsory;
                }
            }
        }
        return [$field_exist, $field_missing];
    }

    public function formParams($field_exist, $field_missing, $params){
        foreach ($field_missing as $field => $compulsory){
            if($compulsory){
                throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS, $field);
            }
        }
        $request_params = [];
        foreach ($field_exist as $var => $compulsory) {
            if($this->is_not_empty($params[$var])){
                $request_params[$var] = $params[$var];
            }
        }
        return $request_params;
    }
}