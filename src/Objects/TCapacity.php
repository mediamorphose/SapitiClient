<?php
namespace Sapiti\Objects;

trait TCapacity
{

protected $_capacityTotal=-1;
protected $_capacityFree=-1;
protected $_capacityOrdered=-1;

/**
* @return int
*/
public function getCapacityTotal(): int
{
return $this->_capacityTotal;
}

public function setCapacityTotal(int $capacityTotal)
{
$this->_capacityTotal = $capacityTotal;
}


public function getCapacityFree(): int
{
return $this->_capacityFree;
}


public function setCapacityFree(int $capacityFree)
{
$this->_capacityFree = $capacityFree;
}


public function getCapacityOrdered(): int
{
return $this->_capacityOrdered;
}


public function setCapacityOrdered(int $capacityOrdered)
{
$this->_capacityOrdered = $capacityOrdered;
}






}