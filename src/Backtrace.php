<?php
/*
 * @author Airmanbzh
 */
namespace Dumper;


class Backtrace
{
	private $file = null;
	private $line = null;

	public function __construct()
	{
		$backtrace = debug_backtrace();
		$backtrace = array_pop($backtrace);

		$this->setFile(isset($backtrace['file']) ? $backtrace['file'] : null);
		$this->setLine(isset($backtrace['line']) ? $backtrace['line'] : null);

		return $this;
	}

	public function setFile($file)
	{
		$this->file = $file;
	}

	public function getFile()
	{
		return $this->file;
	}

	public function setLine($line)
	{
		$this->line = $line;
	}

	public function getLine()
	{
		return $this->line;
	}
}
