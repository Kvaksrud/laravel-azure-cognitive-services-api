<?php

namespace Kvaksrud\AzureCognitiveServices\Api\Objects;

class FaceObject {

    public $faceId;
    public $faceRectangle;

    public function __construct(object $face)
    {
        $this->faceId = $face->faceId;
        $this->faceRectangle = $face->faceRectangle;
    }

}
