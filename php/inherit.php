<?php
class ParentClass
{
	protected $property = 1;

	public function show()
	{
		echo $this->property;
	}
}

class ChildClass extends ParentClass
{
	protected $property = 2;
}

$obj = new ChildClass;
$obj->show();
