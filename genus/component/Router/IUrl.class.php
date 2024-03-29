 
<?php
/**
 * @copyright (c) 2011 jooyea.net
 * @file urlmanager_class.php
 * @brief URL处理类
 * @author walu
 * @date 2011-07-18
 * @version 0.7
 * @note
 */
/**
 * @class IUrl
 * @brief URL处理类
 * @note
 */
class IUrl
{
 const UrlNative  = 1; //原生的Url形式,指从index.php，比如index.php?controller=blog&action=read&id=100
 const UrlPathinfo = 2; //pathinfo格式的Url,指的是：/blog/read/id/100
 const UrlDiy  = 3; //经过urlRoute后的Url,指的是:/blog-100.html
 
 const UrlCtrlName = 'controller';
 const UrlActionName = 'action';
 const UrlModuleName = 'module';
 
 const Anchor = "/#&"; //urlArray中表示锚点的索引
 
 const QuestionMarkKey = "?"; // /site/abc/?callback=/site/login callback=/site/login部分在UrlArray里的key
 
 /**
  * 获取当前Controller、action、module的信息
  * @param string $key controller或者action或者module
  * @return string|null
  */
 public static function getInfo($key)
 {
  $arr = array(
   'controller'=>self::UrlCtrlName,
   'action'=>self::UrlActionName,
   'module'=>self::UrlModuleName
  );
  if(isset($arr[$key]))
  {
   return IReq::get( $arr[$key] );
  }
  return null;
 }
 
 /**
  * 将Url从IWeb支持的一种Url格式转成另一个格式。
  * @param string $url 想转换的url
  * @param int $from IUrl::UrlNative或者.....
  * @param int $to IUrl::UrlPathinfo或者.....
  * @return string 如果转换失败则返回false
  */
 public static function convertUrl($url,$from,$to)
 {
  if($from == $to)
  {
   return $url;
  }
  
  $urlArray = "";
  $fun_re = false;
  switch($from)
  {
   case self::UrlNative :
    $urlTmp = parse_url($url); 
    $urlArray = self::queryStringToArray($urlTmp); 
    break;
   case self::UrlPathinfo :
    $urlArray = self::pathinfoToArray($url);
    break;
   case self::UrlDiy :
    $urlArray = self::diyToArray($url);
    break;
   default:
    return $fun_re;
    break;
  }
  
  switch($to)
  {
   case self::UrlNative :
    $fun_re = self::urlArrayToNative($urlArray);
    break;
   
   case self::UrlPathinfo :
    $fun_re = self::urlArrayToPathinfo($urlArray);
    break;
   
   case self::UrlDiy:
    $fun_re = self::urlArrayToDiy($urlArray);
    break;
  }
  return $fun_re;
 }
 
 /**
  * 将controller=blog&action=read&id=100类的query转成数组的形式
  * @param string $url
  * @return array
  */
 public static function queryStringToArray($url)
 {
  if(!is_array($url))
  {
   $url = parse_url($url);
  }
  $query = isset($url['query'])?explode("&",$url['query']):array();
  $re = array();
  foreach($query as $value)
  {
   $tmp = explode("=",$value);
   if( count($tmp) == 2 )
   {
    $re[$tmp[0]] = $tmp[1];
   }
  }
  $re = self::sortUrlArray($re);
  isset($url['fragment']) && ($re[self::Anchor] = $url['fragment'] );
  return $re;
 }
 
