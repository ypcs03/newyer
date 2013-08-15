 
<?php
/**
 * @copyright (c) 2011 jooyea.net
 * @file urlmanager_class.php
 * @brief URL������
 * @author walu
 * @date 2011-07-18
 * @version 0.7
 * @note
 */
/**
 * @class IUrl
 * @brief URL������
 * @note
 */
class IUrl
{
 const UrlNative  = 1; //ԭ����Url��ʽ,ָ��index.php������index.php?controller=blog&action=read&id=100
 const UrlPathinfo = 2; //pathinfo��ʽ��Url,ָ���ǣ�/blog/read/id/100
 const UrlDiy  = 3; //����urlRoute���Url,ָ����:/blog-100.html
 
 const UrlCtrlName = 'controller';
 const UrlActionName = 'action';
 const UrlModuleName = 'module';
 
 const Anchor = "/#&"; //urlArray�б�ʾê�������
 
 const QuestionMarkKey = "?"; // /site/abc/?callback=/site/login callback=/site/login������UrlArray���key
 
 /**
  * ��ȡ��ǰController��action��module����Ϣ
  * @param string $key controller����action����module
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
  * ��Url��IWeb֧�ֵ�һ��Url��ʽת����һ����ʽ��
  * @param string $url ��ת����url
  * @param int $from IUrl::UrlNative����.....
  * @param int $to IUrl::UrlPathinfo����.....
  * @return string ���ת��ʧ���򷵻�false
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
  * ��controller=blog&action=read&id=100���queryת���������ʽ
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
  * ��/blog/read/id/100��ʽ��urlת���������ʽ
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
   //ǰ������ctrl��action��������ǲ�������ֵ
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
  * ���û������url����·��ת�����õ�urlArray
  * @param string  $url
  * @return array
  */
 public static function diyToArray($url)
 {
  return self::decodeRouteUrl($url);
 }
 
