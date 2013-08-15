<?php if (!defined('BASE_PATH')) exit('Forbidden');
/**
 * 路由类文件
 * 支持一个子文件夹访问路由
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
     * 设置默认控制器名称并验证有效性
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
     * 设置默认控制器方法名称并验证有效性
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
     * 设置默控制器子目录
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
     * 设置默认控制器触发get string名称并验证有效性
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
     * 设置默认控制器方法触发get string名称并验证有效性
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
     * 设置默认控制器目录触发get string名称并验证有效性
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
     * 获取当前路由中需要调用的Controller
     * 
     * @access public
     * @return string
     */
    public function getClass()
    {
        return $this -> classc;
    }
    /**
     * 获取当前路由中需要调用的Controller中的方法
     * 
     * @access public
     * @return string
     */
    public function getMethod()
    {
        return $this -> method;
    }
    /**
     * 获取当前路由中包含controller的子目录
     * 
     * @access public
     * @return string
     */
    public function getCtrlDir()
    {
        return $this -> directory;
    }
    /**
     * 获取URI参数数组
     * 
     * @access public
     * @return array
     */
    public function getArgs()
    {
        return $this -> args;
    }
    /**
     * 解析当前路由
     * 优先获取PATH_INFO参数
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
        //config可以从router.conf.php读取
        foreach($config as $key => $val)
        {
            if(array_key_exists($key, $this -> args))
            {
                $this -> args[$key] = $val;
            }
        }
        //当只有一个URI参数时
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
        //当有更多URI参数时
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
            /*在这里声明提升效率*/
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