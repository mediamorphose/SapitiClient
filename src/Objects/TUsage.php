<?php
namespace Sapiti\Objects;

trait TUsage
{

	protected $usageId=-1;
	protected $usageLabel='';
	protected $usageDate = false;

	/**
	 * @return \DateTime|false
	 */
	public function getUsageDate()
	{
		return $this->usageDate;
	}

	/**
	 * @param \DateTime|null $usageDate
	 */
	public function setUsageDate(\DateTime $usageDate=null)
	{
		$this->usageDate = $usageDate;
	}


	public function getUsageId()
	{
		return $this->usageId;
	}


	public function setUsageId ($usageId): void
	{
		$this->usageId = $usageId;
	}

	/**
	 * @return string
	 */
	public function getUsageLabel(): string
	{
		return $this->usageLabel;
	}

	public function setUsageLabel($usageLabel): void
	{
		$this->usageLabel = $usageLabel;
	}



}