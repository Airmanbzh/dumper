<?php
/*
 * @author Airmanbzh
 */
namespace Dumper;

class Dumper
{
	private static $instance = null;

	private static $cssPath = null;
	private static $cssTemplate = 'default';

	private static $jsPath = null;
	private static $jsTemplate = 'default';

	private function __construct()
	{

		self::$cssPath = __DIR__ . "./template/css/";
		self::$jsPath = __DIR__ . "./template/js/";
		
		return $this;
	}

	private static function instance()
	{
		return self::$instance ?: self::$instance = new self();
	}

	private function analyse($datas)
	{
		return new Dump($datas);
	}

	public static function dump()
	{
		$return = null;
		$num = func_num_args();

		if ($num > 1) {
			$return = array();
			foreach (func_get_args() as $arg) {
				$return[] = self::instance()->analyse($arg);
			}
		} elseif ($num === 1) {
			$return = self::instance()->analyse(func_get_arg(0));
		}

		return $return;
	}

	public static function getCssPath()
	{
		return self::$cssPath;
	}

	public static function setCssPath($path)
	{
		self::$cssPath = $path;
	}

	public static function getJsPath()
	{
		return self::$jsPath;
	}

	public static function setJsPath($path)
	{
		self::$jsPath = $path;
	}

	public static function getCssTemplate()
	{
		return self::$cssTemplate;
	}

	public static function setCssTemplate($template)
	{
		self::$cssTemplate = $template;
	}

	public static function getJsTemplate()
	{
		return self::$jsTemplate;
	}

	public static function setJsTemplate($template)
	{
		self::$jsTemplate = $template;
	}

	public static function getCss()
	{
		$cssPath = self::getCssPath() ?: __DIR__. './template/css/';
		$cssTemplate = self::getCssTemplate() ?: 'default';
		return file_get_contents($cssPath . $cssTemplate . '/dumper.css');
	}

	public static function getJs()
	{
		$jsPath = self::getJsPath() ?: __DIR__. './template/js/';
		$jsTemplate = self::getJsTemplate() ?: 'default';
		return file_get_contents($jsPath . $jsTemplate . '/dumper.js');
	}
}

function Dump()
{
	return call_user_func_array(__NAMESPACE__ . '\Dumper::dump', func_get_args());
}
