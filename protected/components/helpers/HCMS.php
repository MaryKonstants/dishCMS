<?php
class HCMS
{
	public static function getYiiFile()
	{
		return static::getYiiCustomFile('yiilite.php');
	}

	public static function getYiicFile()
	{
		return static::getYiiCustomFile('yiic.php');
	}

	protected static function getYiiCustomFile($filename)
	{
		$yiiPaths = include(dirname(__FILE__, 3).'/config/yiipaths.php');

		$yii = false;

		foreach($yiiPaths as $yiiPath){
			if(is_file("{$yiiPath}/{$filename}")){
				$yii = "{$yiiPath}/{$filename}";
				break;
			}
		}

		return $yii;
	}
	
	/**
	 * Подмена файла robots.txt
	 * @param string $site имя файла (robots.txt)
	 * @param string $host имя сервера разработки
	 */
	public static function robots($filename='site.robots.txt', $host='tmweb.ru')
	{
		// подмена файла 
		if($_SERVER['REQUEST_URI']=='/robots.txt') {
			if(preg_match('/^(.+\.)?'.str_replace('.','\.',$host).'$/', $_SERVER['SERVER_NAME'])) {
				header("Status: 200 OK");
				header('Content-Type: text/plain');
				echo "User-agent: *\r\nDisallow: /\r\n";
			}
			elseif(is_file($filename=($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $filename))) {
				header("Status: 200 OK");
				header('Content-Type: text/plain');
				echo file_get_contents($filename);
			} 
			else header("HTTP/1.0 404 Not Found");
	   		die(); 
		}
	}
}