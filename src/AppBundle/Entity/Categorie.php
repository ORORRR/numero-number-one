<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 * @UniqueEntity("nom", message="Cette catégorie existe déjà")
 */
class Categorie
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
     * @ORM\Column(name="nom", type="string", length=50, unique=true)
     *
     * @Assert\Length(
     *     max = 50,
     *     maxMessage = "La catégorie ne doit pas faire plus de {{ limit }} caractères"
     * )
     * @Assert\NotBlank(message="Le nom de la catégorie doit être renseigné")
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Oeuvre", mappedBy="categorie", cascade={"remove"})
     */
    private $oeuvres;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Add oeuvre
     *
     * @param Oeuvre $oeuvre
     *
     * @return Categorie
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
     * @return Categorie
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
}

