<?php

namespace src\config;

use Dotenv\Dotenv;

class Settings{

    public static function loadSettings(): void
    {
        $dotenv = Dotenv::createImmutable("../");
        $dotenv->load();
    }
}