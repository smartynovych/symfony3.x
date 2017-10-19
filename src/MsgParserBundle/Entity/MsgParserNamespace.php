<?php

namespace MsgParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MsgParserNamespace
 *
 * @ORM\Table(name="msg_parser_namespace")
 * @ORM\Entity(repositoryClass="MsgParserBundle\Repository\MsgParserNamespaceRepository")
 */
class MsgParserNamespace
{
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
     * @ORM\Column(name="name", type="string", length=256, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=256, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=16)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="is_deprecated", type="string", length=1)
     */
    private $is_deprecated = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="is_active", type="string", length=1)
     */
    private $is_active = 'Y';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return MsgParserNamespace
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return MsgParserNamespace
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return MsgParserNamespace
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set isDeprecated
     *
     * @param string $isDeprecated
     *
     * @return MsgParserNamespace
     */
    public function setIsDeprecated($isDeprecated)
    {
        $this->is_deprecated = $isDeprecated;

        return $this;
    }

    /**
     * Get isDeprecated
     *
     * @return string
     */
    public function getIsDeprecated()
    {
        return $this->is_deprecated;
    }

    /**
     * Set isActive
     *
     * @param string $isActive
     *
     * @return MsgParserNamespace
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MsgParserNamespace
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return MsgParserNamespace
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
