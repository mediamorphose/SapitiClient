<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;

class Ticket extends ApiObject
{

	protected $spectatorLabel='';
	protected $positionLabel='';
	protected $categoryLabel='';
	protected $entryCount=1;


	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Ticket $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['spectatorlabel'])) $result->setSpectatorLabel($data['spectatorlabel']);
		if (isset($data['positionlabel'])) $result->setPositionLabel($data['positionlabel']);
		if (isset($data['categorylabel'])) $result->setCategoryLabel($data['categorylabel']);
		if (isset($data['entrycount'])) $result->setEntryCount($data['entrycount']);
		return $result;
	}

	/**
	 * @return string
	 */
	public function getSpectatorLabel(): string
	{
		return $this->spectatorLabel;
	}

	/**
	 * @param string $spectatorLabel
	 */
	public function setSpectatorLabel(string $spectatorLabel): void
	{
		$this->spectatorLabel = $spectatorLabel;
	}

	/**
	 * @return string
	 */
	public function getPositionLabel(): string
	{
		return $this->positionLabel;
	}

	/**
	 * @param string $positionLabel
	 */
	public function setPositionLabel(string $positionLabel): void
	{
		$this->positionLabel = $positionLabel;
	}

	/**
	 * @return string
	 */
	public function getCategoryLabel(): string
	{
		return $this->categoryLabel;
	}

	/**
	 * @param string $categoryLabel
	 */
	public function setCategoryLabel(string $categoryLabel): void
	{
		$this->categoryLabel = $categoryLabel;
	}

	/**
	 * @return int
	 */
	public function getEntryCount(): int
	{
		return $this->entryCount;
	}

	/**
	 * @param int $entryCount
	 */
	public function setEntryCount(int $entryCount): void
	{
		$this->entryCount = $entryCount;
	}



}