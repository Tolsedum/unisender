<?php

namespace App\Mailing\unisender\Api\traits;

use App\Mailing\unisender\ExceptionUnisender;

/**
 *  Работа с заметками
 */
trait Notes{
    /**
     * Создать заметку о контакте
     * @link https://www.unisender.com/ru/support/api/notes/createsubscibernote/
     * @return array [
     *      название параметра => обязательный ли он
     *      int subscriber_id => ID контакта, для которого необходимо добавить заметку.
     *      string content    => Текст заметки. Максимальная длина - 255 символов.
     * ]
     * 
     */
    protected function createSubsciberNote($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "subscriber_id" => true,
                "content" => true,
            ], 
            "url" => "createSubsciberNote",
        ];
    }
    /**
     * Редактировать заметку
     * @link https://www.unisender.com/ru/support/api/notes/updatesubcribernote/
     * @return array [
     *      название параметра => обязательный ли он
     * 
     *      int id          => ID заметки, которую нужно отредактировать.
     *      string content  => Новый текст заметки. Максимальная длина - 255 символов.
     *      string format   => Формат вывода возвращаемого результата. Может принимать 
     *                         значения html | json, по умолчанию json (формат html 
     *                         предназначен только для визуального просмотра результата, 
     *                         парсер в данном формате работать не будет).
     * ]
     * 
     */
    protected function updateSubcriberNote($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "id" => true,
                "content" => true,
                "format" => false,
            ], 
            "url" => "updateSubcriberNote",
        ];
    }
    /**
     * Удалить заметку
     * @link https://www.unisender.com/ru/support/api/notes/deletesubscribernote/
     * @return array [
     *      название параметра => обязательный ли он
     * 
     *      id  => Идентификатор заметки, которую нужно удалить.
     * ]
     * 
     */
    protected function deleteSubscriberNote($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "id" => true,
            ], 
            "url" => "deleteSubscriberNote",
        ];
    }
    /**
     * Получить информацию о заметке
     * @link https://www.unisender.com/ru/support/api/notes/getsubscribernote/
     * @return array [
     *      название параметра => обязательный ли он
     * 
     *      id => Идентификатор заметки.
     *      format => Формат вывода возвращаемого результата. Может принимать значения 
     *                html | json, по умолчанию json (формат html предназначен только 
     *                для визуального просмотра результата, парсер в данном формате 
     *                работать не будет).
     * ]
     * 
     */
    protected function getSubscriberNote($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "id" => true,
                "format" => false,
            ], 
            "url" => "getSubscriberNote",
        ];
    }
    /**
     * Получить информацию о всех заметках контакта
     * @link https://www.unisender.com/ru/support/api/notes/getsubscribernotes/
     * @return array [
     *      название параметра => обязательный ли он
     * 
     *      int subscriber_id   => ID контакта, чьи заметки необходимо получить.
     *      int limit           => Количество записей в ответе на один запрос.
     *      offset              => Параметр используется для указания с какой записи 
     *                             вы хотите начать получение информации. Установив 
     *                             значение offset, вы можете пропустить определенное 
     *                             количество элементов в результатах запроса и получить 
     *                             данные, начиная со следующего элемента после указанного 
     *                             смещения.
     *      string order_type   => ASC – сортировка заметок по возрастанию параметра order_by;
     *                             DESC – сортировка заметок по убыванию параметра order_by.
     *      string order_by     => created_at – дата и время создания заметки;
     *                             updated_at – дата и время обновления заметки;
     *                             pinned_at – дата и время закрепления заметки.
     *      int is_pinned       => 0 - будут получены все незакрепленные заметки;
     *                             1 - будут получены все закрепленные заметки.
     *      string format       => Формат вывода возвращаемого результата. 
     *                             Может принимать значения html | json, по умолчанию 
     *                             json (формат html предназначен только для визуального 
     *                             просмотра результата, парсер в данном формате работать 
     *                             не будет).
     * ]
     * 
     */
    protected function getSubscriberNotes($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "subscriber_id" => true,
                "limit" => false,
                "offset" => false,
                "order_type" => false,
                "order_by" => false,
                "updated_at" => false,
                "pinned_at" => false,
                "is_pinned" => false,
                "format" => false,
            ], 
            "url" => "getSubscriberNotes",
        ];
    }
}

