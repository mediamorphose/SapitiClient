<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;

class Ticket extends ApiObject
{

	protected $spectatorLabel='';
	protected $positionLabel='';
	protected $categoryLabel='';
	protected $entryCount=1;
	protected $pricelabel='';
	protected $orderreference='';
	protected $qrcode='';


	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Ticket $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['spectatorlabel'])) $result->setSpectatorLabel($data['spectatorlabel']);
		if (isset($data['positionlabel'])) $result->setPositionLabel($data['positionlabel']);
		if (isset($data['categorylabel'])) $result->setCategoryLabel($data['categorylabel']);
		if (isset($data['entrycount'])) $result->setEntryCount($data['entrycount']);
		if (isset($data['pricelabel'])) $result->setPricelabel($data['pricelabel']);
		if (isset($data['orderreference'])) $result->setOrderreference($data['orderreference']);
		if (isset($data['qrcode'])) $result->setQrcode($data['qrcode']);

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

	/**
	 * @return string
	 */
	public function getPricelabel(): string
	{
		return $this->pricelabel;
	}

	/**
	 * @param string $pricelabel
	 */
	public function setPricelabel(string $pricelabel): void
	{
		$this->pricelabel = $pricelabel;
	}

	/**
	 * @return string
	 */
	public function getOrderreference(): string
	{
		return $this->orderreference;
	}

	/**
	 * @param string $orderreference
	 */
	public function setOrderreference(string $orderreference): void
	{
		$this->orderreference = $orderreference;
	}

	/**
	 * @return string
	 */
	public function getQrcode(): string
	{
		return $this->qrcode;
	}

	/**
	 * @param string $qrcode
	 */
	public function setQrcode(string $qrcode): void
	{
		$this->qrcode = $qrcode;
	}




}