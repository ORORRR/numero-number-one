<?php

namespace AppBundle\Form;

class GroupImages {

    /**
     * @var int
     */
    private $id;

    /**
     *
     * @var ArrayCollection
     */
    private $files;

    /**
     *
     * @var ArrayCollection
     */
    private $photos;

    public function __construct() {
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFiles() {
        return $this->files;
    }

    public function setFiles($files) {
        $this->files = $files;
    }

    public function addFile($file) {
        $this->files[] = $file;
        return $this;
    }

    public function removeFile($file) {
        $this->files->removeElement($file);
    }

    public function getPhotos() {
        return $this->photos;
    }

    public function setPhotos($photos) {
        $this->photos = $photos;
    }

    public function addPhoto($photo) {
        $this->photos[] = $photo;
        return $this;
    }

    public function removePhoto($photo) {
        $this->photos->removeElement($photo);
    }

}
