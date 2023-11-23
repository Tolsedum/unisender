<?php

namespace App\Mailing\Unisender;

use Exception;
use ReflectionClass;

class ExceptionUnisender extends Exception{
    const EMPTY_PAEAMS = 1;

    protected function getDescription(int $error_num = null){
        if(is_null($error_num)){
            return [
                self::EMPTY_PAEAMS => "Empty params",
                
            ];
        }else{
            $refl = new ReflectionClass(get_called_class());
            $list_const = $refl->getConstant();
            
        }
    }
    
    public function __construct(int $error_num){
        $message = $this->getDescription();
    }
}