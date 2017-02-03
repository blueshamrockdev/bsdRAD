<?php

namespace BlueShamrock\Symfony\BsdRADBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CinnamonTrait
 * Adds $cinnamon member, setCinnamon(), getCinnamon(), generateSeed(), and generateCinnamon()
 *
 * generateCinnamon() should be used on PrePersist
 *
 * @author Micah Breedlove <druid628@gmail.com>
 * @package BlueShamrock\Symfony\Entity
 */
trait CinnamonTrait
{
    /**
     * @ORM\Column(type="string", length="50")
     * @var string $cinnamon
     */
    protected $cinnamon;


    /**
     * @return string
     */
    public function getCinnamon()
    {
        return $this->cinnamon;
    }

    /**
     * @param string $cinnamon
     *
     * @return $this
     */
    public function setCinnamon($cinnamon)
    {
        $this->cinnamon = $cinnamon;

        return $this;
    }


    protected function generateSeed()
    {
        return rtrim(base64_encode(md5(microtime())),"=");
    }

    public function generateCinnamon()
    {
        $seed = $this->generateSeed();

        $this->cinnamon = md5(hash("sha512", "cinnamon{" . $seed . "}"));

        return $this;
    }

}