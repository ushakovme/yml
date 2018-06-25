<?php

namespace iamsaint\yml\components;

use iamsaint\yml\Object;

class Category extends Object
{
    public $name;
    public $id;
    public $parentId;

    public function write()
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

        $this->writer->endElement();
    }

    /**
     * @param mixed $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $id
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $parentId
     * @return Category
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }
    
    
}