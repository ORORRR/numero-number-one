<?php

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Avis;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Oeuvre;
use AppBundle\Entity\Utilisateur;
use Doctrine\Common\Collections\ArrayCollection;

class UtilisateurTest extends \PHPUnit_Framework_TestCase
{
    public function testUtilisateur(){
        $utilisateur = new Utilisateur();
        $login = "testLogin";
        $mdp = "testmdp";


        $utilisateur->setLogin($login);
        $utilisateur->setPlainPassword($mdp);
        $utilisateur->setPassword($mdp);

        $this->assertGreaterThanOrEqual(0, $utilisateur->getId());
        $this->assertEquals($login, $utilisateur->getLogin());
        $this->assertEquals($mdp, $utilisateur->getPlainPassword());
        $this->assertEquals($mdp, $utilisateur->getPassword());
    }
    public function testUtilisateurOeuvre(){
        $utilisateur = new Utilisateur();

        $oeuvre = new Oeuvre();
        $collectionOeuvre = new ArrayCollection();
        $collectionOeuvre->add($oeuvre);
        $collectionEmpty = new ArrayCollection();

        $utilisateur->addOeuvre($oeuvre);
        $this->assertEquals($collectionOeuvre, $utilisateur->getOeuvres());
        $utilisateur->removeOeuvre($oeuvre);
        $this->assertEquals($collectionEmpty, $utilisateur->getOeuvres());
    }

    public function testUtilisateurAvis(){
        $utilisateur = new Utilisateur();

        $avis = new Avis();
        $collectionAvis = new ArrayCollection();
        $collectionAvis->add($avis);
        $collectionEmpty = new ArrayCollection();

        $utilisateur->addAvis($avis);
        $this->assertEquals($collectionAvis, $utilisateur->getAvis());
        $utilisateur->removeAvis($avis);
        $this->assertEquals($collectionEmpty, $utilisateur->getAvis());

    }

    public function testUtilisateurCommentaire() {
        $utilisateur = new Utilisateur();

        $commentaire = new Commentaire();
        $collectionCommentaire = new ArrayCollection();
        $collectionCommentaire->add($commentaire);
        $collectionEmpty = new ArrayCollection();

        $utilisateur->addCommentaire($commentaire);
        $this->assertEquals($collectionCommentaire, $utilisateur->getCommentaires());
        $utilisateur->removeCommentaire($commentaire);
        $this->assertEquals($collectionEmpty, $utilisateur->getCommentaires());

    }

    public function testUtilisateurInfo() {
        $utilisateur = new Utilisateur();

        $utilisateur->setLogin("Testeur");
        $this->assertEquals("Testeur", $utilisateur->getUsername());
        $this->assertEquals(["ROLE_USER"], $utilisateur->getRoles());
        $this->assertNull($utilisateur->getSalt());
    }
}
