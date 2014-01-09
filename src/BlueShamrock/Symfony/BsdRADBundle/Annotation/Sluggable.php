<?php
/**
 * PHP Class
 * @package
 * @author Micah Breedlove <mbreedlove@franklinamerican.com>
 *
 */

namespace BlueShamrock\Symfony\BsdRADBundle\Annotation;


/**
 * Class Sluggable
 * @package BlueShamrock\Symfony\Annotation
 * @Annotation
 */
class Sluggable 
{

    /** @var string $field */
    public $field;

    /** @var string $separator */
    public $separator = '';

}
