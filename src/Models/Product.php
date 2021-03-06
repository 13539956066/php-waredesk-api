<?php

namespace Waredesk\Models;

use DateTime;
use Waredesk\Collections\Products\Categories;
use Waredesk\Collections\Products\Variants;
use JsonSerializable;
use Waredesk\Entity;
use Waredesk\Image;
use Waredesk\ReplaceableEntity;

class Product implements Entity, ReplaceableEntity, JsonSerializable
{
    private $id;
    private $categories;
    private $images;
    private $variants;
    private $name;
    private $description;
    private $note;
    private $creation;
    private $modification;

    /**
     * @var Image
     */
    private $pendingImage;

    /**
     * @var bool
     */
    private $deleteImage = false;

    public function __construct(array $data = null)
    {
        $this->categories = new Categories();
        $this->variants = new Variants();
        $this->reset($data);
    }

    public function __clone()
    {
        $this->categories = clone $this->categories;
        $this->variants = clone $this->variants;
    }

    public function getId(): ? string
    {
        return $this->id;
    }

    public function getCategories(): ? Categories
    {
        return $this->categories;
    }

    public function getImages(): ? array
    {
        return $this->images;
    }

    public function getVariants(): ? Variants
    {
        return $this->variants;
    }

    public function getName(): ? string
    {
        return $this->name;
    }

    public function getDescription(): ? string
    {
        return $this->description;
    }

    public function getNote(): ? string
    {
        return $this->note;
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
                    case 'categories':
                        $this->categories = $value;
                        break;
                    case 'images':
                        $this->deleteImage = false;
                        $this->pendingImage = null;
                        $this->images = $value;
                        break;
                    case 'variants':
                        $this->variants = $value;
                        break;
                    case 'name':
                        $this->name = $value;
                        break;
                    case 'description':
                        $this->description = $value;
                        break;
                    case 'note':
                        $this->note = $value;
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

    public function deleteImage()
    {
        $this->deleteImage = true;
    }

    public function setImage(Image $image = null)
    {
        $this->pendingImage = $image;
    }

    public function setName(string $name = null)
    {
        $this->name = $name;
    }

    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

    public function setNote(string $note = null)
    {
        $this->note = $note;
    }

    public function jsonSerialize(): array
    {
        $returnValue = [
            'categories' => $this->getCategories()->jsonSerialize(),
            'variants' => $this->getVariants()->jsonSerialize(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'note' => $this->getNote(),
        ];
        if ($this->pendingImage) {
            $returnValue['image'] = $this->pendingImage->toBase64();
        } elseif ($this->deleteImage) {
            $returnValue['image'] = null;
        }
        if ($this->getId()) {
            $returnValue = array_merge(['id' => $this->getId()], $returnValue);
        }
        return $returnValue;
    }
}
