<?php

Namespace Helpers
{
    Final Class Validate
    {
        public static function payload()
        {
            $config = json_decode(file_get_contents(APP_PATH . '/src/config/generic/validation.json'));

        }
    }
}