<?php

namespace src\config;

class Settings{

    public static function loadSettings()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }
}