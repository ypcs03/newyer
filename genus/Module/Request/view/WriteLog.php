<?php  
/** 
 * ��־�� 
 * 
 * @package    log 
 * @version    $Id$ 
 */
 
define('DS', DIRECTORY_SEPARATOR);                 // ����Ŀ¼�ָ���  
define('LOG_PATH',dirname(__FILE__).DS.'log'.DS); // ��־�ļ�Ŀ¼ 
   
class Log  
{  
    /** 
     * ������־�ļ���С���� 
     * 
     * @var int �ֽ��� 
     */  
    private static $i_log_size = 2097152; // 1024 * 1024 * 2 = 2M  
      
    /** 
     * ���õ�����־�ļ���С���� 
     *  
     * @param int $i_size �ֽ��� 
     */  
    public static function set_size($i_size)  
    {  
        if( is_numeric($i_size) ){  
            self::$i_log_size = $i_size;  
        }  
    }  
  
    /** 
     * д��־ 
     * 
     * @param string $s_message ��־��Ϣ 
     * @param string $s_type    ��־���� 
     */  
    public static function writeLog($s_message, $s_type = 'log')  
    {  
        // �����־Ŀ¼�Ƿ��д  
         if ( !file_exists(LOG_PATH) ) {  
            @mkdir(LOG_PATH);       
        }  
         chmod(LOG_PATH,0777);  
        if (!is_writable(LOG_PATH)) exit('LOG_PATH is not writeable !');  
        $s_now_time = date('[Y-m-d H:i:s]');  
        $s_now_day  = date('Y_m_d');  
        // ��������������־Ŀ��λ��  
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
          
        //�����־�ļ���С, �������ô�С��������  
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
        // д��־, ���سɹ����  
        return error_log("$s_now_time $s_message\n", 3, $s_target);  
    }  
}