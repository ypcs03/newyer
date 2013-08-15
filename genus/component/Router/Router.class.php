<?php if (!defined('BASE_PATH')) exit('Forbidden');
/**
 * ·�����ļ�
 * ֧��һ�����ļ��з���·��
 * 
 * @author Kim Long <iFooSharp@gmail.com>
 * @category router
 * @copyright Copyright(c) 2010 http://www.foosharp.com
 * @version $Id$
 */
 
class Router {
    private $classc    = '';
    private $method    = '';
    private $directory = '';
    private $ctrlTriger    = '';
    private $methodTriger  = '';
    private $dirTriger     = '';
    private $uri       = null;
    private $args      = array();
    
    public function __construct()
    {
        $this -> ctrlTriger   = get_config('ctrl_triger','c');
        $this -> methodTriger = get_config('method_triger','m');
        $this -> dirTriger    = get_config('dir_triger','d');
        $this -> classc       = get_config('default_ctrl','index');
        $this -> method       = get_config('default_ctrl_method','main');
        $this -> uri          =& load_class('uri'); 
    }
    /**
     * ����Ĭ�Ͽ��������Ʋ���֤��Ч��
     * 
     * @access public
     * @param string $className
     * @return void
     */
    public function setClass($className = '')
    {
        $this -> classc = valid_variable($className);
    }
    /**
     * ����Ĭ�Ͽ������������Ʋ���֤��Ч��
     * 
     * @access public
     * @param string $methodName
     * @return void
     */
    public function setMethod($methodName = '')
    {
        $this -> method = valid_variable($methodName);
    }
    /**
     * ����Ĭ��������Ŀ¼
     * 
     * @access public
     * @param string $className
     * @return void
     */
    public function setCtrlDir($name = '')
    {
        $this -> directory = valid_variable($name);
    }
    /**
     * ����Ĭ�Ͽ���������get string���Ʋ���֤��Ч��
     * 
     * @access public
     * @param string $name
     * @return void
     */
    public function setCtrlTriger($name = '')
    {
        $this -> ctrlTriger = valid_variable($name);
    }
    /**
     * ����Ĭ�Ͽ�������������get string���Ʋ���֤��Ч��
     * 
     * @access public
     * @param string $name
     * @return void
     */
    public function setMethodTriger($name = '')
    {
        $this -> methodTriger = valid_variable($name);
    }
    /**
     * ����Ĭ�Ͽ�����Ŀ¼����get string���Ʋ���֤��Ч��
     * 
     * @access public
     * @param string $name
     * @return void
     */
    public function setDirTriger($name = '')
    {
        $this -> dirTriger = valid_variable($name);
    }
    /**
     * ��ȡ��ǰ·������Ҫ���õ�Controller
     * 
     * @access public
     * @return string
     */
    public function getClass()
    {
        return $this -> classc;
    }
    /**
     * ��ȡ��ǰ·������Ҫ���õ�Controller�еķ���
     * 
     * @access public
     * @return string
     */
    public function getMethod()
    {
        return $this -> method;
    }
    /**
     * ��ȡ��ǰ·���а���controller����Ŀ¼
     * 
     * @access public
     * @return string
     */
    public function getCtrlDir()
    {
        return $this -> directory;
    }
    /**
     * ��ȡURI��������
     * 
     * @access public
     * @return array
     */
    public function getArgs()
    {
        return $this -> args;
    }
    /**
     * ������ǰ·��
     * ���Ȼ�ȡPATH_INFO����
     * 
     * @access public
     * @param array $config
     * @return void
     */
    public function parseRouting($config = array())
    {
        $this -> args = $this -> uri -> getParams();
        if(empty($this -> args))
        {
            return;
        }
        //config���Դ�router.conf.php��ȡ
        foreach($config as $key => $val)
        {
            if(array_key_exists($key, $this -> args))
            {
                $this -> args[$key] = $val;
            }
        }
        //��ֻ��һ��URI����ʱ
        if(count($this -> args) == 1)
        {
            $key = key($this -> args);
            if(empty($this -> args[$key]))
            {
                $this -> setClass($key);
            }
            else
            {
                $this -> setClass($this -> args[$key]);
            }
        }
        //���и���URI����ʱ
        else
        {
            $first  = $this -> args[0];
            $second = $this -> args[1];
            $third  = $this -> args[2];
            
            if(null !== $first)
            {
                if(is_dir(APP_PATH . 'controllers/' . valid_variable($first)))
                {
                    $this -> setCtrlDir($first); 
                    
                    if(null !== $second)
                    {
                        $this -> setClass($second); 
                    }
                    if(null !== $third)
                    {
                        $this -> setMethod($third); 
                        return;
                    }
                }
                else
                {
                    $this -> setClass($first); 
                    if(null !== $second)
                    {
                        $this -> setMethod($second); 
                        return;
                    }
                }
            }
            /*��������������Ч��*/
            $dir    = $this -> args[$this->dirTriger];
            $class  = $this -> args[$this->ctrlTriger];
            $method = $this -> args[$this->methodTriger];
            
            if($dir !== null)
            {
                $this -> setCtrlDir($dir); 
            }
            
            if($class !== null)
            {
                $this -> setClass($class); 
            }
            
            if($method !== null)
            {
                $this -> setMethod($method); 
            }
        }
    }

} 
 
 
/* End of file router.class.php */ 