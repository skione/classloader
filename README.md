classloader
===========

Generic Singleton Class Loader

You should have an autloader configured, something like this:
function afs_autoloader($class) {

        if (file_exists('/path/'.$class . '.php')) {
        
                include '/path/'.$class . '.php';
                
        }
        

        return true;
        
}

spl_autoload_register('afs_autoloader');

Then create new instances of your classes as thus:
$var = ClassLoader::getInstance('ClassName');

You can pass parameters to the class like this:
$param = array('param1','param2');
$var = ClassLoader::getInstance('ClassName',array('class_params'  =>	$param);
