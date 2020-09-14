<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Comparison;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Oeuvre
 *
 * @ORM\Table(name="oeuvre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OeuvreRepository")
 */
class Oeuvre
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
     * @ORM\Column(name="nom", type="string", length=255)
     *
     * @Assert\NotBlank(message="Le nom de l'oeuvre doit être renseignée")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="string", length=512)
     *
     * @Assert\NotBlank(message="Le descriptif de l'oeuvre doit être renseignée")
     */
    private $descriptif;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur", inversedBy="oeuvres")
     * @ORM\JoinColumn(name="createur_id", referencedColumnName="id", nullable=true)
     */
    private $createur;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorie", inversedBy="oeuvres")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="auteurs", type="string", length=255, nullable=true)
     */
    private $auteurs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime", nullable=true)
     */
    private $datePublication;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Photo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="photoPrincipale", referencedColumnName="id", nullable=true)
     */
    private $photoPrincipale;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Photo", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="oeuvres_photosSecondaires",
     *     joinColumns={@ORM\JoinColumn(name="oeuvre_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="photo_id", referencedColumnName="id", unique=true)}
     *     )
     */
    private $photosSecondaires;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Avis", mappedBy="oeuvre", cascade={"persist", "remove"})
     */
    private $avis;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentaire", mappedBy="oeuvre", cascade={"persist", "remove"})
     * @ORM\OrderBy({"date" = "DESC"})
     */
    private $commentaires;

    public function __construct()
    {
        $this->photosSecondaires = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
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
     * @return Oeuvre
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
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return Oeuvre
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set auteurs
     *
     * @param string $auteurs
     *
     * @return Oeuvre
     */
    public function setAuteurs($auteurs)
    {
        $this->auteurs = $auteurs;

        return $this;
    }

    /**
     * Get auteurs
     *
     * @return string
     */
    public function getAuteurs()
    {
        return $this->auteurs;
    }

    /**
     * Set createur
     *
     * @param Utilisateur $createur
     *
     * @return Oeuvre
     */
    public function setCreateur($createur)
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * Get createur
     *
     * @return Utilisateur
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * Set categorie
     *
     * @param Categorie $categorie
     *
     * @return Oeuvre
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set photoPrincipale
     *
     * @param Photo $photo
     *
     * @return Oeuvre
     */
    public function setPhotoPrincipale($photo)
    {
        $this->photoPrincipale = $photo;

        return $this;
    }

    /**
     * Get photoPrincipale
     *
     * @return Photo
     */
    public function getPhotoPrincipale()
    {
        return $this->photoPrincipale;
    }

    /**
     * Add photoSecondaire
     *
     * @param Photo $photo
     *
     * @return Oeuvre
     */
    public function addPhotoSecondaire($photo)
    {
        $this->photosSecondaires->add($photo);

        return $this;
    }

    /**
     * Remove photoSecondaire
     *
     * @param Photo $photo
     *
     * @return Oeuvre
     */
    public function removePhotoSecondaire($photo)
    {
        $this->photosSecondaires->removeElement($photo);

        return $this;
    }

    /**
     * Get photos
     *
     * @return ArrayCollection
     */
    public function getPhotosSecondaires()
    {
        return $this->photosSecondaires;
    }

    /**
     * Add avis
     *
     * @param Avis $avis
     *
     * @return Oeuvre
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
     * @return Oeuvre
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
     * Get nbAvisPositif
     *
     * @return int
     */
    public function getNbAvisPositif()
    {
        $arr = $this->avis->map(function($value) {
            return $value->getType();
        })->toArray();
        $values = array_count_values($arr);
        if (array_key_exists(1, $values)) {
            return $values[1];
        } else {
            return 0;
        }
    }

    /**
     * Get nbAvisNegatif
     *
     * @return int
     */
    public function getNbAvisNegatif()
    {
        $arr = $this->avis->map(function($value) {
            return $value->getType();
        })->toArray();
        $values = array_count_values($arr);

        if (array_key_exists(0, $values)) {
            return $values[0];
        } else {
            return 0;
        }
    }

    /**
     * Add commentaire
     *
     * @param Commentaire $commentaire
     *
     * @return Oeuvre
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
     * @return Oeuvre
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

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Oeuvre
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Donne une chaine représentant l'avis global sur une oeuvre
     *
     * @return string
     */
    public function ratioAvis()
    {
        $positifs = $this->getNbAvisPositif();
        $negatifs = $this->getNbAvisNegatif();
        $total = $positifs + $negatifs;
        if ($total != 0) {
            $ratio = $positifs / $total;
            if ($ratio < 0.20) {
                return "Très négatifs";
            } else if ($ratio < 0.40) {
                return "Plutôt négatifs";
            } else if ($ratio < 0.60) {
                return "Mitigés";
            } else if ($ratio < 0.80) {
                return "Plutôt positifs";
            } else {
                return "Très positifs";
            }
        } else {
            return "Aucun avis";
        }
    }

    /**
     * Donne un pourcentage représentant l'avis global sur une oeuvre
     *
     * @return int
     */
    public function ratioAvisPourcentage()
    {
        $positifs = $this->getNbAvisPositif();
        $negatifs = $this->getNbAvisNegatif();
        $total = $positifs + $negatifs;
        if ($total != 0) {
            $pourcentage = ($positifs / $total) * 100;
            return round($pourcentage, 0);
        } else {
            return 50;
        }
    }
}

