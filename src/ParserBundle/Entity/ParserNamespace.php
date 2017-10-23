<?php

declare(strict_types=1);

namespace ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * ParserNamespace
 *
 * @ORM\Entity
 */
class ParserNamespace
{
    use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=256)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=256)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=16)
     */
    private $version;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $isDeprecated = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $isActive = true;

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ParserNamespace
     */
    public function setName(string $name): ParserNamespace
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return ParserNamespace
     */
    public function setPath($path): ParserNamespace
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath(): string
    {
        return (string) $this->path;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return ParserNamespace
     */
    public function setVersion($version): ParserNamespace
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion(): string
    {
        return (string) $this->version;
    }

    /**
     * Set isDeprecated
     *
     * @param bool $isDeprecated
     *
     * @return ParserNamespace
     */
    public function setIsDeprecated(bool $isDeprecated): ParserNamespace
    {
        $this->isDeprecated = $isDeprecated;

        return $this;
    }

    /**
     * Get isDeprecated
     *
     * @return boolean
     */
    public function getIsDeprecated(): bool
    {
        return (bool) $this->isDeprecated;
    }

    /**
     * Set isActive
     *
     * @param bool $isActive
     *
     * @return ParserNamespace
     */
    public function setIsActive(bool $isActive): ParserNamespace
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive(): bool
    {
        return (bool) $this->isActive;
    }
}
