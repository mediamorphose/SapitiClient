<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;

class TicketSet extends ApiObject
{

	protected $stockId='';
	protected $tickets=[];


	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var TicketSet $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['stockid'])) $result->setStockId($data['stockid']);
		if (isset($data['tickets'])) {
			$result->setTickets(Ticket::getMultipleFromArray($data['tickets']));
		}

		return $result;
	}

	/**
	 * @return string
	 */
	public function getStockId(): string
	{
		return $this->stockId;
	}

	/**
	 * @param string $stockId
	 */
	public function setStockId(string $stockId): void
	{
		$this->stockId = $stockId;
	}

	/**
	 * @return array
	 */
	public function getTickets(): array
	{
		return $this->tickets;
	}

	/**
	 * @param array $tickets
	 */
	public function setTickets(array $tickets): void
	{
		$this->tickets = $tickets;
	}





}