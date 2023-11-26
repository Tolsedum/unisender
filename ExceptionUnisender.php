<?php

namespace App\Mailing\unisender;

use Exception;

class ExceptionUnisender extends Exception{
    protected $language_local = "ru";

    const UNSPECIFIED = "unspecified";
    const INVALID_API_KEY = "invalid_api_key";
    const ACCESS_DENIED = "access_denied";
    const UNKNOWN_METHOD = "unknown_method";
    const INVALID_ARG = "invalid_arg";
    const NOT_ENOUGH_MONEY = "not_enough_money";
    const RETRY_LATER = "retry_later";
    const API_CALL_LIMIT_EXCEEDED_FOR_API_KEY = "api_call_limit_exceeded_for_api_key";
    const API_CALL_LIMIT_EXCEEDED_FOR_IP = "api_call_limit_exceeded_for_ip";
    const EMPTY_PARAMS = "empty_params";

    protected function getLanguageVarList(){
        $file_name = "../app/Mailing/unisender/language_vars/errors."
            . $this->language_local
            . ".json";
        return json_decode(file_get_contents($file_name), true);
    }
    
    protected function getDescription(string $error_code, string $message){
        $lang_var = $this->getLanguageVarList();
        if(isset($lang_var[$error_code])){
            return $lang_var[$error_code] . " {$message}";
        }
    }
    
    public function __construct(string $error_code, $message = ""){
        $message = $this->getDescription($error_code, $message);
        parent::__construct($message, 1);
    }
}