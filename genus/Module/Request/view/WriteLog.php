<?php  
/** 
 * 日志类 
 * 
 * @package    log 
 * @version    $Id$ 
 */
 
define('DS', DIRECTORY_SEPARATOR);                 // 设置目录分隔符  
define('LOG_PATH',dirname(__FILE__).DS.'log'.DS); // 日志文件目录 
   
class Log  
{  
    /** 
     * 单个日志文件大小限制 
     * 
     * @var int 字节数 
     */  
    private static $i_log_size = 2097152; // 1024 * 1024 * 2 = 2M  
      
    /** 
     * 设置单个日志文件大小限制 
     *  
     * @param int $i_size 字节数 
     */  
    public static function set_size($i_size)  
    {  
        if( is_numeric($i_size) ){  
            self::$i_log_size = $i_size;  
        }  
    }  
  
    /** 
     * 写日志 
     * 
     * @param string $s_message 日志信息 
     * @param string $s_type    日志类型 
     */  
    public static function writeLog($s_message, $s_type = 'log')  
    {  
        // 检查日志目录是否可写  
         if ( !file_exists(LOG_PATH) ) {  
            @mkdir(LOG_PATH);       
        }  
         chmod(LOG_PATH,0777);  
        if (!is_writable(LOG_PATH)) exit('LOG_PATH is not writeable !');  
        $s_now_time = date('[Y-m-d H:i:s]');  
        $s_now_day  = date('Y_m_d');  
        // 根据类型设置日志目标位置  
        $s_target   = LOG_PATH;  
        switch($s_type)  
        {  
            case 'debug':  
                $s_target .= 'Out_' . $s_now_day . '.log';  
                break;  
            case 'error':  
                $s_target .= 'Err_' . $s_now_day . '.log';  
                break;  
            case 'log':  
                $s_target .= 'Log_' . $s_now_day . '.log';  
                break;  
            default:  
                $s_target .= 'Log_' . $s_now_day . '.log';  
                break;  
        }  
          
        //检测日志文件大小, 超过配置大小则重命名  
        if (file_exists($s_target) && self::$i_log_size <= filesize($s_target)) {  
            $s_file_name = substr(basename($s_target), 0, strrpos(basename($s_target), '.log')). '_' . time() . '.log';  
            rename($s_target, dirname($s_target) . DS . $s_file_name);  
        }  
        clearstatcache();  
        if(is_array($s_message))
        {
        	$jsondata=json_encode($s_message);
        	$s_message=$jsondata;
        }
        // 写日志, 返回成功与否  
        return error_log("$s_now_time $s_message\n", 3, $s_target);  
    }  
}