 /**
  * 将/blog/read/id/100形式的url转成数组的形式
  * @param string $url
  * @return array
  */
 public static function pathinfoToArray($url)
 {
  //blog/read/id/100
  //blog/read/id/100?comment=true#abcde
  $data = array();
  preg_match("!^(.*?)?(\\?[^#]*?)?(#.*)?$!",$url,$data);
  $re = array();
  if( isset($data[1]) && trim($data[1],"/ "))
  {
   $string = explode("/", trim($data[1],"/ ")   );
   $key = null;
   $i = 1;
   //前两个是ctrl和action，后面的是参数名和值
   foreach($string as $value)
   {
    if($i <= 2  )
    {
     $tmpKey = ($i==1) ? self::UrlCtrlName : self::UrlActionName;
     $re[$tmpKey] = $value;
     $i ++ ;
     continue;
    }
    if($key === null)
    {
     $key = $value;
     $re[$key]="";
    }
    else
    {
     $re[$key] = $value;
     $key = null;
    }
   }
  }
  if( isset($data[2]) || isset($data[3]) )
  {
   $re[ self::QuestionMarkKey ] = ltrim($data[2],"?");
  }
  
  if(isset($data[3]))
  {
   $re[ self::Anchor ] = ltrim($data[3],"#");
  }
  $re = self::sortUrlArray($re);
  return $re;
  
 }
 
 /**
  * 将用户请求的url进行路由转换，得到urlArray
  * @param string  $url
  * @return array
  */
 public static function diyToArray($url)
 {
  return self::decodeRouteUrl($url);
 }
 
 /**
  * 对Url数组里的数据进行排序
  * ctrl和action最靠前，其余的按key排序
  * @param array $re
  * @access private
  */
 private static function sortUrlArray($re)
 {
  $fun_re=array();
  isset( $re[self::UrlCtrlName] ) && ($fun_re[self::UrlCtrlName]=$re[self::UrlCtrlName]);
  isset( $re[self::UrlActionName] ) && ($fun_re[self::UrlActionName]=$re[self::UrlActionName]);
  unset($re[self::UrlCtrlName],$re[self::UrlActionName]);
  ksort($re);
  $fun_re = array_merge($fun_re,$re);
  return $fun_re;
 }
 
 /**
  * 将urlArray用pathinfo的形式表示出来
  * @access private
  */
 private static function urlArrayToPathinfo($arr)
 {
  $re = "";
  $ctrl = isset($arr[self::UrlCtrlName])   ? $arr[self::UrlCtrlName]   : '';
  $action = isset($arr[self::UrlActionName]) ? $arr[self::UrlActionName] : '';
  
  $ctrl   != "" && ($re.="/{$ctrl}");
  $action != "" && ($re.="/{$action}");
  
  $fragment = isset($arr[self::Anchor]) ? $arr[self::Anchor] : "";
  $questionMark = isset($arr[self::QuestionMarkKey]) ? $arr[self::QuestionMarkKey] : "";
  unset($arr[self::UrlCtrlName],$arr[self::UrlActionName],$arr[self::Anchor]);
  foreach($arr as $key=>$value)
  {
   $re.="/{$key}/{$value}";
  }
  if($questionMark != "")
  {
   $re .= "?". $questionMark;
  }
  $fragment != "" && ($re .= "#{$fragment}");
  return $re;
 }
 
 /**
  * 将urlArray用原生url形式表现出来
  * @access private
  */
 private static function urlArrayToNative($arr)
 {
  $re = "/";
  $re .= self::getIndexFile();
  $fragment = isset($arr[self::Anchor]) ? $arr[self::Anchor] : "";
  $questionMark = isset($arr[self::QuestionMarkKey]) ? $arr[self::QuestionMarkKey] : "";
  
  unset($arr[self::Anchor] , $arr[self::QuestionMarkKey]  );
  if(count($arr))
  {
   $tmp = array();
   foreach($arr as $key=>$value)
   {
    $tmp[] ="{$key}={$value}";
   }
   $tmp = implode("&",$tmp);
   $re .= "?{$tmp}";
  }
  if( count($arr) && $questionMark!="" )
  {
   $re .= "&".$questionMark;
  }
  elseif($questionMark!="")
  {
   $re .= "?".$questionMark;
  }
  if($fragment != "")
  {
   $re .= "#{$fragment}";
  }
  return $re;
 }
 
