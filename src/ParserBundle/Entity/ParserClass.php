<?php

declare(strict_types=1);

namespace ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * ParserClass
 *
 * @ORM\Entity
 */
class ParserClass implements ResourceInterface
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
     * @return ParserClass
     */
    public function setNamespace(ParserNamespace $namespace): ParserClass
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
     * @return ParserClass
     */
    public function setName(string $name): ParserClass
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
     * @return ParserClass
     */
    public function setDescription(string $description): ParserClass
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
     * @return ParserClass
     */
    public function setIsDeprecated(bool $isDeprecated): ParserClass
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
     * @return ParserClass
     */
    public function setIsActive(bool $isActive): ParserClass
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
