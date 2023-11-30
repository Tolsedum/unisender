<?php

namespace App\Mailing\unisender\Request;

use App\Mailing\unisender\Request\Authorization;

class UManager extends Authorization{
    protected $compression;

    public function __construct(string $api_key, string $lang = "ru"){
        parent::__construct($api_key, $lang);
    }

    public function compresData($request_params){
        $url = "";
        if ($this->compression) {
            $url = '&request_compression=bzip2';
            $content = bzcompress(http_build_query($request_params));
        } else {
            $params = array_merge((array) $request_params, ['api_key' => $this->api_key]);
            $content = http_build_query($params);
        }
        return ["url" => $url, "content" => $content];
    }
}