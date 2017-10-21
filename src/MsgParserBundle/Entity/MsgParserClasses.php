<?php

namespace MsgParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * MsgParserClasses
 *
 * @ORM\Table(name="msg_parser_classes")
 * @ORM\Entity(repositoryClass="MsgParserBundle\Repository\MsgParserClassesRepository")
 */
class MsgParserClasses
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
     * @var int
     *
     * @ORM\Column(name="namespace_id", type="integer", length=11)
     */
    private $namespace_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=256, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
//
//    /**
//     * @var \DateTime
//     *
//     * @ORM\Column(name="created_at", type="datetime")
//     */
//    private $created_at;
//
//    /**
//     * @var \DateTime
//     *
//     * @ORM\Column(name="updated_at", type="datetime")
//     */
//    private $updated_at;


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
     * Set namespaceId
     *
     * @param integer $namespaceId
     *
     * @return MsgParserClasses
     */
    public function setNamespaceId($namespaceId)
    {
        $this->namespace_id = $namespaceId;

        return $this;
    }

    /**
     * Get namespaceId
     *
     * @return int
     */
    public function getNamespaceId()
    {
        return $this->namespace_id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return MsgParserClasses
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
     * Set description
     *
     * @param string $description
     *
     * @return MsgParserClasses
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isDeprecated
     *
     * @param string $isDeprecated
     *
     * @return MsgParserClasses
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
     * @return MsgParserClasses
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

//    /**
//     * Set createdAt
//     *
//     * @param \DateTime $createdAt
//     *
//     * @return MsgParserClasses
//     */
//    public function setCreatedAt($createdAt)
//    {
//        $this->created_at = $createdAt;
//
//        return $this;
//    }
//
//    /**
//     * Get createdAt
//     *
//     * @return \DateTime
//     */
//    public function getCreatedAt()
//    {
//        return $this->created_at;
//    }
//
//    /**
//     * Set updatedAt
//     *
//     * @param \DateTime $updatedAt
//     *
//     * @return MsgParserClasses
//     */
//    public function setUpdatedAt($updatedAt)
//    {
//        $this->updated_at = $updatedAt;
//
//        return $this;
//    }
//
//    /**
//     * Get updatedAt
//     *
//     * @return \DateTime
//     */
//    public function getUpdatedAt()
//    {
//        return $this->updated_at;
//    }
}
