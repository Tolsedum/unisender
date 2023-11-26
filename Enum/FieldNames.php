<?php

namespace App\Mailing\unisender\Enum;

class FieldNames{
    /**
     * Если поле с этим названием содержит 1, то указанные контакты списка удаляются.
     */
    const DELETE = "delete";
    /**
     * Через запятую можно указать метки, присваемые контакту. 
     * Максимально допустимое количество - 10 меток.
     */
    const TAGS = "tags";
    /**
     * Адрес электронной почты контакта
     */
    const EMAIL = "email";
    /**
     * Статус email, один из: 
     * 'new' (новый), 
     * 'active' (активный), 
     * 'inactive'(временно отключённый), 
     * 'unsubscribed' (отписался от всех настоящих и будущих рассылок). 
     * Если статус не указан, то для новых адресов подразумевается 'new'. 
     * Для уже существующих адресов с текущим статусом, не совпадающим с 'active' 
     * или 'inactive', значение статуса поменять нельзя.
     */
    const EMAIL_STATUS = "email_status";
    /**
     * Доступность адреса.
     */
    const EMAIL_AVAILABILITY = "email_availability";
    /**
     * Перечисленные через запятую коды списков, на которые будет подписан email-адрес.
     */
    const EMAIL_LIST_IDS = "email_list_ids";
    /**
     * Перечисленные через запятую дата и время подписки, количество и порядок дат 
     * должен соответствовать количеству и порядку кодов списков в email_list_ids. 
     * Даты указаны в UTC, в формате "ГГГГ-ММ-ДД чч:мм:сс" или "ГГГГ-ММ-ДД".
     */
    const EMAIL_SUBSCRIBE_TIMES = "email_subscribe_times";
    /**
     * Перечисленные через запятую коды списков, в которые email входит, но от 
     * которых контакт отписался. Может показаться, что это поле избыточно, 
     * ведь можно просто в поле email_status указать unsubscribed. Но если у вас 
     * несколько списков, контакт может быть отписанным, например, только от одного, 
     * и тогда только этот список указывается в email_unsubscribed_list_ids, а остальные 
     * - в email_list_ids. Поле же email_status относится к адресу в целом и может быть 
     * при этом равно 'active'.
     */
    const EMAIL_UNSUBSCRIBED_LIST_IDS = "email_unsubscribed_list_ids";
    /**
     * Перечисленные через запятую коды списков, в которые email входит, но из 
     * которых контакт будет исключен. 
     * phone, phone_status, phone_availability, phone_list_ids, phone_subscribe_times, 
     * phone_unsubscribed_list_ids, phone_excluded_list_ids	
     * Смысл полей совпадает с аналогичными полями для email. 
     * Ещё одно отличие — по умолчанию для новых телефонов phone_status устанавливается 
     * в 'active'. Также обратите внимание, что значение поля «phone» должно передаваться 
     * в международном формате (пример: +79261232323)
     */
    const EMAIL_EXCLUDED_LIST_IDS = "email_excluded_list_ids";


    const ID = "id";
    const EMAIL_ADD_TIME = "email_add_time";
    const EMAIL_REQUEST_IP = "email_request_ip";
    const EMAIL_CONFIRM_TIME = "email_confirm_time";
    const EMAIL_CONFIRM_IP = "email_confirm_ip";
    const EMAIL_LAST_DELIVERED_AT = "email_last_delivered_at";
    const EMAIL_LAST_READ_AT = "email_last_read_at";
    const EMAIL_LAST_CLICKED_AT = "email_last_clicked_at";
    const PHONE = "phone";
    const PHONE_STATUS = "phone_status";
    const PHONE_AVAILABILITY = "phone_availability";
    const PHONE_ADD_TIME = "phone_add_time";
    const PHONE_REQUEST_IP = "phone_request_ip";
    const PHONE_LIST_IDS = "phone_list_ids";
    const PHONE_SUBSCRIBE_TIMES = "phone_subscribe_times";
    const PHONE_UNSUBSCRIBED_LIST_IDS = "phone_unsubscribed_list_ids";
}