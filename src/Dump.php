<?php
/*
 * @author Airmanbzh
 */
namespace Dumper;


class Dump
{
	private $backtrace = null;
	private $content = null;

	public function __construct(&$var)
	{
		$this->setBacktrace(new Backtrace());
		$this->setContent(new Content($var));
	}

	public function setBacktrace(Backtrace $backtrace)
	{
		$this->backtrace = $backtrace;
	}

	public function getBacktrace()
	{
		return $this->backtrace;
	}

	public function setContent(Content $content)
	{
		$this->content = $content;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function __toString()
	{
		$templateVar = $this;
		ob_start();
		include('template/global.php');
		$template = ob_get_clean();
		return $template;
	}
}
