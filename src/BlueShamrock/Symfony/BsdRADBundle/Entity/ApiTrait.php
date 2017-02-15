<?php

namespace BlueShamrock\Symfony\BsdRADBundle\Entity;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ApiTrait
 * Adds
 *
 * generateApiKey() should be used on PrePersist
 *
 * @author  Micah Breedlove <druid628@gmail.com>
 * @package BlueShamrock\Symfony\Entity
 */
trait ApiTrait
{

    /**
     * @var string $apiKey
     * @ORM\Column(type="string", length=50)
     */
    protected $apiKey;

    /**
     * @var string $apiToken
     * @ORM\Column(type="string", length=50)
     */
    protected $apiToken;

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     *
     * @return $this
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    // generator functions

    /**
     * Generates an ApiKey by building seed data and creating a hash from that seed data
     *
     * @return $this
     */
    protected function generateApiKey()
    {
        $seedData = microtime();
        $reader   = new AnnotationReader();
        $refClass = new \ReflectionClass(get_class($this));
        $apiData  = $reader->getClassAnnotation($refClass, 'BlueShamrock\Symfony\BsdRADBundle\Annotation\Api');
        if (!is_null($apiData)) {
            $getMethod = sprintf("get%s", ucfirst($apiData->field));
            $seedData  = str_replace(" ", $this->$getMethod, $seedData);
        }
        $this->setApiKey($this->generateUniqueKey("apikey:" . rtrim(base64_encode(md5($seedData)), "=")));

        return $this;
    }

    /**
     * Generates an ApiToken
     *
     * @return $this
     */
    protected function generateApiToken()
    {
        $this->setApiToken(md5(microtime()));
        return $this;
    }

    /**
     * Takes seed data and generates a hash
     * @param string $seed
     *
     * @return string
     */
    protected function generateUniqueKey($seed)
    {
        return md5(hash("sha512", $seed));
    }

    // PrePersist
    /**
     * PrePersist convienece Function for generating ApiToken and ApiKey at entity creation simultaneously
     */
    public function apiPrePersist()
    {
        $this->generateApiKey();
        $this->generateApiToken();
    }
}