 /**
  * 将urlArray转成路由后的url
  * @access private
  */
 private static function urlArrayToDiy($arr)
 {
  $config = self::routeConfigWithSort();
  if(!isset( $arr[self::UrlCtrlName] ) || !isset($arr[self::UrlActionName])  )
  {
   return false;
  }
  $ctrl = $arr[ self::UrlCtrlName ];
  $action = $arr[ self::UrlActionName ];
  $sonConfig = array();
  $arrCopy = $arr;
  unset($arrCopy[ self::UrlCtrlName ] , $arrCopy[ self::UrlActionName ] , $arrCopy[self::Anchor] );
  foreach($config as $value)
  {
   $tmp = preg_match("!^{$value['controller']}$!i",$ctrl) && preg_match("!^{$value['action']}$!i",$action);
   if( $tmp )
   {
    //value['keys']要和arrCopy中有一样的参数才进行转换
    !isset($value['keys']) && ($value['keys'] = array());
    $tmp = array_flip($value['keys']);
    $tmp = array_merge($tmp,$arrCopy);
    if(count($tmp) != count($arrCopy))
    {
     continue;
    }
    $sonConfig = $value;
    break;
   }
  }
  if(!$sonConfig)
  {
   return false;
  }
  $url = $sonConfig['url'];
  $sonConfig['keys'][] = 'controller';
  $sonConfig['keys'][] = 'action';
  //防止以后url中的controller和action改名
  $arr['controller'] = $arr[self::UrlCtrlName];
  $arr['action'] = $arr[self::UrlActionName];
  foreach($sonConfig['keys'] as $value)
  {
   $url = preg_replace("!<{$value}[^>]*?(?<=/)>!" , $arr[$value] , $url );
  }
  return $url;
 }
 
 /**
  * 将请求的url通过路由规则解析成urlArray
  */
 private static function decodeRouteUrl($url)
 {
  $config = self::routeConfigWithSort();
  $regExp = "";
  $urlArray = array();
  foreach($config as $key=>$value)
  {
   $regExp = self::routeUrlToRegexp($value['url']);
   if(preg_match( $regExp , $url , $m  ))
   {
    foreach($m as $k=>$v)
    {
     if(!is_int($k))
     {
      $urlArray[ $k ] = $v;
     }
    }
    if(!self::isReg($value['controller']) )
    {
     $urlArray[ self::UrlCtrlName ] = $value['controller'];
    }
    if(!self::isReg($value['action']))
    {
     $urlArray[ self::UrlActionName ] = $value['action'];
    }
    
    break;
   }
  }
  return $urlArray;
 }
 
