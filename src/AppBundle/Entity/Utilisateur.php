<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurRepository")
 * @UniqueEntity("login", message="Ce login est déjà utilisé")
 */
class Utilisateur implements UserInterface, \Serializable
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
     * @ORM\Column(name="login", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Le login doit être renseigné")
     * @Assert\Length(max=255, maxMessage="Le login est trop long")
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Oeuvre", mappedBy="createur")
     */
    private $oeuvres;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Avis", mappedBy="utilisateur",cascade={"remove"})
     */
    private $avis;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentaire", mappedBy="utilisateur")
     */
    private $commentaires;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->commentaires = new ArrayCollection();

        $this->roles = ['ROLE_USER'];
    }

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
     * Set login
     *
     * @param string $login
     *
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add oeuvre
     *
     * @param Oeuvre $oeuvre
     *
     * @return Utilisateur
     */
    public function addOeuvre($oeuvre)
    {
        $this->oeuvres->add($oeuvre);

        return $this;
    }

    /**
     * Remove oeuvre
     *
     * @param Oeuvre $oeuvre
     *
     * @return Utilisateur
     */
    public function removeOeuvre($oeuvre)
    {
        $this->oeuvres->removeElement($oeuvre);

        return $this;
    }

    /**
     * Get oeuvres
     *
     * @return ArrayCollection
     */
    public function getOeuvres()
    {
        return $this->oeuvres;
    }

    /**
     * Add avis
     *
     * @param Avis $avis
     *
     * @return Utilisateur
     */
    public function addAvis($avis)
    {
        $this->avis->add($avis);

        return $this;
    }

    /**
     * Remove avis
     *
     * @param Avis $avis
     *
     * @return Utilisateur
     */
    public function removeAvis($avis)
    {
        $this->avis->removeElement($avis);

        return $this;
    }

    /**
     * Get avis
     *
     * @return ArrayCollection
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * Add commentaire
     *
     * @param Commentaire $commentaire
     *
     * @return Utilisateur
     */
    public function addCommentaire($commentaire)
    {
        $this->commentaires->add($commentaire);

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param Commentaire $commentaire
     *
     * @return Utilisateur
     */
    public function removeCommentaire($commentaire)
    {
        $this->commentaires->removeElement($commentaire);

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return ArrayCollection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    //--------------------------------------

    public function getUsername()
    {
        return $this->getLogin();
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->login,
            $this->password,
            // $this->salt,
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->login,
            $this->password,
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}

