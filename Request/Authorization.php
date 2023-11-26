<?php

namespace App\Mailing\unisender\Request;

use App\Mailing\unisender\Api\ApiTools;

class Authorization extends ApiTools{
    /** @var string API access key */
    protected $api_key;
    /** @var string API server message language (currently supported ru, en, ua) */
    protected $lang;

    public function __construct(string $api_key, string $lang){
        $this->api_key = $api_key;
        $this->lang = $lang;
    }

    /**
     * Get unisender api host
     * @return string
     */
    protected function getApiHost(){
        return sprintf('https://api.unisender.com/%s/api/', $this->lang);
    }
}