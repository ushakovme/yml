<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;

/**
 * Class OfferPicture
 * @package iamsaint\yml\components
 *
 * @property string $url
 * @property Tag[] $customTags
 */
class OfferPicture extends BaseObject
{
    public $url;
    public $customTags = [];

    public function write(): void
    {
        $this->writer->startElement('picture');

        if ($this->url !== null) {
            $this->writer->text($this->url);
        }

        $this->writeCustomTags();

        $this->writer->endElement();
    }

    public function writeCustomTags()
    {
        foreach ($this->customTags as $tag) {
            $tag->setWriter($this->writer)->write();
        }
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['url', 'required'],
            ['url', 'url']
        ];
    }

    /**
     * @param $url
     * @return BaseObject
     */
    public function setUrl($url): BaseObject
    {
        $this->url = $url;
        return $this;
    }
}