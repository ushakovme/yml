<?php

namespace iamsaint\yml\components;

use iamsaint\yml\Object;

class OfferPicture extends Object
{
    public $url;

    public function write()
    {
        $this->writer->startElement('picture');

        if (null !== $this->url) {
            $this->writer->text($this->url);
        }

        $this->writer->endElement();
    }

    public function rules() {
        return [
            ['url', 'required'],
            ['url', 'url']
        ];
    }

    /**
     * @param $url
     * @return Object
     */
    public function setUrl($url): Object {
        $this->url = $url;
        return $this;
    }
}