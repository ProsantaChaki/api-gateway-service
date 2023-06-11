<?php

namespace App\Trait;

trait LanguageTrait
{
    public  function getLanguage()
    {
        return app('permission')->permissions['language'];
    }
}
