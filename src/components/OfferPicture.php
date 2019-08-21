<?php

namespace iamsaint\yml\components;

use iamsaint\yml\BaseObject;
use XMLWriter;

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

    /**
     * @param XMLWriter $writer
     */
    public function write($writer): void
    {
        $writer->startElement('picture');

        if (null !== $this->url) {
            $writer->text($this->url);
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
