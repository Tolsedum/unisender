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
 * Статусы Адресов
 * @author Tolsedum
 */
class EmailStatus{
    /**
     *  Новый.
     */
    const NEW = "new";
    /**
     *  Отправлено приглашение со ссылкой подтверждения подписки, 
     *  ждём ответа, рассылка по такому адресу пока невозможна.
     */
    const INVITED = "invited";
    /**
     *  Активный адрес, возможна рассылка.
     */
    const ACTIVE = "active";
    /**
     *  Адрес отключён через веб-интерфейс, никакие рассылки невозможны, 
     *  но можно снова включить через веб-интерфейс.
     */
    const INACTIVE = "inactive";
    /**
     *  Адресат отписался от всех рассылок.
     */
    const UNSUBSCRIBED = "unsubscribed";
    /**
     *  Адрес заблокирован администрацией нашего сервиса (например, по жалобе адресата),
     *  рассылка по нему невозможна. Разблокировка возможна только по просьбе самого 
     *  адресата.
     */
    const BLOCKED = "blocked";
    /**
     *  Запрошена активация адреса у администрации Unisender, рассылка пока невозможна.
     */
    const ACTIVATION_REQUESTED = "activation_requested";
}