<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;
use XMLWriter;

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

    /**
     * @param XMLWriter $writer
     */
    public function write($writer): void
    {
        $writer->startElement('category');

        if (null !== $this->id) {
            $writer->writeAttribute('id', $this->id);
        }
        if (null !== $this->parentId) {
            $writer->writeAttribute('parentId', $this->parentId);
        }
        if (null !== $this->name) {
            $writer->text($this->name);
        }

        $this->writeCustomTags($writer);

        $writer->endElement();
    }

    /**
     * @param XMLWriter $writer
     */
    public function writeCustomTags($writer): void
    {
        foreach ($this->customTags as $tag) {
            $tag->write($writer);
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
