<?php

class SensorsData
{
    public static function getBPM()
    {
        return(rand(35, 140));
    }

    public static function getHumidity()
    {
        return(rand(25, 75));
    }

    public static function getTemp()
    {
        return(rand(15, 35));
    }

    public static function getSound()
    {
        return(rand(0, 30));
    }

}