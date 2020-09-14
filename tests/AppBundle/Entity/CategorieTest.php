<?php

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Categorie;
use AppBundle\Entity\Oeuvre;
use Doctrine\Common\Collections\ArrayCollection;

class CategorieTest extends \PHPUnit_Framework_TestCase
{
    public function testCategorie(){
        $categorie = new Categorie();
        $nom = "test";

        $categorie->setNom($nom);
        $this->assertGreaterThanOrEqual(0, $categorie->getId());
        $this->assertEquals($nom, $categorie->getNom());

    }
    public function testCategorieOeuvre(){
        $categorie = new Categorie();
        $oeuvre = new Oeuvre();
        $collectionOeuvre = new ArrayCollection();
        $collectionOeuvre->add($oeuvre);
        $collectionEmpty = new ArrayCollection();

        $categorie->addOeuvre($oeuvre);
        $this->assertEquals($collectionOeuvre, $categorie->getOeuvres());
        $categorie->removeOeuvre($oeuvre);
        $this->assertEquals($collectionEmpty, $categorie->getOeuvres());


    }
}
