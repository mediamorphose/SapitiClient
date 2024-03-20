<?php


namespace Sapiti\Objects\Catalogue;

use Sapiti\Objects\ApiObject;


class Plan extends ApiObject
{

    protected int $typeId = 10;
    protected string $svg = '';

	protected array $metaData=[];


	/**
	 * @param array $data
	 * @param ApiObject|null $existingObject
	 * @return FinanceItem|null
	 */
	static function getFromArray($data = null, ApiObject $existingObject = null)
	{
		/** @var Plan $result */
		$result = parent::getFromArray($data, $existingObject);

		if (isset($data['typeid'])) $result->setTypeId($data['typeid']);
        if (isset($data['svg'])) $result->setSvg($data['svg']);

		if(isset($data['metadata']) && is_array($data['metadata']))
			$result->setMetaData($data['metadata']);

        return $result;
	}

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): void
    {
        $this->typeId = $typeId;
    }

    public function getSvg(): string
    {
        return $this->svg;
    }

    public function setSvg(string $svg): void
    {
        $this->svg = $svg;
    }

    public function getMetaData(): array
    {
        return $this->metaData;
    }

    public function setMetaData(array $metaData): void
    {
        $this->metaData = $metaData;
    }






}