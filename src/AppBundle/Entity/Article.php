<?php

declare(strict_types = 1);

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
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
     * @ORM\Column(type="integer", name="category_id")
     */
    private $categoryId = 1;

    /**
     * @ORM\Column(type="string", length=2, name="language_id", options={"default" : "ru"})
     */
    private $languageId = 'ru';

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
    private $isActive = 'Y';

    /**
     * @ORM\Column(type="integer", name="created_by", options={"default" : 0})
     */
    private $createdBy = 1;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @var string $createdFromIp
     *
     * @Gedmo\IpTraceable(on="create")
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $createdFromIp;

    /**
     * @var string $updatedFromIp
     *
     * @Gedmo\IpTraceable(on="update")
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $updatedFromIp;

    /**
     * @var datetime $contentChangedFromIp
     *
     * @ORM\Column(name="content_changed_by", type="string", nullable=true, length=45)
     * @Gedmo\IpTraceable(on="change", field={"name", "description", "created_at"})
     */
    private $contentChangedFromIp;

    /**
     * @return integer
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
    public function getLanguageId(): string
    {
        return (string) $this->languageId;
    }

    /**
     * @param string $languageId
     *
     * @return Article
     */
    public function setLanguageId(string $languageId): Article
    {
        $this->languageId = $languageId;
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

    /**
     * Get getCreatedFromIp
     *
     * @return string
     */
    public function getCreatedFromIp(): string
    {
        return (string) $this->createdFromIp;
    }

    /**
     * Get getUpdatedFromIp
     *
     * @return string
     */
    public function getUpdatedFromIp(): string
    {
        return (string) $this->updatedFromIp;
    }

    /**
     * Get getContentChangedFromIp
     *
     * @return string
     */
    public function getContentChangedFromIp(): string
    {
        return (string) $this->contentChangedFromIp;
    }
}
