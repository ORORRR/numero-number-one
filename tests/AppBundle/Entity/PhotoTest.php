<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Photo;
use Symfony\Component\HttpFoundation\File\File;

class PhotoTest extends \PHPUnit_Framework_TestCase
{
    public function testPhoto(){
        $photo = new Photo();
        $nomServeur = "test";

        $photo->setNomServeur($nomServeur);

        $this->assertGreaterThanOrEqual(0, $photo->getId());
        $this->assertEquals($nomServeur, $photo->getNomServeur());
    }

    public function testCheminServeur(){
        $photo = new Photo();
        $photo->setNomServeur("Lama");
        $this->assertEquals("Lama.jpg", $photo->getCheminServeur());
    }

    public function testCheminMiniatureServeur(){
        $photo = new Photo();
        $photo->setNomServeur("Lama");
        $this->assertEquals("Lama_min.jpg", $photo->getCheminMiniatureServeur());
    }

    public function testSetID() {
        $photo = new Photo();
        $photo->setId(0);
        $this->assertEquals(0, $photo->getId());
    }

    public function testFile() {
        $photo = new Photo();
        $this->assertNull($photo->getFile());
        $file = new File(__DIR__.'/AvisTest.php');
        $photo->setFile($file);
        $this->assertSame($file, $photo->getFile());
    }
}
