<?php

declare(strict_types=1);

namespace ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * ParserInterfaces
 *
 * @ORM\Entity
 */
class ParserInterface
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
     * @ORM\ManyToOne(targetEntity="ParserNamespace", cascade={"remove"})
     * @ORM\JoinColumn(name="namespace_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $namespace;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=256)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * Set namespace
     *
     * @param ParserNamespace
     *
     * @return ParserInterface
     */
    public function setNamespace(ParserNamespace $namespace): ParserInterface
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Get namespace
     *
     * @return int
     */
    public function getNamespace(): int
    {
        return (int) $this->namespace;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ParserInterface
     */
    public function setName(string $name): ParserInterface
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
     * Set description
     *
     * @param string $description
     *
     * @return ParserInterface
     */
    public function setDescription(string $description): ParserInterface
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return (string) $this->description;
    }

    /**
     * Set isDeprecated
     *
     * @param bool $isDeprecated
     *
     * @return ParserInterface
     */
    public function setIsDeprecated(bool $isDeprecated): ParserInterface
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
     * @return ParserInterface
     */
    public function setIsActive(bool $isActive): ParserInterface
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
