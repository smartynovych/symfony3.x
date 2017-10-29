<?php

declare(strict_types = 1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @param mixed $username
     *
     * @return User
     */
    public function setUsername($username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): string
    {
        return (string) $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword): User
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return User
     */
    public function setEmail($email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive(): bool
    {
        return (bool) $this->isActive;
    }

    /**
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive(bool $isActive): User
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return array('ROLE_USER','ROLE_ADMIN');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }
}
