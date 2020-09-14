<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 */
class Photo {

    const EXTENSION = 'jpg';
    const TAILLE_MAX = 600;
    const TAILLE_MINIATURE = 100;

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
     * @ORM\Column(name="nomServeur", type="string", length=255)
     */
    private $nomServeur;

    /**
     * Le fichier (utilisée seulement en objets pour téléverser/télécharger le
     * fichier physique
     * @var File
     */
    private $file;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return Photo
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Set nom Serveur
     *
     * @param string $nomServeur
     *
     * @return Photo
     */
    public function setNomServeur($nomServeur) {
        $this->nomServeur = $nomServeur;

        return $this;
    }

    /**
     * Get nomServeur
     *
     * @return string
     */
    public function getNomServeur() {
        return $this->nomServeur;
    }

    /**
     * Get cheminServeur
     *
     * @return string
     */
    public function getCheminServeur() {
        return $this->nomServeur . '.' . self::EXTENSION;
    }

    /**
     * Get cheminServeur
     *
     * @return string
     */
    public function getCheminMiniatureServeur() {
        return $this->nomServeur . '_min.' . self::EXTENSION;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile(File $file) {
        $this->file = $file;
    }

}
