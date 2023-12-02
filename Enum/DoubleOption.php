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
namespace App\Mailing\unisender\Enum;

/**
 * Опции в запросе
 * @author Tolsedum
 */
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