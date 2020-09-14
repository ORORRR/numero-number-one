<?php

namespace Tests\AppBundle\Entity;
use AppBundle\Entity\Avis;
use AppBundle\Entity\Oeuvre;
use AppBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AvisTest extends WebTestCase
{

    public function testAvis(){
        $avis = new Avis();
        $oeuvre = new Oeuvre();
        $uti = new Utilisateur();
        $date = new \DateTime();

        $avis->setType(1);
        $avis->setUtilisateur($uti);
        $avis->setOeuvre($oeuvre);
        $avis->setDate($date);

        $this->assertGreaterThanOrEqual(0, $avis->getId());
        $this->assertEquals($uti, $avis->getUtilisateur());
        $this->assertEquals($oeuvre, $avis->getOeuvre());
        $this->assertEquals(1, $avis->getType());
        $this->assertEquals($date, $avis->getDate());
    }
}
