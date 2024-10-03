<?php

namespace Config;

class openApiConf
{
    public static function config(): array
    {
        return [
            'openapi' => '3.1.0',
            'info' => [
                'title' => 'Your API Title',
                'description' => 'Your API Description',
                'version' => '1.0.0',
            ],
            'paths' => [
                APPPATH . 'Controllers',
            ],
        ];
    }
}
