<?php
session_start();
const DB_DRIVER = 'mysql';
const DB_HOST = 'localhost';
const DB_NAME = 'clinicadental';
const DB_USER = 'clinicadental';
const DB_PASSWORD = '@admin';
const DB_PORT = '3306';

class Config
{
    function getImageSize()
    {
        $size = 2;
        return $size * 1024 * 1024;
    }

    function getImageType()
    {
        return array('image/png', 'image/jpeg');
    }
}
