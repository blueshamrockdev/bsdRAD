<?PHP

namespace BlueShamrock\Symfony\BsdRADBundle\Entity;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class SluggableTrait
 * Adds $slug column setSlug() and getSlug()
 * Also creates slug on PrePersist
 *
 * @package BlueShamrock\Symfony\Entity
 */
trait SluggableTrait
{
    /**
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @ORM\PrePersist
     */
    public function createSlug()
    {
        $reader = new AnnotationReader();
        $refClass = new \ReflectionClass(get_class($this));
        $sluggable = $reader->getClassAnnotation($refClass, 'BlueShamrock\Symfony\BsdRADBundle\Annotation\Sluggable');
        $field = $sluggable->field;

        if ( is_null($this->slug) ){

            $this->setSlug($this->slugify($this->$field, $sluggable->separator));
        }

    }

    protected function slugify($text, $separator)
    {
        $slug = preg_replace('/[^\\pL\d]+/', $separator, strtolower(trim($text)));

        return $slug;
    }
}
