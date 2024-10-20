<?php

namespace Swagger\Config;

class openApiConf
{
    public static function config(): array
    {
        return [
            'openapi' => '3.0.0',
            'info' => [
                'title' => 'Open Api CodeIgniter',
                'description' => 'Your API Description',
                'version' => '1.0.0',
            ],
            'servers' => [
                'url' => 'https://api.example.com/v1'
            ],
            'paths' => [
                APPPATH . 'Controllers',
                APPPATH . 'Models',
                APPPATH . 'Entities',
                APPPATH . 'ThirdParty/Swagger/src/Controllers'
            ],
        ];
    }
}
