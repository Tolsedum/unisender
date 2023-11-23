<?php

namespace App\Mailing\Unisender\Enum;

class RequestErrors{
    const UNSPECIFIED = "unspecified";
    const INVALID_API_KEY = "invalid_api_key";
    const ACCESS_DENIED = "access_denied";
    const UNKNOWN_METHOD = "unknown_method";
    const INVALID_ARG = "invalid_arg";
    const NOT_ENOUGH_MONEY = "not_enough_money";
    const RETRY_LATER = "retry_later";
    const API_CALL_LIMIT_EXCEEDED_FOR_API_KEY = "api_call_limit_exceeded_for_api_key";
    const API_CALL_LIMIT_EXCEEDED_FOR_IP = "api_call_limit_exceeded_for_ip";
}