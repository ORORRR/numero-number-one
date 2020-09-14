<?php

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Oeuvre;
use AppBundle\Entity\Utilisateur;

class CommentaireTest extends \PHPUnit_Framework_TestCase
{
    public function testCommentaire(){
        $commentaire = new Commentaire();
        $message = "test";
        $uti = new Utilisateur();
        $oeuvre = new Oeuvre();
        $date = new \DateTime();

        $commentaire->setMessage($message);
        $commentaire->setUtilisateur($uti);
        $commentaire->setOeuvre($oeuvre);
        $commentaire->setDate($date);


        $this->assertGreaterThanOrEqual(0, $commentaire->getId());
        $this->assertEquals($message, $commentaire->getMessage());
        $this->assertEquals($uti, $commentaire->getUtilisateur());
        $this->assertEquals($oeuvre, $commentaire->getOeuvre());
        $this->assertEquals($date, $commentaire->getDate());

    }


}