 /**
  * ��Url����������ݽ�������
  * ctrl��action�ǰ������İ�key����
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
  * ��urlArray��pathinfo����ʽ��ʾ����
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
  * ��urlArray��ԭ��url��ʽ���ֳ���
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
  * ��urlArrayת��·�ɺ��url
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
    //value['keys']Ҫ��arrCopy����һ���Ĳ����Ž���ת��
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
  //��ֹ�Ժ�url�е�controller��action����
  $arr['controller'] = $arr[self::UrlCtrlName];
  $arr['action'] = $arr[self::UrlActionName];
  foreach($sonConfig['keys'] as $value)
  {
   $url = preg_replace("!<{$value}[^>]*?(?<=/)>!" , $arr[$value] , $url );
  }
  return $url;
 }
 
 /**
  * �������urlͨ��·�ɹ��������urlArray
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
  * ���ؾ��������routeConfig
  * ���controller\action��
  * 1.���߶���������
  * 2.controller���壬action���� �����е�url������<action/>
  * 3.controller����action���� �����е�url������<controller/>
  * 4.controller��action������ �����е�url������<controller/>��<action/>
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
    trigger_error("·�ɹ���[{$rkey}]��Ч����Ϊȱ��controller��action��url�е�ĳһ�",E_USER_WARNING);
    continue;
   }
   $flagCtrl =(int) self::isReg($value['controller']);
   $flagAction =(int) self::isReg($value['action']);
   
   if( $flagCtrl == 1 && strpos($value['url'],"<controller/>" )===false  )
   {
    trigger_error("·�ɹ���[{$key}]��Ч����Ϊcontroller�������򣬵���url��û��<controller/>��",E_USER_WARNING);
    continue;
   }
   if( $flagAction == 1 && strpos($value['url'] , "<action/>" ) === false )
   {
    trigger_error("·�ɹ���[{$rkey}]��Ч����Ϊaction�������򣬵���url��û��<action/>��",E_USER_WARNING);
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
   //��Ҫ��merge
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
  * ���û������urlRoute����ת������
  * @access private
  */
 private static function routeUrlToRegexp($url)
 {
  /*���ӻ�����*/
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
  * @brief  ���ջ�׼��ʽ��URL������ת��ΪConfig�����õ�ģʽ
  * @param  String $url      �����url
  * @return String $finalUrl url��ַ
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
  
  //�ж��Ƿ���Ҫ���ؾ���·����url
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
    case 'url': // ������ǰ��
    case 'get': //config�ļ����get
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
  * @brief ��ȡ��վ��·��
  * @param  string $protocol Э��  Ĭ��ΪhttpЭ�飬����Ҫ��'://'
  * @return String $baseUrl  ��վ��·��
  *
  */
 public static function getHost($protocol='http')
 {
  $port    = $_SERVER['SERVER_PORT'] == 80 ? '' : ':'.$_SERVER['SERVER_PORT'];
  $baseUrl = $protocol.'://'.strtolower($_SERVER['SERVER_NAME']?$_SERVER['SERVER_NAME']:$_SERVER['HTTP_HOST']).$port;
  return $baseUrl;
 }
 /**
  * @brief ��ȡ��ǰִ���ļ���
  * @return String �ļ���
  */
 public static function getPhpSelf()
 {
  $re = explode("/",$_SERVER['SCRIPT_NAME']);
  return end($re);
 }
 /**
  * @brief ��������ļ�URl��ַ
  * @return string ��������ļ�URl��ַ
  */
 public static function getEntryUrl()
 {
  return self::getHost().$_SERVER['SCRIPT_NAME'];
 }
 
 /**
  * @brief ��ȡ����ļ���
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
  * @brief ����ҳ���ǰһҳ·�ɵ�ַ
  * @return string ����ҳ���ǰһҳ·�ɵ�ַ
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
  * @brief  ��ȡ��ǰ�ű������ļ���
  * @return �ű������ļ���
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
  * @brief ��ȡ��ǰurl��ַ[����RewriteRule֮���]
  * @return String ��ǰurl��ַ
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
  * @brief ��ȡ��ǰURI��ַ
  * @return String ��ǰURI��ַ
  */
 public static function getUri()
 {
  if( !isset($_SERVER['REQUEST_URI']) ||  $_SERVER['REQUEST_URI'] == "" )
  {
   // IIS ��������д
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
    //����pathinfo
    if ( !isset($_SERVER['PATH_INFO']) && isset($_SERVER['ORIG_PATH_INFO']) )
     $_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];

    if ( isset($_SERVER['PATH_INFO']) ) {
     if ( $_SERVER['PATH_INFO'] == $_SERVER['SCRIPT_NAME'] )
      $_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];
     else
      $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];
    }
    //����query
    if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
    {
     $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
    }
   }
   }
  return $_SERVER['REQUEST_URI'];
 }
 /**
  * @brief ��ȡurl����
  * @param String url ��Ҫ������url��Ĭ��Ϊ��ǰurl
  */
 public static function beginUrl($url='')
 {
  //����
  //native�� /index.php?controller=blog&action=read&id=100
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
    //ǿ�и�ֵ
    //todo������Ƿ���bug
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
  * @brief  ��ȡƴ��������ַ
  * @param  String $path_a
  * @param  String $path_b
  * @return string ������URL��ַ
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
//$_SERVER����url�йص��������ļ��ݴ�����
//���Ǹ�������Ľ�����������ܽ������ڱ����
interface IIServerVars
{
 /**
  * ��ȡREQUEST_URI
  * ��׼����ʵ�Ĵ��������ַ�����ֳ�����url��������#ê��
  */
 public function requestUri();
 /**
  * ���ճ��ָ���������url
  * ��׼��α��̬ǰ��request_uri��ͬ��α��̬�������һ������������url
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
   //��ȡHTTP_X_REWRITE_URL
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

 
