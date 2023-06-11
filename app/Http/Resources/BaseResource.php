<?php

namespace App\Http\Resources;

use App\Trait\LanguageTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    use LanguageTrait;

    function lan($field){
        return $this->{$field.'_'.$this->getLanguage()};
    }

}
