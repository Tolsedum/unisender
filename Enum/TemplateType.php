<?php

namespace App\Mailing\unisender\Enum;

/**Тип шаблона */
class TemplateType{
    /**
     * Системные шаблоны (их вывод не зависит от даты и времени создания шаблонов - 
     *  параметров date_from и date_to);
     */
    const SYSTEM = "system";
    /**
     * Пользовательские шаблоны (значение по умолчанию).
     */
    const USER = "user";
}