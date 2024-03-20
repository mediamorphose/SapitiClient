<?php


namespace Sapiti\Objects\Shop;

use Sapiti\Objects\ApiObject;
use Sapiti\Objects\TCapacity;

class PlanCategory extends ApiObject
{
    protected ?string $description='';
    protected ?string $color='';
    protected array $seatIds=[];



	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var PlanCategory $result */
		$result = parent::getFromArray($data, $existingObject);
		if (isset($data['description'])) $result->setDescription($data['description']);
		if (isset($data['color'])) $result->setColor($data['color']);
		if (is_array($data['seatids'])) $result->setSeatIds($data['seatids']);

		return $result;
	}

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    public function getSeatIds(): array
    {
        return $this->seatIds;
    }

    public function setSeatIds(array $seatIds): void
    {
        $this->seatIds = $seatIds;
    }



}