<?php

namespace mcpe\msg;

class convert
{

    public static function convertTime($sec): string{ //convert time return string แล้วไป explode : ออกเอานะครับ
        $hours = $sec / 3600; //devide by 3600
        $minutes = ($sec % 3600) / 60;
        $seconds = $sec % 60;
        return $hours.":".$minutes.":".$seconds;
    }

}