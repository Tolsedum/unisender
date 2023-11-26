<?php

namespace App\Mailing\unisender\Enum;

class FieldType{
    /**
     *  Строка;
     */
    const STRING = "string";
    /**
     *  Одна или несколько строк;
     */
    const TEXT = "text";
    /**
     *  Целое число или число с десятичной точкой;
     */
    const NUMBER = "number";
    /**
     *  Дата (поддерживается формат ДД.ММ.ГГГГ, ДД-ММ-ГГГГ, ГГГГ.ММ.ДД, ГГГГ-ММ-ДД);
     */
    const DATE = "date";
    /**
     *  1/0, да/нет.
     */
    const BOOL = "bool";
}