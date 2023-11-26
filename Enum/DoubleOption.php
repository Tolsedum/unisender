<?php

namespace App\Mailing\unisender\Enum;

class DoubleOption{
    /**
     * Считается, что контакт только высказал желание подписаться,
     * но ещё не подтвердил подписку. В этом случае контакту будет 
     * отправлено письмо-приглашение подписаться. Текст письма будет 
     * взят из свойств первого списка из list_ids. Кстати, текст 
     * можно поменять с помощью метода updateOptInEmail или через веб-интерфейс.
     */
    const EXPRESSED_SUBSCRIPTION = 0;
    /**
     * Считается, что согласие контакта у вас уже есть, контакт добавляется 
     * со статусом «новый».
     */
    const NEW_SUBSCRIPTION = 3;
    /**
     * Система выполняет проверку на наличие контакта в ваших списках. 
     * Если контакт уже есть в ваших списках со статусом «новый» или «активен», 
     * то адрес просто будет добавлен в указанный вами список. Если же контакт 
     * отсутствует в ваших списках или его статус отличен от «новый» или «активен», 
     * то ему будет отправлено письмо-приглашение подписаться. Текст этого письма 
     * можно настроить для каждого списка с помощью метода  updateOptInEmail или 
     * через веб-интерфейс.
     */
    const INVITATION_SUBSCRIPTION = 4;
}