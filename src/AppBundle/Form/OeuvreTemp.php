<?php

namespace AppBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class OeuvreTemp {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     * @Assert\Length(max = 255, maxMessage = "Le titre est trop long")
     * @Assert\NotBlank(message="Le nom de l'oeuvre doit être renseigné")
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotBlank(message="Le descriptif de l'oeuvre doit être renseigné")
     */
    private $descriptif;

    /**
     * @var Utilisateur
     */
    private $createur;

    /**
     * @var Categorie
     * @Assert\NotBlank(message="La catégorie de l'oeuvre doit être renseignée")
     */
    private $categorie;

    /**
     * @var string
     * @Assert\Length(max = 255, maxMessage = "Le contenu du champ Auteurs est trop long")
     */
    private $auteurs;

    /**
     * @var \DateTime
     */
    private $datePublication;

    /**
     * @var Photo
     */
    private $photoPrincipale;

    /**
     * @var ArrayCollection
     */
    private $photosSecondaires;

    /**
     * @var ArrayCollection
     */
    private $avis;

    /**
     * @var ArrayCollection
     */
    private $commentaires;

    /**
     * @var array
     */
    private $groupsImages;

    public function __construct() {
        $this->photosSecondaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->avis = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groupsImages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Oeuvre
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return Oeuvre
     */
    public function setDescriptif($descriptif) {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif() {
        return $this->descriptif;
    }

    /**
     * Set auteurs
     *
     * @param string $auteurs
     *
     * @return Oeuvre
     */
    public function setAuteurs($auteurs) {
        $this->auteurs = $auteurs;

        return $this;
    }

    /**
     * Get auteurs
     *
     * @return string
     */
    public function getAuteurs() {
        return $this->auteurs;
    }

    /**
     * Set createur
     *
     * @param Utilisateur $createur
     *
     * @return Oeuvre
     */
    public function setCreateur($createur) {
        $this->createur = $createur;

        return $this;
    }

    /**
     * Get createur
     *
     * @return Utilisateur
     */
    public function getCreateur() {
        return $this->createur;
    }

    /**
     * Set categorie
     *
     * @param Categorie $categorie
     *
     * @return Oeuvre
     */
    public function setCategorie($categorie) {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return Categorie
     */
    public function getCategorie() {
        return $this->categorie;
    }

    /**
     * Set photoPrincipale
     *
     * @param Photo $photo
     *
     * @return Oeuvre
     */
    public function setPhotoPrincipale($photo) {
        $this->photoPrincipale = $photo;

        return $this;
    }

    public function setPhotosSecondaires($photosSecondaires) {
        $this->photosSecondaires = $photosSecondaires;
    }

    /**
     * Get photoPrincipale
     *
     * @return Photo
     */
    public function getPhotoPrincipale() {
        return $this->photoPrincipale;
    }

    /**
     * Add photoSecondaire
     *
     * @param Photo $photo
     *
     * @return Oeuvre
     */
    public function addPhotoSecondaire($photo) {
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
    public function removePhotoSecondaire($photo) {
        $this->photosSecondaires->removeElement($photo);
        return $this;
    }

    /**
     * Get photos
     *
     * @return ArrayCollection
     */
    public function getPhotosSecondaires() {
        return $this->photosSecondaires;
    }

    public function setAvis($avis) {
        $this->avis = $avis;
    }

    /**
     * Add avis
     *
     * @param Avis $avis
     *
     * @return Oeuvre
     */
    public function addAvis($avis) {
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
    public function removeAvis($avis) {
        $this->avis->removeElement($avis);

        return $this;
    }

    /**
     * Get avis
     *
     * @return ArrayCollection
     */
    public function getAvis() {
        return $this->avis;
    }

    public function setCommentaires($commentaires) {
        $this->commentaires = $commentaires;
    }

    /**
     * Get nbAvisPositif
     *
     * @return int
     */
    public function getNbAvisPositif() {
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
    public function getNbAvisNegatif() {
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
    public function addCommentaire($commentaire) {
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
    public function removeCommentaire($commentaire) {
        $this->commentaires->removeElement($commentaire);

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return ArrayCollection
     */
    public function getCommentaires() {
        return $this->commentaires;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Oeuvre
     */
    public function setDatePublication($datePublication) {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication() {
        return $this->datePublication;
    }

    public function getGroupsImages() {
        return $this->groupsImages;
    }

    public function setGroupsImages($groupsImages) {
        $this->groupsImages = $groupsImages;
    }

    public function addGroupImages($groupImages) {
        $this->groupsImages->add($groupImages);
    }

    public function removeGroupImages($groupImages) {
        $this->groupsImages->removeElement($groupImages);
    }

    public function fromOeuvre(\AppBundle\Entity\Oeuvre $oeuvre) {
        $this->setId($oeuvre->getId());
        $this->setNom($oeuvre->getNom());
        $this->setDescriptif($oeuvre->getDescriptif());
        $this->setCreateur($oeuvre->getCreateur());
        $this->setCategorie($oeuvre->getCategorie());
        $this->setAuteurs($oeuvre->getAuteurs());
        $this->setDatePublication($oeuvre->getDatePublication());
        $this->setPhotoPrincipale($oeuvre->getPhotoPrincipale());
        $this->setAvis($oeuvre->getAvis());
        $this->setCommentaires($oeuvre->getCommentaires());
        
        foreach ($oeuvre->getPhotosSecondaires() as $key => $photo) {
            $groupFiles = new \AppBundle\Form\GroupImages();
            $newPhoto = new \AppBundle\Entity\Photo();
            $newPhoto->setId($photo->getId());
            $newPhoto->setNomServeur($photo->getNomServeur());
            if ($photo->getFile()) {
                $newPhoto->setFile($photo->getFile());
            }
            $groupFiles->addPhoto($newPhoto);
            $this->addGroupImages($groupFiles);
        }
    }

    public function toOeuvre(\AppBundle\Entity\Oeuvre $oeuvre) {
        $oeuvre->setNom($this->getNom());
        $oeuvre->setCreateur($this->getCreateur());
        $oeuvre->setDescriptif($this->getDescriptif());
        $oeuvre->setCategorie($this->getCategorie());
        $oeuvre->setAuteurs($this->getAuteurs());
        $oeuvre->setDatePublication($this->getDatePublication());
        $oeuvre->setPhotoPrincipale($this->getPhotoPrincipale());
    }

}
