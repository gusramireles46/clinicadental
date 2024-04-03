<?php
session_start();
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'clinicadental');
define('DB_USER', 'clinicadental');
define('DB_PASSWORD', '@admin');
define('DB_PORT', '3306');

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
