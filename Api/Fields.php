<?php

namespace App\Mailing\Unisender\Api;

class Fields{
    Работа с дополнительными полями и метками:

getFields — получить список пользовательских полей;
createField — создать новое поле;
updateField — изменить параметры поля;
deleteField — удалить поле;
getTags — получить список пользовательских меток;
deleteTag — удалить метку.

Создание и отправка сообщений:

createEmailMessage — создать email для рассылки;
createSmsMessage — создать SMS для массовой рассылки;
createCampaign — запланировать массовую отправку email или SMS сообщения;
cancelCampaign — отменить запланированную ранее массовую рассылку;
getActualMessageVersion — получить актуальную версию письма;
sendSms — отправить SMS-сообщение;
checkSms — проверить статус доставки SMS;
sendEmail — упрощённая отправка индивидуальных email-сообщений;
sendTestEmail — отправить тестовую email-рассылку (на собственный адрес);
checkEmail — проверить статус доставки email;
updateOptInEmail — изменить текст письма со ссылкой подтверждения подписки;
getWebVersion — получить ссылку на веб-версию отправленного письма;
deleteMessage — удалить сообщение;
updateEmailMessage — редактировать email для массовой рассылки.
Работа с шаблонами:

createEmailTemplate  — создать шаблон сообщения для массовой рассылки;
updateEmailTemplate — редактировать существующий шаблон сообщения;
deleteTemplate — удалить шаблон;
getTemplate — получить информацию о шаблоне;
getTemplates — получить список всех шаблонов, созданных в системе;
listTemplates — получить список всех шаблонов без body.
Получение статистики:

getCampaignDeliveryStats — получить отчёт о статусах доставки сообщений для заданной рассылки;
getCampaignCommonStats — получить общие сведения о результатах доставки для заданной рассылки;
getVisitedLinks — получить статистику переходов по ссылкам;
getCampaigns — получить список рассылок;
getCampaignStatus — получить статус рассылки;
getMessages — получить список сообщений;
getMessage — получить информацию об SMS или email-сообщении;
listMessages — получить список сообщений без тела и вложений.
Работа с заметками:

createSubsciberNote — создать заметку о контакте;
updateSubcriberNote — редактировать заметку;
deleteSubscriberNote — удалить заметку;
getSubscriberNote — получить информацию о заметке;
getSubscriberNotes — получить информацию о всех заметках контакта.
}