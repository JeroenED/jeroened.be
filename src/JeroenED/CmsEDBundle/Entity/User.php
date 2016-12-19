<?php

namespace JeroenED\CmsEDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Scheb\TwoFactorBundle\Model\Google\TwoFactorInterface;
use Scheb\TwoFactorBundle\Model\TrustedComputerInterface;

/**
 * Description of User
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="JeroenED\CmsEDBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable, TwoFactorInterface, TrustedComputerInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var string $googleAuthenticatorSecret Stores the secret code
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $googleAuthenticatorSecret;


    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $trusted;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }

    public function getGoogleAuthenticatorSecret()
    {
        return $this->googleAuthenticatorSecret;
    }

    public function eraseCredentials()
    {
    }


    public function addTrustedComputer($token, \DateTime $validUntil)
    {
        $this->trusted[$token] = $validUntil->format("r");
    }

    public function isTrustedComputer($token)
    {
        if (isset($this->trusted[$token])) {
            $now = new \DateTime();
            $validUntil = new \DateTime($this->trusted[$token]);
            return $now < $validUntil;
        }
        return false;
    }
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set googleAuthenticatorSecret
     *
     * @param string $googleAuthenticatorSecret
     * @return User
     */
    public function setGoogleAuthenticatorSecret($googleAuthenticatorSecret)
    {
        $this->googleAuthenticatorSecret = $googleAuthenticatorSecret;

        return $this;
    }
    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