 /**
  * 返回经过排序的routeConfig
  * 针对controller\action：
  * 1.两者都不是正则
  * 2.controller具体，action正则 此项中的url必须有<action/>
  * 3.controller正则，action具体 此项中的url必须有<controller/>
  * 4.controller和action都正则 此项中的url必须有<controller/>、<action/>
  * 
  * @return array()
  */
 private static function routeConfigWithSort()
 {
  $config = isset(IWeb::$app->config['urlRoute']) ? IWeb::$app->config['urlRoute'] : array();
  $sort = array( );
  foreach($config as $rkey => $value)
  {
   if(isset($value['enable']) && $value['enable'] == false )
   if(!isset($value['controller']) || !isset($value['action']) || !isset($value['url']) )
   {
    trigger_error("路由规则[{$rkey}]无效，因为缺少controller、action、url中的某一项。",E_USER_WARNING);
    continue;
   }
   $flagCtrl =(int) self::isReg($value['controller']);
   $flagAction =(int) self::isReg($value['action']);
   
   if( $flagCtrl == 1 && strpos($value['url'],"<controller/>" )===false  )
   {
    trigger_error("路由规则[{$key}]无效，因为controller采用正则，但是url中没有<controller/>。",E_USER_WARNING);
    continue;
   }
   if( $flagAction == 1 && strpos($value['url'] , "<action/>" ) === false )
   {
    trigger_error("路由规则[{$rkey}]无效，因为action采用正则，但是url中没有<action/>。",E_USER_WARNING);
    continue;
   }

   $key = $flagCtrl*10 + $flagAction;
   $sort[$key][] = $value;
  }
  $fun_re =array();
  foreach( array(0,1,10,11) as $value )
  {
   if(!isset($sort[$value]))
   {
    continue;
   }
   //不要用merge
   foreach($sort[$value] as $v  )
   {
    $fun_re[] = $v;
   }
  }
  return $fun_re;
 }
 private static function isReg($str)
 {
  return !preg_match("!^[-_a-z0-9]+$!i",$str);
 }
 /**
  * 将用户定义的urlRoute规则转成正则
  * @access private
  */
 private static function routeUrlToRegexp($url)
 {
  /*增加缓存区*/
  static $cache = array();
  if(isset($cache[$url]))
  {
   return $cache[$url];
  }
  $url_key_cache = $url;
  //url=>'product-<id:[0-9]+/>.html'
  $url =  preg_replace("!<(.*?)/>!",'<?php $t="\1";?>',$url);
  $phpToken = token_get_all($url);
  $unsetToken = array(T_OPEN_TAG,T_CLOSE_TAG,T_VARIABLE);
  $pos = false;
  foreach($phpToken as $key => $value)
  {
   if( !is_array($value) || in_array($value[0],$unsetToken)   )
   {
    unset($phpToken[$key]);
    continue;
   }
   elseif( $value[0] == T_INLINE_HTML )
   {
    $phpToken[$key] = preg_quote($value[1]);
   }
   elseif( $value[0] == T_CONSTANT_ENCAPSED_STRING )
   {
    $value[1] = trim($value[1],'"\'');
    if( ($pos=strpos($value[1],':')) !==false )
    {
     $tmpKey = substr($value[1], 0,$pos  );
     $tmpValue = substr($value[1], $pos+1  );
     $phpToken[$key] = "(?P<{$tmpKey}>{$tmpValue}*?)";
    }
    else
    {
     $phpToken[$key] = "(?P<{$value[1]}>.*?)";
    }
   }
  }
  $regexp = "";
  foreach($phpToken as $value)
  {
   $regexp .= $value;
  }
  $re = "!".$regexp."!i";
  $cache[$url_key_cache] = $re;
  return $re;
 }
 
 
 public static function tidy($url)
 {
  return preg_replace("![/\\\\]{2,}!","/",$url);
 }
 
 /**
  * @brief  接收基准格式的URL，将其转换为Config中设置的模式
  * @param  String $url      传入的url
  * @return String $finalUrl url地址
  */
 public static function creatUrl($url='')
 {
  $baseUrl = self::getPhpSelf();
  if($url == "")
  {
   return self::getScriptDir();
  }
  elseif($url == "/")
  {
   return  self::getScriptDir().$baseUrl;
  }
  
  $rewriteRule = isset(IWeb::$app->config['rewriteRule'])?IWeb::$app->config['rewriteRule']:'native';
  
  //判断是否需要返回绝对路径的url
  $baseDir = self::getScriptDir();
  $baseUrl = self::tidy($baseUrl);
  $url = self::tidy($url);
  if($url[0] != "/")
  {
   
  }
  $tmpUrl = false;
  if($rewriteRule == 'pathinfo' )
  {
   $tmpUrl = self::convertUrl($url,self::UrlPathinfo , self::UrlDiy);
  }
  if($tmpUrl!==false)
  {
   $url = $tmpUrl;
  }
  else
  {
   switch($rewriteRule)
   {
    case 'url': // 兼容以前的
    case 'get': //config文件里叫get
     $url = self::convertUrl($url,self::UrlPathinfo,self::UrlNative);
     break;
    case 'url-pathinfo':
     $url = "/".self::getIndexFile().$url;
     break;
   }
  }
  $url = self::tidy($baseDir.$url);
  return $url;
 }
  
