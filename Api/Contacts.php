<?php

namespace App\Mailing\Unisender\Api;

use App\Mailing\Unisender\ExceptionUnisender;

/* Работа со списками контактов*/
trait Contacts{
    
    /**
     * Получить списки для рассылок с их кодами
     * @link https://www.unisender.com/ru/support/api/contacts/getlists/
     * @return array [название параметра => обязательный ли он]
     */
    protected function getLists($params = []){
        return [];
    }

    /**
     * Создать новый список контактов
     * @link https://www.unisender.com/ru/support/api/contacts/createlist/
     * @return array [
     *      название параметра => обязательный ли он
     * 
     *      string title                 => Название списка. Должно быть уникальным
     *      string before_subscribe_url  => URL для редиректа на страницу «перед подпиской»
     *      string after_subscribe_url   => URL для редиректа на страницу «после подписки»
     * ]
     */
    protected function createList($params = []){
        if(empty($params)){
            throw new ExceptionUnisender("Error Processing Request", 1);
        }
        return [
            "title" => true, 
            "before_subscribe_url" => false, 
            "after_subscribe_url" => false,
        ];
    }
    /**
     * Изменить свойства списка рассылки
     * @link https://www.unisender.com/ru/support/api/contacts/updatelist/
     * @return array [
     *      название параметра => обязательный ли он
     * 
     *      int list_id   => Код списка, полученный методом getLists или createList.
     *      string title  => Название списка. Должно быть уникальным
     *      string before_subscribe_url  => URL для редиректа на страницу «перед подпиской»
     *      string after_subscribe_url   => URL для редиректа на страницу «после подписки»
     * ]
     */
    protected function updateList($params = []){
        return [
            "list_id" => true,
            "title" => true, 
            "before_subscribe_url" => false, 
            "after_subscribe_url" => false,
        ];
    }
    /**
     * Удалить список контактов
     * @link https://www.unisender.com/ru/support/api/contacts/deletelist/
     * @return array [
     *      название параметра => обязательный ли он
     *      int list_id   => Код списка, полученный методом getLists или createList.
     * ]
     */
    protected function deleteList($params = []){
        return [
            "list_id" => true,
        ];
    }
    /**
     * Подписать адресата на один или несколько списков рассылки
     * @link https://www.unisender.com/ru/support/api/contacts/subscribe/
     * @return array [
     *      название параметра => обязательный ли он
     * 
     *      list_ids => Перечисленные через запятую коды списков, 
     *                  в которые надо добавить контакта
     *      fields   => Ассоциативный массив дополнительных полей.
     *                  Массив в запросе передаётся строкой вида 
     *                  fields[NAME1]=VALUE1&fields[NAME2]=VALUE2
     *      tags     => Перечисленные через запятую метки, которые 
     *                  добавляются к контакту. Максимально допустимое 
     *                  количество - 10 меток.
     *      double_optin => const DoubleOption
     *      overwrite => Режим перезаписывания полей и меток
     * ]
     */
    protected function subscribe($params = []){
        return [
            "list_ids" => true,
            "fields" => true,
            "tags" => false,
            "overwrite" => false,
        ];
    }
    /**
     * Исключить адресата из списков рассылки
     * @return array [название параметра => обязательный ли он]
     */
    protected function exclude($params = []){
            
    } 
    /**
     * Отписать адресата от рассылки
     * @return array [название параметра => обязательный ли он]
     */
    protected function unsubscribe($params = []){
            
    }
    /**
     * Массовый импорт и синхронизация контактов;
     * @return array [название параметра => обязательный ли он]
     */
    protected function importContacts($params = []){
            
    }
    /**
     * Экспорт данных по контактам;
     * @return array [название параметра => обязательный ли он]
     */
    protected function exportContacts($params = []){
            
    }
    /**
     * Получить информацию о размере базы пользователя
     * @return array [название параметра => обязательный ли он]
     */
    protected function getTotalContactsCount($params = []){
            
    } 
    /**
     * Получить количество контактов в списке
     * @return array [название параметра => обязательный ли он]
     */
    protected function getContactCount($params = []){
            
    } 
    /**
     * Получить информацию об одном контакте.
     * @return array [название параметра => обязательный ли он]
     */
    protected function getContact($params = []){
            
    }
}