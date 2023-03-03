<?php

namespace App\Traits;


trait Microfunctions
{

    public function getAvarageValueFromArray($collection,  $attributeName)
    {
        // return the average from the attribute on the collection. If there are no items given, return the number 0
        $average = $collection->avg($attributeName);

        return $average ?? 0;
    }
}
