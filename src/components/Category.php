<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;

/**
 * Class Category
 * @package iamsaint\yml\components
 *
 * @property string $name
 * @property int $id
 * @property int $parentId
 * @property Tag[] $customTags
 */
class Category extends BaseObject
{
    public $name;
    public $id;
    public $parentId;
    public $customTags = [];

    public function write(): void
    {
        $this->writer->startElement('category');

        if (null !== $this->id) {
            $this->writer->writeAttribute('id', $this->id);
        }
        if (null !== $this->parentId) {
            $this->writer->writeAttribute('parentId', $this->parentId);
        }
        if (null !== $this->name) {
            $this->writer->text($this->name);
        }

        $this->writeCustomTags();

        $this->writer->endElement();
    }

    public function writeCustomTags(): void
    {
        foreach ($this->customTags as $tag) {
            $tag->setWriter($this->writer)->write();
        }
    }

    /**
     * @param mixed $name
     * @return Category
     */
    public function setName($name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $id
     * @return Category
     */
    public function setId($id): Category
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $parentId
     * @return Category
     */
    public function setParentId($parentId): Category
    {
        $this->parentId = $parentId;
        return $this;
    }
}