<?php

namespace App\Mailing\unisender\Api\traits;

use App\Mailing\unisender\ExceptionUnisender;

/**
 * Создание и отправка сообщений:
 */
trait Messages{
    

    /**
     *  Создать email для рассылки;
     * @link https://www.unisender.com/ru/support/api/messages/
     * @return array [
     *      url => url запроса
     *   название параметра => обязательный ли он
     * 
     *  string sender_name    => Имя отправителя. Произвольная строка, не 
     *                            совпадающая с e-mail адресом (аргумент sender_email).
     *  string sender_email   => E-mail адрес отправителя. Этот e-mail должен быть 
     *                           проверен (для этого надо создать вручную хотя бы одно 
     *                           письмо с этим обратным адресом через веб-интерфейс, 
     *                           затем нажать на ссылку «отправьте запрос подтверждения» 
     *                           и перейти по ссылке из письма).
     *  string subject        => Строка с темой письма. Может включать поля подстановки. 
     *                           Параметр не обязателен, если указывается template_id
     *  string body           => Текст письма в формате HTML с возможностью добавлять 
     *                           поля подстановки. Вы можете вставить изображение, 
     *                           передав его как файл-вложение (см. описание аргумента 
     *                           attachments).
     *  int list_id           => Код списка, по которому будет произведена отправка 
     *                           e-mail рассылки. Коды всех списков можно получить с 
     *                           помощью вызова getLists.
     *  string text_body      => Текстовый вариант письма. По умолчанию отсутствует.
     *  bool generate_text    => 0 или 1, по умолчанию 0. Значение 1 означает, что 
     *                           генерация текстовой части письма будет выполнена 
     *                           автоматически по HTML-части.
     *  string tag            => Метка. Если задана, то отправка рассылки письма 
     *                           будет производиться не по всему списку, а только по 
     *                           тем адресатам, которым присвоена заданная метка.
     *  array attachments     => Ассоциативный массив файлов-вложений
     *  string lang           => Двухбуквенный код языка для автоматически добавляемой 
     *                           в каждое письмо строки со ссылкой отписки.
     *  int template_id       => id пользовательского шаблона письма, созданного ранее, 
     *                           на основе которого можно создать письмо.
     *  int system_template_id=> id системного шаблона письма, на основе которого можно 
     *                           создать письмо. Значение можно получить с помощью 
     *                           getTemplates или listTemplates.
     *  string wrap_type      => Выравнивание текста сообщения по заданному краю. 
     *                           Если аргумент отсутствует, то выравнивание производиться 
     *                           не будет. WrapType
     * ]
     */
    protected function createEmailMessage($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "sender_name" => true,
                "sender_email" => true,
                "subject" => true,
                "body" => true,
                "list_id" => true,
                "text_body" => false,
                "generate_text" => false,
                "tag" => false,
                "attachments" => false,
                "lang" => false,
                "template_id" => false,
                "system_template_id" => false,
                "wrap_type" => false, 
            ], 
            "url" => "createList",
        ];
    }
    /**
     *  Создать SMS для массовой рассылки;
     * @link https://www.unisender.com/ru/support/api/messages/createsmsmessage/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string sender  => Имя отправителя от 3 до 11 латинских букв и цифр. 
     *                        Имя необходимо регистрировать в службе поддержки.
     *      string body    => Текст сообщения с возможностью добавлять поля подстановки.
     *      int list_id    => Код списка, по которому будет отправка SMS. Коды всех 
     *                        списков можно получить с помощью вызова getLists.
     *      string tag     => Метка. Если задана, то отправка сообщения будет производиться 
     *                        не по всему списку, а только по тем адресатам, которым 
     *                        присвоена заданная метка.
     * ]
     */
    protected function createSmsMessage($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "sender" => true,
                "body" => true,
                "list_id" => true,
                "tag" => false,
            ], 
            "url" => "createSmsMessage",
        ];
    }
    /**
     *  Запланировать массовую отправку email или SMS сообщения;
     * @link https://www.unisender.com/ru/support/api/messages/createcampaign/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string message_id   => Код сообщения, которое надо отправить. Передавать надо код, 
     *                             возвращённый методом createEmailMessage или createSmsMessage.
     *      string start_time   => Дата и время запуска рассылки в формате «ГГГГ-ММ-ДД чч:мм», 
     *                             которые не превышают 100 дней от текущей даты.
     *      string timezone     => Часовой пояс, в котором задано время в аргументе «start_time».
     *      bool track_read     => Принимаемое значение – 0 или 1 – отслеживать ли факт прочтения e-mail 
     *                             сообщения. По умолчанию 0 (не отслеживать).
     *      bool track_links	=> Принимаемое значение – 0 или 1 – отслеживать ли переходы по ссылкам в e-mail 
     *                             сообщениях, по умолчанию 0 (не отслеживать).
     *      string contacts     => Перечисленные через запятую email-адреса (или телефоны для sms-сообщений), 
     *                             которыми нужно ограничиться при отправке сообщения.
     *      string contacts_url => Вместо параметра contacts, содержащего собственно email-адреса
     *                             или телефоны, можно задать в данном параметре URL файла, 
     *                             откуда будут прочитаны адреса (телефоны). 
     *      bool track_ga       => Принимаемое значение – 0 или 1 – включить ли для данной рассылки интеграцию 
     *                             с Google Analytics/Яндекс.Метрика.
     *      payment_limit,      => Параметр, позволяющие ограничить бюджет рассылки до заданной в payment_limit 
     *      payment_currency       суммы в валюте payment_currency.
     *      
     *      ga_medium,          => Параметры интеграции с Google Analytics/Яндекс.Метрика 
     *      ga_source,             (действуют, если track_ga=1). Действует только явно указанные значения, 
     *      ga_campaign,           параметры пользования по умолчанию не применяются. См. полное описание параметров.
     *      ga_content, 
     *      ga_term
     *      
     * ]
     */
    protected function createCampaign($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "message_id" => true,
                "start_time" => false,
                "timezone" => false,
                "track_read" => false,
                "track_links" => false,
                "contacts" => false,
                "contacts_url" => false,
                "track_ga" => false,
                "payment_limit" => false,
                "payment_currency" => false,
                "ga_medium" => false,
                "ga_source" => false,
                "ga_campaign" => false,
                "ga_content" => false,
                "ga_term" => false
            ], 
            "url" => "createCampaign",
        ];
    }
    /**
     *  Отменить запланированную ранее массовую рассылку;
     * @link https://www.unisender.com/ru/support/api/messages/cancel-campaign/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int campaign_id    => id рассылки, которую необходимо отменить.
     * ]
     */
    protected function cancelCampaign($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "campaign_id" => true,
            ], 
            "url" => "cancelCampaign",
        ];
    }
    /**
     *  Получить актуальную версию письма;
     * @link https://www.unisender.com/ru/support/api/messages/get-actual-message-version/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int message_id     => Идентификатор сообщения, для которого необходимо 
     *                            получить id актуальной версии письма.
     * ]
     */
    protected function getActualMessageVersion($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "message_id" => true,
            ], 
            "url" => "getActualMessageVersion",
        ];
    }
    /**
     *  Отправить SMS-сообщение;
     * @link https://www.unisender.com/ru/support/api/messages/sendsms/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string phone     => телефон получателя в международном формате с 
     *                          кодом страны (можно опускать ведущий «+»).
     *      string sender    => Отправитель – зарегистрированное имя отправителя 
     *                          (альфа-имя). Строка может содержать от 3 до 11 латинских 
     *                          букв или цифр с буквами. Также возможны специальные 
     *                          символы – точка, дефис, тире и некоторые другие.
     *      string text     =>  Текст сообщения, до 1000 символов. Символы подстановки 
     *                          типа игнорируются.
     *      
     * ]
     */
    protected function sendSms($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "phone" => true,
                "sender" => true,
                "text" => true,
            ], 
            "url" => "sendSms",
        ];
    }
    /**
     *  Проверить статус доставки SMS;
     * @link 
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int sms_id  => Код сообщения, возвращённый методом sendSms.
     * ]
     */
    protected function checkSms($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "sms_id" => true,
            ], 
            "url" => "checkSms",
        ];
    }
    /**
     *  Упрощённая отправка индивидуальных email-сообщений;
     * @link 
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string email       => Адрес получателя сообщения.
     *      string sender_name => Имя отправителя. Произвольная строка, отображается 
     *                            в поле "От кого" почтового клиента.
     *      string sender_email => E-mail адрес отправителя
     *      string subject      => Строка с темой письма.
     *      string body         => Текст письма в формате HTML.
     *      int list_id         => 	Код списка, от которого будет предложено отписаться 
     *                              адресату в случае, если он перейдёт по ссылке отписки.
     *      attachments         => Вложенные в письмо файлы (их бинарное содержимое, base64 использовать нельзя!).
     *      string lang         => Двухбуквенный код языка для автоматически добавляемой в каждое письмо строки 
     *                             со ссылкой отписки.
     *      bool track_read     => Принимаемое значение – 0 или 1 – отслеживать ли факт прочтения 
     *                             e-mail сообщения. По умолчанию 0 (не отслеживать).
     *      bool track_links    => Принимаемое значение – 0 или 1 – отслеживать ли переходы по ссылкам 
     *                             в e-mail сообщениях, по умолчанию 0 (не отслеживать).
     *      string cc           => Содержит адрес вторичного получателя письма, которому направляется 
     *                             копия письма. Не более 1 адреса.
     *      string headers      => Текст со списком заголовков, каждый заголовок - 
     *                             на отдельной строке в MIME-формате. 
     *      string images_as    => Позволяет изменять режим обработки вложенных изображений 
     *                             в письме.  ImagesAs
     *      ref_key             => Параметр может передаваться пользователем для присвоения письму ключа-идентификатора. 
     *                             Принимаемое значение ключа должно быть уникальным.
     *      bool error_checking => Принимаемое значение – 0 или 1. Для обратной совместимости по умолчанию используется 
     *                             значение 0, но мы рекомендуем всегда передавать этот параметр со значением 1.
     *      array metadate      => Метаданные, отправляемые в запросе, возвращаются в Webhooks.
     * ]
     */
    protected function sendEmail($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "email" => true,
                "sender_name" => true,
                "sender_email" => true,
                "subject" => true,
                "body" => true,
                "list_id" => true,
                "attachments" => false,
                "lang" => false,
                "track_read" => false,
                "track_links" => false,
                "cc" => false,
                "headers" => false,
                "images_as" => false,
                "ref_key" => false,
                "error_checking" => false,
                "metadata" => false,
            ], 
            "url" => "sendEmail",
        ];
    }
    /**
     *  Отправить тестовую email-рассылку (на собственный адрес);
     * @link https://www.unisender.com/ru/support/api/messages/sendtestemail/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string email    => Адрес получателя сообщения. Отправлять можно на 
     *                            несколько адресов, перечисленных через запятую
     *      in id           => Идентификатор email-письма, созданного ранее. 
     *                         (Например, с помощью метода createEmailMessage).
     * ]
     */
    protected function sendTestEmail($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "email" => true,
                "id" => true,
            ], 
            "url" => "sendTestEmail",
        ];
    }
    /**
     *  Проверить статус доставки email;
     * @link https://www.unisender.com/ru/support/api/messages/check-email/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string email_id    => Код сообщения, возвращённый методом sendEmail. 
     *                            Возможно указание до 500 кодов email через запятую.
     * ]
     */
    protected function checkEmail($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "email_id" => true,
            ], 
            "url" => "checkEmail",
        ];
    }
    /**
     *  Изменить текст письма со ссылкой подтверждения подписки;
     * @link https://www.unisender.com/ru/support/api/messages/updateoptinemail/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      string sender_name  => Имя отправителя. Произвольная строка, не совпадающая 
     *                            с e-mail адресом (аргумент sender_email).
     *      string sender_email => E-mail адрес отправителя. Этот e-mail должен быть 
     *                             проверен (для этого надо создать вручную хотя бы одно 
     *                             письмо с этим обратным адресом через веб-интерфейс, 
     *                             затем нажать на ссылку "отправьте запрос подтверждения"
     *                             и перейти по ссылке из письма).
     *      string subject      => Строка с темой письма. Может включать поля подстановки.
     *      string body         => Текст письма в формате HTML с возможностью добавлять 
     *                             поля подстановки.
     *      int list_id       => Код списка, при подписке на который будет отправлять данное письмо. 
     *                             Коды всех списков можно получить с помощью вызова getLists.
     * ]
     */
    protected function updateOptInEmail($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "sender_name" => true,
                "sender_email" => true,
                "subject" => true,
                "body" => true,
                "list_id" => true
            ], 
            "url" => "updateOptInEmail",
        ];
    }
    /**
     *  Получить ссылку на веб-версию отправленного письма;
     * @link https://www.unisender.com/ru/support/api/messages/getwebversion/
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int campaign_id => Идентификатор существующей кампании.
     *      string format   => Формат вывода принимает значения html | json, по 
     *                         умолчанию json (формат html предназначен только для 
     *                         визуального просмотра результата, парсер в данном 
     *                         формате работать не будет)
     * ]
     */
    protected function getWebVersion($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "campaign_id" => true,
                "format" => false
            ], 
            "url" => "getWebVersion",
        ];
    }
    /**
     *  Удалить сообщение;
     * @link 
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int message_id => Код сообщения.
     * ]
     */
    protected function deleteMessage($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "message_id" => true,
            ], 
            "url" => "deleteMessage",
        ];
    }
    /**
     *  Редактировать email для массовой рассылки.
     * @link 
     * @return array [
     *      url => url запроса
     *      название параметра => обязательный ли он
     * 
     *      int id             => Идентификатор сообщения для редактирования, 
     *                            созданного ранее методом createEmailMessage.
     *      string sender_name => Имя отправителя. Произвольная строка, не совпадающая с 
     *                            email адресом (аргумент sender_email).
     *      string sender_email=> Email адрес отправителя. Этот email должен быть 
     *                            подтвержден (для отправки письма подтверждения можно 
     *                            воспользоваться методом validateSender, или создать 
     *                            вручную хотя бы одно письмо с этим обратным адресом 
     *                            через веб-интерфейс, затем нажать на ссылку 
     *                            «отправьте запрос подтверждения» и перейти по ссылке 
     *                            из письма).
     *      string subject     => Строка с темой письма. Может включать поля подстановки.
     *      string body        => Текст письма в формате HTML с возможностью добавлять поля 
     *                            подстановки.
     *      int list_id        => Код списка, по которому будет произведена отправка e-mail рассылки. 
     *                            Коды всех списков можно получить с помощью вызова getLists. 
     *      string text_body   => Текстовый вариант письма.
     *      string lang        => Двухбуквенный код языка для автоматически добавляемой в каждое письмо 
     *                            строки со ссылкой отписки.
     *      string categories  => Категории письма, перечисленные в текстовом виде через запятую.
     * ]
     */
    protected function updateEmailMessage($params = []){
        if(empty($params)){
            throw new ExceptionUnisender(ExceptionUnisender::EMPTY_PARAMS);
        }
        return [
            "pattern" => [
                "id" => true,
                "sender_name" => false,
                "sender_email" => false,
                "subject" => false,
                "body" => false,
                "list_id" => false,
                "text_body" => false,
                "lang" => false,
                "categories" => false
            ], 
            "url" => "updateEmailMessage",
        ];
    }

}