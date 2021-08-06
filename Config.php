<?php

class Config
{
    static $confArray;

    public static function read($name)
    {
        return self::$confArray[$name];
    }

    public static function write($name, $value)
    {
        self::$confArray[$name] = $value;
    }
}

Config::write('routee.curlcainfo', 'C:\\wamp64\\bin\\php\\php7.3.12\\extras\\ssl\\cacert.pem');
Config::write('openweathermap.accesstokenurl', 'http://api.openweathermap.org/data/2.5/weather');
Config::write('routee.accesstokenurl', 'https://auth.routee.net/oauth/token');
Config::write('routee.smsurl', 'https://connect.routee.net/sms');