 /**
  * @brief 获取网站根路径
  * @param  string $protocol 协议  默认为http协议，不需要带'://'
  * @return String $baseUrl  网站根路径
  *
  */
 public static function getHost($protocol='http')
 {
  $port    = $_SERVER['SERVER_PORT'] == 80 ? '' : ':'.$_SERVER['SERVER_PORT'];
  $baseUrl = $protocol.'://'.strtolower($_SERVER['SERVER_NAME']?$_SERVER['SERVER_NAME']:$_SERVER['HTTP_HOST']).$port;
  return $baseUrl;
 }
 /**
  * @brief 获取当前执行文件名
  * @return String 文件名
  */
 public static function getPhpSelf()
 {
  $re = explode("/",$_SERVER['SCRIPT_NAME']);
  return end($re);
 }
 /**
  * @brief 返回入口文件URl地址
  * @return string 返回入口文件URl地址
  */
 public static function getEntryUrl()
 {
  return self::getHost().$_SERVER['SCRIPT_NAME'];
 }
 
 /**
  * @brief 获取入口文件名
  */
 public static function getIndexFile()
 {
  if(!isset($_SERVER['SCRIPT_NAME']))
  {
   return 'index.php';
  }
  else
  {
   return basename($_SERVER['SCRIPT_NAME']);
  }
 }
 /**
  * @brief 返回页面的前一页路由地址
  * @return string 返回页面的前一页路由地址
  */
 public static function getRefRoute()
 {
  if(isset($_SERVER['HTTP_REFERER']) && (self::getEntryUrl() & $_SERVER['HTTP_REFERER']) == self::getEntryUrl())
  {
   return substr($_SERVER['HTTP_REFERER'],strlen(self::getEntryUrl()));
  }
  else
   return '';
 }
 /**
  * @brief  获取当前脚本所在文件夹
  * @return 脚本所在文件夹
  */
 public static function getScriptDir()
 {
  $re=trim(dirname($_SERVER['SCRIPT_NAME']),'\\');
  if($re!='/')
  {
   $re = $re."/";
  }
  return $re;
 }
 /**
  * @brief 获取当前url地址[经过RewriteRule之后的]
  * @return String 当前url地址
  */
 public static function getUrl()
 {
  if (isset($_SERVER['HTTP_X_REWRITE_URL']))
  {
   // check this first so IIS will catch
   $requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
  }
  elseif(isset($_SERVER['IIS_WasUrlRewritten']) && $_SERVER['IIS_WasUrlRewritten'] == '1' && isset($_SERVER['UNENCODED_URL'])       && $_SERVER['UNENCODED_URL'] != '')
  {
   // IIS7 with URL Rewrite: make sure we get the unencoded url (double slash problem)
   $requestUri = $_SERVER['UNENCODED_URL'];
  } 
  elseif (isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'],"Apache")!==false )
  {
   $requestUri = $_SERVER['PHP_SELF'];
  }
  elseif(isset($_SERVER['REQUEST_URI']))
  {
   $requestUri = $_SERVER['REQUEST_URI'];
  }
  elseif(isset($_SERVER['ORIG_PATH_INFO']))
  { 
   // IIS 5.0, PHP as CGI
   $requestUri = $_SERVER['ORIG_PATH_INFO'];
   if (!empty($_SERVER['QUERY_STRING']))
   {
    $requestUri .= '?' . $_SERVER['QUERY_STRING'];
   }
  }
  else
  {
   die("1111");
  }
  return self::getHost().$requestUri;
 }
 /**
  * @brief 获取当前URI地址
  * @return String 当前URI地址
  */
 public static function getUri()
 {
  if( !isset($_SERVER['REQUEST_URI']) ||  $_SERVER['REQUEST_URI'] == "" )
  {
   // IIS 的两种重写
   if (isset($_SERVER['HTTP_X_ORIGINAL_URL']))
   {
    $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];
   }
   else if (isset($_SERVER['HTTP_X_REWRITE_URL']))
   {
    $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
   }
   else
   {
    //修正pathinfo
    if ( !isset($_SERVER['PATH_INFO']) && isset($_SERVER['ORIG_PATH_INFO']) )
     $_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];

    if ( isset($_SERVER['PATH_INFO']) ) {
     if ( $_SERVER['PATH_INFO'] == $_SERVER['SCRIPT_NAME'] )
      $_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];
     else
      $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];
    }
    //修正query
    if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
    {
     $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
    }
   }
   }
  return $_SERVER['REQUEST_URI'];
 }
 /**
  * @brief 获取url参数
  * @param String url 需要分析的url，默认为当前url
  */
 public static function beginUrl($url='')
 {
  //四种
  //native： /index.php?controller=blog&action=read&id=100
  //pathinfo:/blog/read/id/100
  //native-pathinfo:/index.php/blog/read/id/100
  //diy:/blog-100.html
  $obj = IServerVars::factory($_SERVER['SERVER_SOFTWARE']);
  $url  = !empty($url)?$url:$obj->realUri();
  preg_match('/\.php(.*)/',$url,$phpurl);
  if(!isset($phpurl[1]) || !$phpurl[1])
  {
   if($url != "" )
   {
    //强行赋值
    //todo：检测是否有bug
    $phpurl = array(1=>"?");
   }
   else
   {
    return;
   }
  }
  $url = $phpurl[1];
  $urlArray = array();
  $rewriteRule = isset(IWeb::$app->config['rewriteRule'])?IWeb::$app->config['rewriteRule']:'native';
  if($rewriteRule!='native')
  {
   $urlArray = self::decodeRouteUrl($url);
  }
  if($urlArray == array())
  {
   if( $url[0] == '?' )
   {
   $urlArray = $_GET;
 //  $urlArray = self::queryStringToArray($url);
   }
   else
   {
    $urlArray = self::pathinfoToArray($url);
   }
  }
  if( isset($urlArray[self::UrlCtrlName]) )
  {
   $tmp = explode('-',$urlArray[self::UrlCtrlName]);
   if( count($tmp) == 2 )
   {
    IReq::set('module',$tmp[0]);
    IReq::set(self::UrlCtrlName , $tmp[1]);
   }
   else
   {
    IReq::set(self::UrlCtrlName , $urlArray[self::UrlCtrlName] );
   }
  }
  if( isset($urlArray[self::UrlActionName])  )
  {
   IReq::set(self::UrlActionName,$urlArray[self::UrlActionName]);
   if(IReq::get('action')=='run')
   {
    IReq::set('action',null);
   }
  }
  
  unset($urlArray[self::UrlActionName] , $urlArray[self::UrlActionName] , $urlArray[self::Anchor] );
  foreach($urlArray as $key=>$value)
  {
   IReq::set($key,$value);
  }
  }
 /**
  * @brief  获取拼接两个地址
  * @param  String $path_a
  * @param  String $path_b
  * @return string 处理后的URL地址
  */
 public static function getRelative($path_a,$path_b)
 {
  $path_a = strtolower(str_replace('\\','/',$path_a));
  $path_b = strtolower(str_replace('\\','/',$path_b));
  $arr_a = explode("/" , $path_a) ;
  $arr_b = explode("/" , $path_b) ;
  $i = 0 ;
  while (true)
  {
   if($arr_a[$i] == $arr_b[$i]) $i++ ;
   else break ;
  }
  $len_b = count($arr_b) ;
  $len_a = count($arr_a) ;
  if(!$arr_b[$len_b-1])$len_b = $len_b - 1;
  if(!$len_a[$len_a-1])$len_a = $len_a - 1;
  $len = ($len_b>$len_a)?$len_b:$len_a ;
  $str_a = '' ;
  $str_b = '' ;
  for ($j = $i ;$j<$len ;$j++)
  {
   if(isset($arr_a[$j]))
   {
    $str_a .= $arr_a[$j].'/' ;
   }
   if(isset($arr_b[$j])) $str_b .= "../" ;
  }
  return $str_b . $str_a ;
 }
}
//$_SERVER里与url有关的两个量的兼容处理方案
//这是个不成熟的解决方案，可能仅适用于本框架
interface IIServerVars
{
 /**
  * 获取REQUEST_URI
  * 标准：真实的从浏览器地址栏体现出来的url，不包括#锚点
  */
 public function requestUri();
 /**
  * 最终呈现给服务器的url
  * 标准：伪静态前与request_uri相同，伪静态后是最后一条规则调整后的url
  */
 public function realUri();
}
class IServerVars implements IIServerVars
{
 public static function factory($server_type)
 {
  $obj = null;
  $type = array(
   'apache' => 'IServerVars_Apache',
   'iis' => 'IServerVars_IIS' , 
   'nginx' => 'IServerVars_Nginx'
  );
  
  foreach($type as $key=>$value)
  {
   if(stripos($server_type,$key) !== false )
   {
    $obj = new $value($server_type);
    break;
   }
  }
  if($obj === null)
  {
   return new IServerVars();
  }
  else
  {
   return $obj;
  }
 }
 public function requestUri()
 {
  return $_SERVER['REQUEST_URI'];
 }
 public function realUri()
 {
  return $_SERVER['REQUEST_URI'];
 }
}
class IServerVars_Apache implements IIServerVars
{
 public function __construct($server_type)
 {}
 public function requestUri()
 {
  return $_SERVER['REQUEST_URI'];
 }
 public function realUri()
 {
  return $_SERVER['PHP_SELF'];
 }
}
class IServerVars_IIS implements IIServerVars
{
 public function __construct($server_type)
 {}
 public function requestUri()
 {
  $re = "";
  if(isset($_SERVER['REQUEST_URI']))
  {
   $re = $_SERVER['REQUEST_URI'];
  }
  elseif( isset($_SERVER['HTTP_X_REWRITE_URL']) )
  {
   //不取HTTP_X_REWRITE_URL
   $re = $_SERVER['HTTP_X_REWRITE_URL'];
  }
  elseif(isset($_SERVER["SCRIPT_NAME"] ) && isset($_SERVER['QUERY_STRING']) )
  {
   $re = $_SERVER["SCRIPT_NAME"] .'?'. $_SERVER['QUERY_STRING'];
  }
  return $re;
 }
 public function realUri()
 {
  $re= "";
  if( isset($_SERVER['HTTP_X_REWRITE_URL'])  )
  {
   $re = isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : $_SERVER['HTTP_X_REWRITE_URL'];
  }
  elseif(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != "" )
  {
   $re = $_SERVER['PATH_INFO'];
  }
  elseif(isset($_SERVER["SCRIPT_NAME"] ) && isset($_SERVER['QUERY_STRING']) )
  {
   $re = $_SERVER["SCRIPT_NAME"] .'?'. $_SERVER['QUERY_STRING'];
  }
  return $re;
 }
}
class IServerVars_Nginx implements IIServerVars
{
 public function __construct($server_type){}
 public function requestUri()
 {
  $re = "";
  if(isset($_SERVER['REQUEST_URI']))
  {
   $re = $_SERVER['REQUEST_URI'];
  }
  return $re;
 }
 public function realUri()
 {
  $re = "";
  if(isset($_SERVER['DOCUMENT_URI']) )
  {
   $re = $_SERVER['DOCUMENT_URI'];
  }
  elseif( isset($_SERVER['REQUEST_URI']) )
  {
   $re = $_SERVER['REQUEST_URI'];
  }
  return $re;
 }
}

 
