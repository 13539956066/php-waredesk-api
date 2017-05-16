<?php

namespace Waredesk\Models;

use DateTime;
use Waredesk\Collections\Codes\Elements;
use JsonSerializable;

class Code implements JsonSerializable
{
    private $id;
    private $name;
    private $elements;
    private $creation;
    private $modification;

    public function __construct(array $data = null)
    {
        $this->elements = new Elements();
        $this->reset($data);
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getName(): ? string
    {
        return $this->name;
    }

    public function getElements(): ? Elements
    {
        return $this->elements;
    }

    public function getCreation(): ?DateTime
    {
        return $this->creation;
    }

    public function getModification(): ? DateTime
    {
        return $this->modification;
    }

    public function reset(array $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'id':
                        $this->id = $value;
                        break;
                    case 'name':
                        $this->name = $value;
                        break;
                    case 'variants':
                        $this->elements = $value;
                        break;
                    case 'creation':
                        $this->creation = $value;
                        break;
                    case 'modification':
                        $this->modification = $value;
                        break;
                }
            }
        }
    }

    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'elements' => $this->getElements()->jsonSerialize(),
        ];
    }
}