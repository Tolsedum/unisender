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
namespace App\Mailing\unisender\Api\traits;

use App\Mailing\unisender\ExceptionUnisender;

/**
 * Работа с дополнительными полями и метками
 * @author Tolsedum
 */
trait Fields{
    /**
     *  Получить список пользовательских полей;
     * @link https://www.unisender.com/ru/support/api/inputs/getfields/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * ]
     */
    protected function getFields($params = []){
        return [
            "pattern" => [],
            "url" => "getFields"
        ];
    }
    /**
     *  Создать новое поле
     * @link https://www.unisender.com/ru/support/api/inputs/createfield/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string name => Переменная для подстановки. Должно быть уникальным с 
     *      учётом регистра.
     *      
     * ]
     */
    protected function createField($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "name" => true,

            ], 
            "url" => "",
        ];
    }
    /**
     *  Изменить параметры поля;
     * @link https://www.unisender.com/ru/support/api/inputs/updatefield/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      type        => Тип поля. FieldType
     *      public_name => Название поля. Если не использовать, то будет 
     *                     проведена автоматическая генерация по полю "name".
     * ]
     */
    protected function updateField($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "type" => true,
                "public_name" => false,
            ], 
            "url" => "updateField",
        ];
    }
    /**
     *  Удалить поле
     * @link https://www.unisender.com/ru/support/api/inputs/deletefield/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     *      
     *      id => Код поля, возвращённый методом createField.
     * ]
     */
    protected function deleteField($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "id" => true,
            ], 
            "url" => "deleteField",
        ];
    }
    /**
     * Получить список пользовательских меток;
     * @link https://www.unisender.com/ru/support/api/inputs/gettags/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     * ]
     */
    protected function getTags($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
            ], 
            "url" => "getTags",
        ];
    }
    /**
     * Удалить метку.
     * @link https://www.unisender.com/ru/support/api/inputs/deletetag/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      id => Код одной из меток, возвращённый методом getTags.
     * ]
     */
    protected function  deleteTag($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "id" => true,
            ], 
            "url" => "deleteTag",
        ];
    }
}