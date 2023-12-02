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
 * Режим перезаписывания полей и меток. 
 * Задаёт, что делать в случае существования контакта 
 * (контакт определяется по email-адресу).
 * @author Tolsedum
 */
class OverwriteMode{
    /**
     * Происходит только добавление новых полей и меток, 
     * уже существующие поля сохраняют своё значение.
     */
    const ADD = 0;
    /**
     * Все старые поля удаляются и заменяются новыми, 
     * все старые метки также удаляются и заменяются новыми. 
     * Контакт будет удален со всех списков, кроме переданных в параметре list_ids.
     */
    const DELETE_UPDATE = 1;
    /**
     * Заменяются значения переданных полей, если у существующего контакта 
     * есть и другие поля, то они сохраняют своё значение. В случае передачи 
     * меток они перезаписываются, если же метки не передаются, то сохраняются старые 
     * значения меток.
     */
    const UPDATE = 2;
}