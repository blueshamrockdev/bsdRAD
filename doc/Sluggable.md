# Sluggable

## Purpose

The sluggable structure adds the following to an Entity:  
 
 * slug       (member)
 * createSlug (public method)
 * getSlug    (public method)
 * setSlug    (public method)
 * slugify    (protected method)

## Usage

The Sluggable feature includes two elements a 'Sluggable' Trait and an 
Annotation. To include a slug on an Entity

### SluggableTrait

The SluggableTrait includes each of the methods mentioned above and the slug 
member. This Trait simply needs to be attached to an Entity as any PHP trait 
in order to include these functions and member.

### Sluggable (Annotation)

The Sluggable annotation defines what field should be used to create the slug. 
It accepts as many as two parameters but a minimium of one. The first parameter
is the field used to create slug from, the second is the separator field. This
will replace non-word characters like the space with this field. The default is
 an empty character. An example would be by default turning 'Blue Shamrock' 
into 'blueshamrock'. By definining the separator character as a dash ('-') 
sluggable will then create the slug as 'blue-shamrock'.


### Example

    <?PHP

    namespace ACME\Demo\Entity;

    use BlueShamrock\Symfony\BsdRADBundle\Annotation as BSD;
    use BlueShamrock\Symfony\BsdRADBundle\Entity\SluggableTrait;

    /**
     * @BSD\Sluggable(field="name")
     */
     class Product
     {

         use SluggableTrait;

         private $name;

         ...

     }


