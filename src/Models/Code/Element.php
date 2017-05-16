<?php

namespace Waredesk\Models\Code;

use DateTime;
use JsonSerializable;
use Waredesk\Collections\Products\Variants\Annotations;
use Waredesk\Collections\Products\Variants\Codes;
use Waredesk\Collections\Products\Variants\Prices;
use Waredesk\Image;

class Element implements JsonSerializable
{
    private $id;
    private $type;
    private $default_value;
    private $auto_increment;
    private $pad_direction;
    private $pad_char;
    private $pad_length;

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getType(): ? string
    {
        return $this->type;
    }

    public function getDefaultValue(): ? string
    {
        return $this->default_value;
    }

    public function getAutoIncrement(): ? bool
    {
        return $this->auto_increment;
    }

    public function getPadDirection(): ? string
    {
        return $this->pad_direction;
    }

    public function getPadChar(): ? string
    {
        return $this->pad_char;
    }

    public function getPadLength(): ? int
    {
        return $this->pad_length;
    }

    public function reset(array $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'id':
                        $this->id = $value;
                        break;
                    case 'type':
                        $this->type = $value;
                        break;
                    case 'default_value':
                        $this->default_value = $value;
                        break;
                    case 'auto_increment':
                        $this->auto_increment = $value;
                        break;
                    case 'pad_direction':
                        $this->pad_direction = $value;
                        break;
                    case 'pad_char':
                        $this->pad_char = $value;
                        break;
                    case 'pad_length':
                        $this->pad_length = $value;
                        break;
                }
            }
        }
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function setDefaultValue(string $default_value = null)
    {
        $this->default_value = $default_value;
    }

    public function setAutoIncrement(bool $auto_increment = null)
    {
        $this->auto_increment = $auto_increment;
    }

    public function setPadDirection(string $pad_direction = null)
    {
        $this->pad_direction = $pad_direction;
    }

    public function setPadChar(string $pad_char = null)
    {
        $this->pad_char = $pad_char;
    }

    public function setPadLength(int $pad_length = null)
    {
        $this->pad_length = $pad_length;
    }

    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'default_value' => $this->getDefaultValue(),
            'auto_increment' => $this->getAutoIncrement(),
            'pad_direction' => $this->getPadDirection(),
            'pad_char' => $this->getPadChar(),
            'pad_length' => $this->getPadLength(),
        ];
    }
}