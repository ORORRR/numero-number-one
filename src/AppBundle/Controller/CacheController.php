<?php

namespace AppBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CacheController extends Controller
{
    /**
     * Page qui vide le cache
     *
     * @Route("/kill-cache", name="killCache")
     */
    public function KillCacheAction(Request $request)
    {

        $fs = new Filesystem();
        $fs->remove($this->getParameter('kernel.cache_dir'));

       die('cache cleared successfully !');
    }
}
