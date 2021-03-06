<?php

namespace BlueShamrock\Symfony\BsdRADBundle\Annotation;

/**
 * Class Sluggable
 * @package BlueShamrock\Symfony\Annotation
 * @author Micah Breedlove <druid628@gmail.com>
 * @Annotation
 */
class Sluggable 
{

    /** @var string $field */
    public $field;

    /** @var string $separator */
    public $separator = '';

}
