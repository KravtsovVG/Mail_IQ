<?php
namespace app\classes
{ 
  class Autoloader
  {
    const debug = 1;
    public function __construct(){}

    public static function autoload($file)
    {
      $file = str_replace('\\', DS, $file);
      $filepath = AppPATH . DS . $file . '.php';
	  if(Autoloader::debug) Autoloader::StPutFile(('DS: ' .DS));
	if(Autoloader::debug) Autoloader::StPutFile(('подключаем ' .$filepath));
      if (file_exists($filepath))
      {
        if(Autoloader::debug) Autoloader::StPutFile(('подключили ' .$filepath));
        require_once($filepath);
        
      }
      else
      { 
        $flag = true;
        if(Autoloader::debug) Autoloader::StPutFile(('начинаем рекурсивный поиск'));
        Autoloader::recursive_autoload($file, AppPATH, $flag);
      }
    }

    public static function recursive_autoload($file, $path, &$flag)
    {
      if (FALSE !== ($handle = opendir($path)) && $flag)
      {
        while (FAlSE !== ($dir = readdir($handle)) && $flag)
        {
          
          if (strpos($dir, '.') === FALSE)
          {
            $path2 = $path . DS . $dir;
            $filepath = $path2 . DS . $file . '.php';
            if(Autoloader::debug) Autoloader::StPutFile(('ищем файл <b>' .$file .'</b> in ' .$filepath));
            if (file_exists($filepath))
            {
              if(Autoloader::debug) Autoloader::StPutFile(('подключили ' .$filepath ));
              $flag = FALSE;
              require_once($filepath);
              break;
            }
            Autoloader::recursive_autoload($file, $path2, $flag); 
          }
        }
        closedir($handle);
      }
    }
  
    private static function StPutFile($data)
    {
      $dir = $_SERVER['DOCUMENT_ROOT'] . DS . 'Log' . DS . 'Log.html';
      $file = fopen($dir, 'a');
      flock($file, LOCK_EX);
      fwrite($file, ('║' .$data .'=>' .date('d.m.Y H:i:s') .'<br/>║<br/>' .PHP_EOL));
      flock($file, LOCK_UN);
      fclose ($file);
    }
    
  }
  \spl_autoload_register('app\classes\Autoloader::autoload');
}