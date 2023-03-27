<?php

namespace App\Traits;

trait Microfunctions
{

    public function getAvarageValueFromArray($collection,  string $attributeName)
    {
        // return the average from the attribute on the collection. If there are no items given, return "No Reviews"
        $average = $collection->avg($attributeName);

        return $average ?? 'No reviews';
    }

    public function getImage($images)
    {
        foreach ($images as $image) {
            return $image->src;
        }
    }
}
