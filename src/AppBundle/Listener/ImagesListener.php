<?php


namespace AppBundle\Listener;

use AppBundle\Entity\Photo;
use AppBundle\Entity\Product;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Bridge\Monolog\Logger;

class ImagesListener {

    private $photoDirectory;

    /**
     * ImagesListener constructor.
     * @param $photoDirectory
     */
    public function __construct($photoDirectory)
    {
        $this->photoDirectory = $photoDirectory;
    }


    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if($entity instanceof Photo){
            $name = $entity->getCheminServeur();
            if(file_exists($this->photoDirectory.'/'.$name)){
                unlink($this->photoDirectory.'/'.$name);
            }
            $name = $entity->getCheminMiniatureServeur();
            if(file_exists($this->photoDirectory.'/'.$name)) {
                unlink($this->photoDirectory . '/' . $name);
            }
        }
    }

}
