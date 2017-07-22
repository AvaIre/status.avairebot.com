<?php 

namespace App\Discord;

trait Attributes
{
    protected $attributes;

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        if (isset($this->attributes[$property])) {
            return $this->attributes[$property];
        }

        return null;
    }
}