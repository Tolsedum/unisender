<?php

namespace App\Mailing\unisender\Api\traits;

use App\Mailing\unisender\ExceptionUnisender;

/**
 * Получение статистики
 */
trait Statistics{
    
    /**
     *  Получить отчёт о статусах доставки сообщений для заданной рассылки;
     * @link https://www.unisender.com/ru/support/api/statistics/getcampaigndeliverystats/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      campaign_id         => Идентификатор кампании, полученный при вызове метода 
     *                             createCampaign.
     *      notify_url          => URL, на который будет отправлен ответ после того, как 
     *                             отчет будет сформирован.
     *      changed_since       => Возвращать все статусы адресов, изменившиеся начиная 
     *                             с указанного времени включительно 
     *                             (в формате «ГГГГ-ММ-ДД чч:мм:сс», часовой пояс UTC). 
     *                             Если аргумент отсутствует, то возвращаются все статусы.
     *      field_ids           => Массив id дополнительных полей. Способ передачи с 
     *                             помощью HTTP: field_ids[]=1&field_ids[]=2. 
     *                             Значения id можно получить используя метод getFields. 
     *                             Если указан, в результат добавляются значения дополнительных 
     *                             полей, связанных с контактом.
     *      
     * ]
     */
    protected function getCampaignDeliveryStats($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "campaign_id" => true,
                "notify_url" => false,
                "changed_since" => false,
                "field_ids" => false,
            ], 
            "url" => "async/getCampaignDeliveryStats",
        ];
    }
   
    /**
     *  Получить общие сведения о результатах доставки для заданной рассылки;
     * @link https://www.unisender.com/ru/support/api/statistics/get-campaign-common-stats/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int campaign_id       => Идентификатор кампании, полученный при вызове 
     *                               метода createCampaign (отправке рассылки).
     * ]
     */
    protected function getCampaignCommonStats($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "campaign_id" => true
            ], 
            "url" => "getCampaignCommonStats",
        ];
    }

    /**
     *  Получить статистику переходов по ссылкам;
     * @link https://www.unisender.com/ru/support/api/statistics/getvisitedlinks/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      campaign_id        => Идентификатор кампании, полученный при вызове метода 
     *                            createCampaign.
     *      group              => Группировать результаты по посещенным ссылкам. 
     *                            Если пользователь посетил ссылку несколько раз, в 
     *                            результатах это будет представлено одной записью, с 
     *                            указанием количества посещений в поле count.
     * ]
     */
    protected function getVisitedLinks($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "campaign_id" => true,
                "group" => false,
            ], 
            "url" => "getVisitedLinks",
        ];
    }

    /**
     *  Получить список рассылок;
     * @link https://www.unisender.com/ru/support/api/statistics/getcampaigns/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string from         => Дата и время старта рассылки, начиная с которой нужно 
     *                             выводить рассылки, в формате «ГГГГ-ММ-ДД чч:мм:сс», 
     *                             часовой пояс UTC.
     *      string to           => Дата и время старта рассылки, заканчивая которой нужно 
     *                             выводить рассылки, в формате «ГГГГ-ММ-ДД чч:мм:сс», 
     *                             часовой пояс UTC.
     *      int limit           => Количество записей в ответе на один запрос должно быть 
     *                             целым числом в диапазоне 1 — 10 000.
     *      int offset          => Параметр указывает, с какой позиции начинать выборку. 
     *                             Значение должно быть 0, или больше (позиция первой 
     *                             записи начинается с 0), по умолчанию 0.
     *      
     * ]
     */
    protected function getCampaigns($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "from" => false,
                "to" => false,
                "limit" => false,
                "offset" => false,
            ], 
            "url" => "getCampaigns",
        ];
    }
    /**
     *  Получить статус рассылки;
     * @link https://www.unisender.com/ru/support/api/statistics/getcampaignstatus/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int campaign_id   => Код рассылки, полученный методом createCampaign.
     *      
     * ]
     */
    protected function getCampaignStatus($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "campaign_id" => true,
            ], 
            "url" => "getCampaignStatus",
        ];
    }
    /**
     *  Получить список сообщений;
     * @link https://www.unisender.com/ru/support/api/statistics/getmessages/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string date_from    => Дата создания больше чем, формат yyyy-mm-dd hh:mm UTC.
     *      string date_to      => Дата создания меньше чем, формат yyyy-mm-dd hh:mm UTC.
     *      string format       => Формат вывода принимает значения html | json, по 
     *                             умолчанию json.
     *      int limit           => Количество  записей в ответе на один запрос, должно 
     *                             быть целое число в диапазоне 1 - 100, по умолчанию 50.
     *      int offset          => С какой позиции начинать выборку, должен быть 0 или 
     *                             больше (позиция первой записи начинается с 0), по 
     *                             умолчанию 0.
     * ]
     */
    protected function getMessages($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "date_from" => true,
                "date_to" => true,
                "format" => false,
                "limit" => false,
                "offset" => false,
            ], 
            "url" => "getMessages",
        ];
    }
    /**
     *  Получить информацию об SMS или email-сообщении;
     * @link https://www.unisender.com/ru/support/api/statistics/getmessage/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      id    =>   id - 31-битное положительное целое, идентификатор сообщения. 
     *                 Такие идентификаторы возвращаются методами createEmailMessage и 
     *                 createSmsMessage. id можно передавать как одно число или как массив 
     *                 для получения нескольких писем (см. пример ниже).
     *      
     * ]
     */
    protected function getMessage($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "id" => true,
            ], 
            "url" => "getMessage",
        ];
    }
    /**
     *  Получить список сообщений без тела и вложений.
     * @link https://www.unisender.com/ru/support/api/statistics/listmessages/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string date_from => Дата и время создания сообщения, начиная с которой нужно 
     *                          выводить сообщения, в формате «ГГГГ-ММ-ДД чч:мм», часовой 
     *                          пояс UTC.
     *      string date_to   => Дата и время создания сообщения, заканчивая которой нужно 
     *                          выводить сообщения, в формате «ГГГГ-ММ-ДД чч:мм», 
     *                          часовой пояс UTC.
     *      string format   =>  Формат вывода принимает значения html | json, по умолчанию 
     *                          json (формат html предназначен только для визуального 
     *                          просмотра результата, парсер в данном формате работать не 
     *                          будет).
     *      int limit       =>  Количество записей в ответе на один запрос должно быть целым 
     *                          числом в диапазоне 1 - 100 , по умолчанию стоит 50 записей.
     *      offset          =>  Параметр указывает, с какой позиции начинать выборку. 
     *                          Значение должно быть 0, или больше (позиция первой записи 
     *                          начинается с 0), по умолчанию 0.
     *      
     * ]
     */
    protected function listMessages($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "date_from" => true,
                "date_to" => true,
                "format" => false,
                "limit" => false,
                "offset" => false,
            ], 
            "url" => "listMessages",
        ];
    }
    
}

