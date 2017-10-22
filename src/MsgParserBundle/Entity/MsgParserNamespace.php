<?php

declare(strict_types=1);

namespace MsgParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * MsgParserNamespace
 *
 * @ORM\Entity
 */
class MsgParserNamespace
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
     * @return MsgParserNamespace
     */
    public function setName(string $name): MsgParserNamespace
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
     * @return MsgParserNamespace
     */
    public function setPath($path): MsgParserNamespace
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
     * @return MsgParserNamespace
     */
    public function setVersion($version): MsgParserNamespace
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
     * @return MsgParserNamespace
     */
    public function setIsDeprecated(bool $isDeprecated): MsgParserNamespace
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
     * @return MsgParserNamespace
     */
    public function setIsActive(bool $isActive): MsgParserNamespace
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
