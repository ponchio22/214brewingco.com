<?php

namespace Ima\MySql;

/**
 * MySqlLog
 * @author lpena
 */
class MySqlLog {
    
    private static $logs = array();
    
    public static function addLog($log) {
        MySqlLog::$logs[] = $log;
    }
    
    public static function getLogs() {
        return MySqlLog::$logs;
    }
}
