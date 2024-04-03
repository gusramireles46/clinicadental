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
        return 1024000;
    }

    function getImageType()
    {
        return array('image/png', 'image/jpeg');
    }
}
