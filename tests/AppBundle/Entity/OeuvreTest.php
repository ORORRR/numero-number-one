<?php

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Avis;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Oeuvre;
use AppBundle\Entity\Photo;
use AppBundle\Entity\Utilisateur;
use Doctrine\Common\Collections\ArrayCollection;

class OeuvreTest extends \PHPUnit_Framework_TestCase
{
    public function testOeuvre(){
        $oeuvre = new Oeuvre();
        $nom = "testNom";
        $descriptif = "testDescriptif";
        $createur = new Utilisateur();
        $categorie = new Categorie();
        $auteurs = "testAuteur";
        $datePublication = new \DateTime();


        $oeuvre->setNom($nom);
        $oeuvre->setDescriptif($descriptif);
        $oeuvre->setAuteurs($auteurs);
        $oeuvre->setCreateur($createur);
        $oeuvre->setCategorie($categorie);
        $oeuvre->setDatePublication($datePublication);


        $this->assertGreaterThanOrEqual(0, $oeuvre->getId());
        $this->assertEquals($nom, $oeuvre->getNom());
        $this->assertEquals($descriptif, $oeuvre->getDescriptif());
        $this->assertEquals($auteurs, $oeuvre->getAuteurs());
        $this->assertEquals($createur, $oeuvre->getCreateur());
        $this->assertEquals($categorie, $oeuvre->getCategorie());
        $this->assertEquals($datePublication, $oeuvre->getDatePublication());

    }

    public function testOeuvrePhotoPrincipale(){
        $oeuvre = new Oeuvre();
        $photo = new Photo();

        $oeuvre->setPhotoPrincipale($photo);
        $this->assertEquals($photo, $oeuvre->getPhotoPrincipale());
    }

    public function testOeuvrePhotosSecondaires(){
        $oeuvre = new Oeuvre();
        $photo = new Photo();
        $collectionPhoto = new ArrayCollection();
        $collectionPhoto->add($photo);
        $collectionEmpty = new ArrayCollection();

        $oeuvre->addPhotoSecondaire($photo);
        $this->assertEquals($collectionPhoto, $oeuvre->getPhotosSecondaires());
        $oeuvre->removePhotoSecondaire($photo);
        $this->assertEquals($collectionEmpty, $oeuvre->getPhotosSecondaires());

    }

    public function testOeuvreAvis(){
        $oeuvre = new Oeuvre();
        $avis = new Avis();
        $avis->setType(1);
        $collectionAvis = new ArrayCollection();
        $collectionAvis->add($avis);
        $collectionEmpty = new ArrayCollection();

        $oeuvre->addAvis($avis);
        $this->assertEquals($collectionAvis, $oeuvre->getAvis());
        $this->assertEquals(1, $oeuvre->getNbAvisPositif());
        $this->assertEquals(0, $oeuvre->getNbAvisNegatif());
        $oeuvre->removeAvis($avis);
        $this->assertEquals($collectionEmpty, $oeuvre->getAvis());
        $avis->setType(0);
        $oeuvre->addAvis($avis);
        $this->assertEquals(0, $oeuvre->getNbAvisPositif());
        $this->assertEquals(1, $oeuvre->getNbAvisNegatif());
    }

    public function testOeuvreCommentaire(){
        $oeuvre = new Oeuvre();
        $commentaire = new Commentaire();
        $collectionCommentaire = new ArrayCollection();
        $collectionCommentaire->add($commentaire);
        $collectionEmpty = new ArrayCollection();

        $oeuvre->addCommentaire($commentaire);
        $this->assertEquals($collectionCommentaire, $oeuvre->getCommentaires());
        $oeuvre->removeCommentaire($commentaire);
        $this->assertEquals($collectionEmpty, $oeuvre->getCommentaires());
    }

    public function testRatioAvis()
    {

        $oeuvre = new Oeuvre();
        $tranches = ["Très négatifs",
            "Plutôt négatifs",
            "Mitigés",
            "Plutôt positifs",
            "Très positifs",
            "Aucun avis"];

        $this->assertEquals($tranches[5], $oeuvre->ratioAvis());

        for ($i = 0; $i < 10; $i++) {
            $avis = new Avis();
            $avis->setType(0);
            $oeuvre->addAvis($avis);
        }

        $this->assertEquals($tranches[0], $oeuvre->ratioAvis());
        for ($i = 0; $i < 5; $i++) {
            $avis = new Avis();
            $avis->setType(1);
            $oeuvre->addAvis($avis);
        }

        $this->assertEquals($tranches[1], $oeuvre->ratioAvis());
        for ($i = 0; $i < 5; $i++) {
            $avis = new Avis();
            $avis->setType(1);
            $oeuvre->addAvis($avis);
        }
        $this->assertEquals($tranches[2], $oeuvre->ratioAvis());
        for ($i = 0; $i < 6; $i++) {
            $avis = new Avis();
            $avis->setType(1);
            $oeuvre->addAvis($avis);
        }
        $this->assertEquals($tranches[3], $oeuvre->ratioAvis());
        for ($i = 0; $i < 30; $i++) {
            $avis = new Avis();
            $avis->setType(1);
            $oeuvre->addAvis($avis);
        }
        $this->assertEquals($tranches[4], $oeuvre->ratioAvis());
    }

    public function testRatioAvisPourcentage() {
        $oeuvre = new Oeuvre();
        $this->assertEquals(50, $oeuvre->ratioAvisPourcentage());


        for ($i = 0; $i < 5; $i++) {
            $avis = new Avis();
            $avis->setType(0);
            $oeuvre->addAvis($avis);
        }

        $this->assertEquals(0, $oeuvre->ratioAvisPourcentage());

        for ($i = 0; $i < 2; $i++) {
            $avis = new Avis();
            $avis->setType(1);
            $oeuvre->addAvis($avis);
        }
        $this->assertEquals(29, $oeuvre->ratioAvisPourcentage());

        for ($i = 0; $i < 10; $i++) {
            $avis = new Avis();
            $avis->setType(1);
            $oeuvre->addAvis($avis);
        }
        $this->assertEquals(71, $oeuvre->ratioAvisPourcentage());
    }
}
