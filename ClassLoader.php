<?php
 
final class ClassLoader {
    private static $instances = array();
    protected function __construct() { }
    
    protected function __clone() { }
    
    static function getInstance($class,$params=array())  {
        $arguments_str = '';
        $instance_exists = isset($params['access_key']) ? isset(self::$instances[$class][$params['access_key']]) : isset(self::$instances[$class]);                
        if (!$instance_exists) {
            if(isset($params['class_params'])) {
                foreach ($params['class_params'] as $key => $value) {
                    $arguments_str[md5($key)] = $value;
                }
            } else {
                $arguments_str = array();
            }
            
            if(isset($params['access_key'])) {
                return self::$instances[$class][$params['access_key']] = new $class(extract($arguments_str));
            } else {
                return self::$instances[$class] = new $class(extract($arguments_str));
            }
        }
        
        return (isset($params['access_key']) ? self::$instances[$class][$params['access_key']] : self::$instances[$class]);
    }
    
    static function setObject($object_type,$object,$access_key=null)
    {
        if(!is_null($access_key))
        {
            self::$instances[$object_type][$access_key] = $object;
        }
        else
        {
            self::$instances[$object_type] = $object;
        }
    }
}
