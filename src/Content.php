<?php
/*
 * @author Airmanbzh
 */
namespace Dumper;

class Content
{
	private $type = 'null';
	private $isTraversable = false;

	private $var = null;
	private $key = null;

	private static $types = array(
		'is_null' => 'null',
		'is_string'=>'string',
		'is_bool'=>'boolean',
		'is_int'=>'int',
		'is_long'=>'long',
		'is_float'=>'float',
		'is_double'=>'double',
		'is_real'=>'real',
		'is_numeric'=>'numeric',
		'is_resource'=>'resource',
		'is_callable'=>'callable',
		'is_array'=>'array',
		'is_object'=>'object'
	);

	public function __construct(&$var, &$key = null)
	{
		$this->var = $var;
		$this->key = $key;
		$this->type = strtolower(gettype($var));
		$this->isTraversable = is_array($var) || is_object($var) || $var instanceof \Traversable;

		if (is_null($key)) {
			if ($this->isTraversable) {
				$this->key = '...';
			}
		} elseif (!is_numeric($this->key)) {
			$this->key = ':' . $this->getKey();
		}

		return $this;
	}

	private function analyseType($var)
	{
		$found = false;
		$currentType = null;

		foreach (self::$types as $func=>$type) {
			if (!$found) {
				$found = call_user_func($func, $var);
				$currentType = $type;
			}
		}

		return $currentType;
	}

	public function getType()
	{
		return $this->type;
	}

	public function isTraversable()
	{
		return $this->isTraversable;
	}

	public function getShortDescription()
	{
		$return = null;
		switch ($this->type) {
			case 'null':
				$return = 'null';
				break;
			case 'resource':
				$return = ucfirst(get_resource_type($this->var)) . ' resource';
				break;
			case 'callable':
				$return = 'Callable';
				break;
			case 'array':
				$return = '(Array, ' . count($this->var) . ' element' . (count($this->var) > 1 ? 's)' : '');
				break;
			case 'object':
				$return = '(Object ' . get_class($this->var) . ')';
				break;
			case 'string':
				$return = '(' . $this->type . ', ' . strlen($this->var) . ' characters)';
				break;
			default :
				$return =  '(' . $this->type . ')';
				break;
		}

		return $return;
	}

	public function getDescription()
	{
		$return = '';
		if ($this->type === 'string') {
		}

		switch ($this->type) {
			case 'null':
			case 'resource':
			case 'callable':
			case 'array':
			case 'object':
				break;
			case 'string':
				$return = $this->var;
			default :
				$return = $this->var;
				break;
		}

		return $return;
	}

	public function setLine($line)
	{
		$this->line = $line;
	}

	public function getLine()
	{
		return $this->line;
	}

	public function getVar()
	{
		return $this->var;
	}

	public function getKey()
	{
		return $this->key;
	}

	public function __toString()
	{
		$templateVar = $this;
		ob_start();
		include('template/content.php');
		$template = ob_get_clean();
		return $template;
	}
}
