<?php

namespace App\Mailing\Unisender\Request;

use App\Mailing\Unisender\Api\Contacts;
use App\Mailing\Unisender\Request\Authorization;

class URequest extends Authorization{
    use Contacts;


    public function __construct(string $api_key, string $lang){
        parent::__construct($api_key, $lang);
    }
}