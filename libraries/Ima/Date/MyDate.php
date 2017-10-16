<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\Date;

use Symfony\Component\Yaml\Yaml;
use DateTime;

class MyDate {
    
    private static $timezone;
    
    public static function getDate($offsetDays=0) {
        MyDate::loadParameters();
        date_default_timezone_set(MyDate::$timezone);        
        return date("Y-m-d H:i:s",strtotime(date('Y-m-d H:i:s').'+'.$offsetDays.' days'));
    }
    
    private static function loadParameters() {
        $yaml = new Yaml();
        $outputyaml = $yaml->parse('configuration/datetime.yml');
        MyDate::$timezone = $outputyaml['parameters']['time_zone'];
    }
    
    public static function timeDifference(DateTime $date) {
        $now = new DateTime(MyDate::getDate());
        $venta_time = $date;
        $diff = $now->diff($venta_time);
        if($diff->format("%a") == 1) {
            return $diff->format("Ayer");
        } else if($diff->format("%a") < 7) {
            return $diff->format("Hace %a días");
        } else if($diff->format("%a") < 14) {
            return "Hace 1 semana";
        } else if($diff->format("%m") < 1){
            return "Hace " . floor($diff->format("%a")/7) . " semanas";
        } else if($diff->format("%m")==1){
            return $diff->format("Hace %m mes %d días");
        } else {
            if($diff->format("%d")==0) {
                return $diff->format("Hace %m meses");
            } else {
                return $diff->format("Hace %m meses %d días");
            }
        }
    }
}
?>