<?php

namespace src\config;

use Dotenv\Dotenv;

class Settings{

    public static function loadSettings()
    {
        $dotenv = Dotenv::createImmutable("../");
        $dotenv->load();
    }
}