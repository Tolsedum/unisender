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
 * Работа с шаблонами
 * @author Tolsedum
 */
trait Templates{
    /**
     * Создать шаблон сообщения для массовой рассылки;
     * @link https://www.unisender.com/ru/support/api/templates/createemailtemplate/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string title       => Название шаблона.
     *      string subject     => Строка с темой письма. Может включать поля подстановки.
     *      string body        => Текст шаблона письма в формате HTML с возможностью добавлять 
     *                            поля подстановки.
     *      string description => Текстовое описание шаблона, которое в дальнейшем можно будет 
     *                            получить при вызове этого шаблона.
     *      string text_body   => Текстовый вариант шаблона письма.
     *      string lang        => Двухбуквенный код языка для автоматически добавляемой в каждое 
     *                            письмо строки со ссылкой отписки.
     *      
     * ]
     */
    protected function createEmailTemplate($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "title" => true,
                "subject" => true,
                "body" => true,
                "description" => false,
                "text_body" => false,
                "lang" => false,
            ], 
            "url" => "createEmailTemplate",
        ];
    }  
    /**
     * Редактировать существующий шаблон сообщения;
     * @link https://www.unisender.com/ru/support/api/templates/updateemailtemplate/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int template_id    => Идентификатор шаблона, может быть получен в результате вызова метода 
     *                            createEmailTemplate, getTemplate, getTemplates, listTemplates. 
     *      string title       => Название шаблона.
     *      string description => Текстовое описание шаблона, которое в дальнейшем можно будет получить 
     *                            при вызове этого шаблона.
     *      string subject     => Строка с темой письма. Может включать поля подстановки.
     *      string body        => Текст шаблона письма в формате HTML с возможностью добавлять поля подстановки.
     *      string text_body   => Текстовый вариант шаблона письма.
     *      string lang        => Двухбуквенный код языка для автоматически добавляемой в каждое письмо 
     *                            строки со ссылкой отписки.
     * ]
     */
    protected function updateEmailTemplate($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "template_id" => true,
                "title" => false,
                "description" => false,
                "subject" => false,
                "body" => false,
                "text_body" => false,
                "lang" => false,
            ], 
            "url" => "updateEmailTemplate",
        ];
    } 
    /**
     * Удалить шаблон
     * @link https://www.unisender.com/ru/support/api/templates/deletetemplate/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int template_id  => 	Код шаблона.
     * ]
     */
    protected function deleteTemplate($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "template_id" => true,
            ], 
            "url" => "deleteTemplate",
        ];
    } 
    /**
     * Получить информацию о шаблоне
     * @link https://www.unisender.com/ru/support/api/templates/gettemplate/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int template_id        => ID пользовательского шаблона. Возвращается методами 
     *                                createEmailTemplate, а также getTemplates или listTemplates.
     *                                Параметр не обязателен, если указывается system_template_id
     *      int system_template_id => ID системного шаблона. Возвращается методами getTemplates 
     *                                или listTemplates.
     *      string format          => Формат вывода возвращаемого результата. Может 
     *                                принимать значения html | json, по умолчанию json 
     *                                (формат html предназначен только для визуального просмотра 
     *                                результата, парсер в данном формате работать не будет).
     * ]
     */
    protected function getTemplate($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "template_id" => false,
                "system_template_id" => false,
                "format" => false,
            ], 
            "url" => "getTemplate",
        ];
    } 
    /**
     * Получить список всех шаблонов, созданных в системе
     * @link https://www.unisender.com/ru/support/api/templates/gettemplates/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string type        => Тип шаблона, TemplateType 
     *      string date_from   => Дата и время создания шаблона, начиная с которой нужно 
     *                            выводить шаблоны, в формате «ГГГГ-ММ-ДД чч:мм», 
     *                            часовой пояс UTC.
     *      string date_to     => Дата и время создания шаблона, заканчивая которой нужно 
     *                            выводить шаблоны, в формате «ГГГГ-ММ-ДД чч:мм», 
     *                            часовой пояс UTC.
     *      string format      => Формат вывода возвращаемого результата. Может принимать 
     *                            значения html | json, по умолчанию json (формат html 
     *                            предназначен только для визуального просмотра результата, 
     *                            парсер в данном формате работать не будет).
     *      int limit          => Количество записей в ответе на один запрос должно быть 
     *                            целым числом в диапазоне 1 - 100 , по умолчанию стоит 
     *                            50 записей.
     *      int offset         => Параметр указывает, с какой позиции начинать выборку. 
     *                            Значение должно быть 0, или больше (позиция первой записи 
     *                            начинается с 0), по умолчанию 0.
     * ]
     */
    protected function getTemplates($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "type" => false,
                "date_from" => false,
                "date_to" => false,
                "format" => false,
                "limit" => false,
                "offset" => false,
            ], 
            "url" => "getTemplates",
        ];
    } 
    /**
     * Получить список всех шаблонов без body
     * @link https://www.unisender.com/ru/support/api/templates/listtemplates/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string type            => Тип шаблона TemplateType
     *      string date_from       => Дата и время создания шаблона, начиная с которой 
     *                                нужно выводить шаблоны, в формате «ГГГГ-ММ-ДД чч:мм»,
     *                                часовой пояс UTC.
     *      string date_to         => Дата и время создания шаблона, заканчивая которой 
     *                                нужно выводить шаблоны, в формате «ГГГГ-ММ-ДД чч:мм», 
     *                                часовой пояс UTC.
     *      string format          => Формат вывода принимает значения html | json, 
     *                                по умолчанию json (формат html предназначен только 
     *                                для визуального просмотра результата, парсер в данном
     *                                формате работать не будет).
     *      int limit              => Количество записей в ответе на один запрос должно быть 
     *                                целым числом в диапазоне 1 - 100 , по умолчанию стоит 
     *                                50 записей.
     *      int offset             => Параметр указывает, с какой позиции начинать выборку.
     *                                Значение должно быть 0, или больше (позиция первой 
     *                                записи начинается с 0), по умолчанию 0.
     * ]
     */
    protected function listTemplates($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "type" => false,
                "date_from" => false,
                "date_to" => false,
                "format" => false,
                "limit" => false,
                "offset" => false,
            ], 
            "url" => "listTemplates",
        ];
    } 
}
