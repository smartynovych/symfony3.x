<?php

declare(strict_types = 1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=1, name="is_active", options={"default" : "Y"})
     */
    private $isActive;

    /**
     * @ORM\Column(type="integer", name="created_by", options={"default" : 0})
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId(): int
    {
        return (int) $this->categoryId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return Article
     */
    public function setCategoryId(int $categoryId): Article
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * @param string $name
     *
     * @return Article
     */
    public function setName(string $name): Article
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string) $this->description;
    }

    /**
     * @param string $description
     *
     * @return Article
     */
    public function setDescription(string $description): Article
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get isActive
     *
     * @return string
     */
    public function getIsActive(): string
    {
        return $this->isActive;
    }

    /**
     * Set isActive
     *
     * @param string $isActive
     *
     * @return Article
     */
    public function setIsActive(string $isActive): Article
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getCreatedBy(): int
    {
        return (int) $this->createdBy;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Article
     */
    public function setCreatedBy(int $createdBy): Article
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return Article
     */
    public function setCreatedAt(\DateTime $createdAt): Article
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
