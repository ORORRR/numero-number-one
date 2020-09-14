<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Avis;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Oeuvre;
use AppBundle\Entity\Photo;
use AppBundle\Form\CommentaireType;
use AppBundle\Form\OeuvreTemp;
use AppBundle\Form\OeuvreType;
use Intervention\Image\ImageManagerStatic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class OeuvreController extends Controller {

    /**
     * Page du formulaire pour ajouter une oeuvre
     *
     * @Route("/ajout-oeuvre", name="ajoutOeuvre")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function ajoutOeuvreAction(Request $request) {
        $oeuvreTemp = new OeuvreTemp();
        $oeuvre = new Oeuvre();

        // creation du formulaire
        $form = $this->createForm(OeuvreType::class, $oeuvreTemp, array(
            'modifier' => false,
        ));

        // set du créateur de l'oeuvre
        // traitement du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $oeuvreTemp->setCreateur($this->getUser());
            $tour = 0;

            //vérification de format des images secondaires
            $file = $form['groupsImages']->getData();
            if ($file) {
                $extensions_autorisees = array('png', 'jpg', 'jpeg', 'gif', 'webp');
                foreach ($file as $value) {
                    foreach ($value->getPhotos() as $key => $photo) {
                        if (!in_array($value->getFiles()[$key]->getClientOriginalExtension(), $extensions_autorisees)) {
                            $form = $this->ErrorForm($form, $oeuvre, ['modifier' => false, 'texte_bouton' => 'Ajouter']);
                            $form['groupsImages']->addError(new FormError('Au moins une image secondaire n\'a pas le bon format'));
                            return $this->render('oeuvres/oeuvre_ajout.html.twig', [
                                        'form' => $form->createView()
                            ]);
                        }
                    }
                }
            }
            // enregistrement de la photo principale
            $file = $form['photoPrincipale']->getData();
            if ($file) {
                $newFilename = time() . '_' . $tour;
                try {
                    $actual_path = $file->getPathname();

                    $photo = new Photo();
                    $photo->setNomServeur($newFilename);

                    $this->saveImage($actual_path, $photo->getCheminServeur(), PHOTO::TAILLE_MAX);
                    $this->saveImage($actual_path, $photo->getCheminMiniatureServeur(), PHOTO::TAILLE_MINIATURE);

                    $oeuvreTemp->setPhotoPrincipale($photo);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }

            // enregistrement des photos secondaires
            $file = $form['groupsImages']->getData();
            if ($file) {
                foreach ($file as $value) {
                    foreach ($value->getPhotos() as $key => $photo) {
                        $tour = $tour + 1;
                        $newFilename = time() . '_' . $tour;
                        try {
                            $actual_path = $value->getFiles()[$key];

                            $photo = new Photo();
                            $photo->setNomServeur($newFilename);

                            $this->saveImage($actual_path, $photo->getCheminServeur(), PHOTO::TAILLE_MAX);
                            $this->saveImage($actual_path, $photo->getCheminMiniatureServeur(), PHOTO::TAILLE_MINIATURE);

                            $oeuvre->addPhotoSecondaire($photo);
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }
                    }
                }
            }

            // enregistrement de l'oeuvre
            $oeuvreTemp->toOeuvre($oeuvre);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($oeuvre);
            $entityManager->flush();

            $newOeuvreId = $oeuvre->getId();

            //message de confirmation de creation d'oeuvre
            $this->addFlash(
                'info',
                'L\'oeuvre a bien été créée.'
            );

            return $this->redirectToRoute("visualiserOeuvre", ['oeuvreId' => $newOeuvreId]);
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $file = $form['groupsImages']->getData();
            $form = $this->ErrorForm($form, $oeuvre, ['modifier' => false, 'texte_bouton' => 'Ajouter']);
            if ($file) {
                $extensions_autorisees = array('png', 'jpg', 'jpeg', 'gif', 'webp');
                foreach ($file as $value) {
                    foreach ($value->getPhotos() as $key => $photo) {
                        if (!in_array($value->getFiles()[$key]->getClientOriginalExtension(), $extensions_autorisees)) {
                            $form['groupsImages']->addError(new FormError('Au moins une image secondaire n\'a pas le bon format'));
                            return $this->render('oeuvres/oeuvre_ajout.html.twig', [
                                        'form' => $form->createView()
                            ]);
                        }
                    }
                }
            }
        }

        // render the inscription form
        return $this->render('oeuvres/oeuvre_ajout.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     * @return \Symfony\Component\Form\FormInterface
     */
    public function ErrorForm(\Symfony\Component\Form\FormInterface $form, $oeuvreOriginale, $arrayArgs) {
        $oeuvreTemp = new OeuvreTemp();
        $oeuvreTemp->fromOeuvre($oeuvreOriginale);
        $formOld = $form;
        $form = $this->createForm(OeuvreType::class, $oeuvreTemp, $arrayArgs);
        $this->setOldFormToNewForm($formOld, $form, 'auteurs');
        $this->setOldFormToNewForm($formOld, $form, 'datePublication');
        $this->setOldFormToNewForm($formOld, $form, 'nom');
        $this->setOldFormToNewForm($formOld, $form, 'descriptif');
        $this->setOldFormToNewForm($formOld, $form, 'categorie');
        foreach ($formOld['nom']->getErrors() as $key => $error) {
            $form['nom']->addError($error);
        }
        foreach ($formOld['descriptif']->getErrors() as $key => $error) {
            $form['descriptif']->addError($error);
        }
        foreach ($formOld['categorie']->getErrors() as $key => $error) {
            $form['categorie']->addError($error);
        }
        foreach ($formOld['photoPrincipale']->getErrors() as $key => $error) {
            $form['photoPrincipale']->addError($error);
        }
        foreach ($formOld['auteurs']->getErrors() as $key => $error) {
            $form['auteurs']->addError($error);
        }
        return $form;
    }

    private function setOldFormToNewForm($formOld, $formNew, $nomAttribut) {
        if ($formOld[$nomAttribut]->getData() != null) {
            $formNew[$nomAttribut]->setData($formOld[$nomAttribut]->getData());
        }
    }

    /**
     * Redimensionne et sauvegarde (au format jpg) sur le serveur une image et sa miniature
     *
     * @param string    $actual_path        path chemin ou est stocké l'image avant l'enregistrement
     * @param string    $wanted_path        nom de la future image sur le serveur
     * @param int       $wanted_max_size    taille maximale de l'image
     */
    private function saveImage($actual_path, $wanted_path, $wanted_max_size) {
        $widthMax = $wanted_max_size;
        $heightMax = $wanted_max_size;

        $img = ImageManagerStatic::make($actual_path);

        $width = $img->width();
        $height = $img->height();

        if ($width > $widthMax | $height > $heightMax) {
            if ($width > $height) {
                $img->resize($widthMax, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img->resize(null, $heightMax, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        }

        $finaleFileName = $this->getParameter('photo_directory') . "/" . $wanted_path;

        $img->save($finaleFileName, 90, 'jpg');
    }

    //---------------------------------------------------------------------------------

    /**
     * Page de visualisation d'une oeuvre
     *
     * @Route("/oeuvre/{oeuvreId}", name="visualiserOeuvre", requirements={"oeuvreId"="\d+"}))
     *
     * @param int $oeuvreId ID de l'oeuvre à visualiser
     *
     * @return NotFoundHttpException | Response
     * @throws \Exception
     */
    public function visualiserOeuvreAction(Request $request, $oeuvreId) {
        $entityManager = $this->getDoctrine()->getManager();

        $oeuvre = $entityManager->getRepository(Oeuvre::class)
                ->find($oeuvreId);

        if (!$oeuvre) {
            throw $this->createNotFoundException(
                    'Aucune oeuvre trouvée pour l\'id  ' . $oeuvreId
            );
        }
        $valAvis = $entityManager->getRepository(Avis::class)
                ->findOneBy([
            'utilisateur' => $this->getUser(),
            'oeuvre' => $oeuvre
        ]);

        //création du formulaire de commentaire
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setUtilisateur($this->getUser());
            $commentaire->setDate(new \DateTime('now'));
            $commentaire->setOeuvre($oeuvre);

            $entityManager->persist($commentaire);
            $entityManager->flush();

            // réinitialiser le formulaire de commentaire
            $commentaire = new Commentaire();
            $form = $this->createForm(CommentaireType::class, $commentaire);
        }

        return $this->render('oeuvres/oeuvre_visu.html.twig', [
                    'valAvis' => $valAvis,
                    'oeuvre' => $oeuvre,
                    'datePublication' => $oeuvre->getDatePublication(),
                    'avis' => $oeuvre->ratioAvis(),
                    'form' => $form->createView(),
                    'avisPourcentage' => $oeuvre->ratioAvisPourcentage()
        ]);
    }

    /**
     * Mettre un avis
     *
     * @Route("/ajouter-avis/{oeuvreId}/{valAvis}", name="ajouterAvis", requirements={"oeuvreId"="\d+", "valAvis"="\d+"}))
     *
     * @param int $oeuvreId ID de l'oeuvre auquel on ajoute l'avis
     *
     * @param int $valAvis valeur de l'avis (1 ou 0)
     *
     * @return Response
     */
    public function ajouterAvis($oeuvreId, $valAvis) {

        $entityManager = $this->getDoctrine()->getManager();
        $oeuvre = $entityManager->getRepository(Oeuvre::class)
                ->find($oeuvreId);

        if(!$oeuvre){
            throw $this->createNotFoundException(
                    'Aucune oeuvre trouvée pour l\'id  ' . $oeuvreId
            );
        }

        $avis = $entityManager->getRepository(Avis::class)
                ->findOneBy([
            'utilisateur' => $this->getUser(),
            'oeuvre' => $oeuvre
        ]);
        if ($avis == null) {
            $avis = new Avis();
        }
        $avis->setOeuvre($oeuvre);
        if ($valAvis == "1") {
            $avis->setType(Avis::AVIS_POSITIF);
        } else {
            $avis->setType(Avis::AVIS_NEGATIF);
        }
        $avis->setUtilisateur($this->getUser());
        $avis->setDate(date_create("now"));

        $entityManager->persist($avis);
        $entityManager->flush();

        //message de confirmation de vote
        $this->addFlash(
            'info-avis',
            'Votre avis a bien été pris en compte.'
        );

        return $this->redirectToRoute("visualiserOeuvre", ['oeuvreId' => $oeuvreId, 'valAvis' => $avis]);
    }

    /**
     * supprimer avis
     *
     * @Route("/supprimer-avis/{oeuvreId}/{avisId}", name="supprimerAvis", requirements={"oeuvreId"="\d+", "avisId"="\d+"}))
     *
     * @param int $oeuvreId ID de l'oeuvre auquel on supprime l'avis
     *
     * @param int $avisId ID de l'avis d'une oeuvre courante
     *
     * @return Response
     */
    public function supprimerAvis($oeuvreId, $avisId) {
        $entityManager = $this->getDoctrine()->getManager();
        $avis = $entityManager->getRepository(Avis::class)->find($avisId);
        $entityManager->remove($avis);
        $entityManager->flush();
        return $this->redirectToRoute("visualiserOeuvre", ['oeuvreId' => $oeuvreId]);
    }

    //---------------------------------------------------------------------------------

    /**
     * Page qui permet de visualiser la liste des oeuvres créées par l'utilisateur courant
     *
     * @Route("/mes-oeuvres", name="mesOeuvres")
     *
     * @return Response
     */
    public function mesOeuvresAction() {
        $entityManager = $this->getDoctrine()->getManager();

        $oeuvres = $entityManager->getRepository(Oeuvre::class)
                ->findBy([
            'createur' => $this->getUser()
        ]);

        return $this->render('oeuvres/mes_oeuvres.html.twig', [
                    'oeuvres' => $oeuvres
        ]);
    }

    /**
     * Page qui permet de modifier une oeuvre créée par l'utilisateur courant
     *
     * @Route("/editerOeuvre/{oeuvreId}", name="editerOeuvre", requirements={"oeuvreId"="\d+"}))
     *
     * @param Request $request
     *
     * @param int $oeuvreId ID de l'oeuvre à modifier
     *
     * @return Response
     */
    public function modifierOeuvresAction(Request $request, $oeuvreId) {
        $entityManager = $this->getDoctrine()->getManager();

        $oeuvre = $entityManager->getRepository(Oeuvre::class)
                ->findOneById($oeuvreId);

        if(!$oeuvre){
            throw $this->createNotFoundException(
                    'Aucune oeuvre trouvée pour l\'id  ' . $oeuvreId
            );
        }

        if($oeuvre->getCreateur() != $this->getUser()){
            throw $this->createAccessDeniedException(
                'Vous n\'avez pas le droit d\'accéder à la page d\'édition d\'une oeuvre que vous n\'avez pas créée.'
            );
        }

        $oeuvreTemp = new OeuvreTemp();
        $oeuvreTemp->fromOeuvre($oeuvre);
        $form = $this->createForm(OeuvreType::class, $oeuvreTemp, array(
            'modifier' => true,
            'texte_bouton' => 'Modifier',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tour = 0;
            $photosASupprimer = array();
            // enregistrement de la photo principale
            $file = $form['photoPrincipale']->getData();
            if ($file) {
                $newFilename = time() . '_' . $tour;
                try {
                    $actual_path = $file->getPathname();

                    $photo = new Photo();
                    $photo->setNomServeur($newFilename);

                    $this->saveImage($actual_path, $photo->getCheminServeur(), PHOTO::TAILLE_MAX);
                    $this->saveImage($actual_path, $photo->getCheminMiniatureServeur(), PHOTO::TAILLE_MINIATURE);

                    $oeuvreTemp->setPhotoPrincipale($photo);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }

            $supprimerPhotoPrincipale = $form['supprimerPhotoPrincipale']->getData();
            if ($supprimerPhotoPrincipale) {
                $photosASupprimer[] = $oeuvreTemp->getPhotoPrincipale();
                $oeuvreTemp->setPhotoPrincipale(null);
            }

            $oeuvreTemp->toOeuvre($oeuvre);
            $file = $form['groupsImages']->getData();
            if ($file) {
                //suppression des photos secondaires à supprimer
                foreach ($oeuvre->getPhotosSecondaires() as $key => $image) {
                    $present = false;
                    foreach ($oeuvreTemp->getGroupsImages() as $keyGr => $group) {
                        if (in_array($image, $group->getPhotos()->toArray())) {
                            $present = true;
                        }
                    }
                    if (!$present) {
                        $oeuvre->removePhotoSecondaire($image);
                        $photosASupprimer[] = $image;
                    }
                }

                //vérification de format des nouvelles images secondaires
                $file = $form['groupsImages']->getData();
                if ($file) {
                    $extensions_autorisees = array('png', 'jpg', 'jpeg', 'gif', 'webp');
                    foreach ($file as $value) {
                        foreach ($value->getPhotos() as $key => $photo) {
                            if ($value->getFiles()[$key] && !in_array($value->getFiles()[$key]->getClientOriginalExtension(), $extensions_autorisees)) {
                                $form = $this->ErrorForm($form, $oeuvre, ['modifier' => true, 'texte_bouton' => 'Modifier'], false);
                                $form['groupsImages']->addError(new FormError('Au moins une image secondaire n\'a pas le bon format'));
                                return $this->render('oeuvres/oeuvre_modif.html.twig', [
                                            'oeuvre' => $oeuvre,
                                            'form' => $form->createView()
                                ]);
                            }
                        }
                    }
                }
                foreach ($file as $value) {
                    foreach ($value->getPhotos() as $key => $photo) {
                        if ($value->getFiles()[$key]) {
                            $tour = $tour + 1;
                            $newFilename = time() . '_' . $tour;
                            try {
                                $actual_path = $value->getFiles()[$key];

                                $photo = new Photo();
                                $photo->setNomServeur($newFilename);

                                $this->saveImage($actual_path, $photo->getCheminServeur(), PHOTO::TAILLE_MAX);
                                $this->saveImage($actual_path, $photo->getCheminMiniatureServeur(), PHOTO::TAILLE_MINIATURE);

                                $oeuvre->addPhotoSecondaire($photo);
                            } catch (FileException $e) {
                                // ... handle exception if something happens during file upload
                            }
                        }
                    }
                }
            }

            // enregistrement de l'oeuvre
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $entityManager->refresh($oeuvre);

            //message de confirmation de creation d'oeuvre
            $this->addFlash(
                'info',
                'L\'oeuvre à bien été modifiée.'
            );

            $photoDir = $this->getParameter('photo_directory');
            foreach ($photosASupprimer as $key => $photo) {
                $name = $photo->getCheminServeur();
                if (file_exists($photoDir . '/' . $name)) {
                    unlink($photoDir . '/' . $name);
                }
                $name = $photo->getCheminMiniatureServeur();
                if (file_exists($photoDir . '/' . $name)) {
                    unlink($photoDir . '/' . $name);
                }
            }

            return $this->redirectToRoute("visualiserOeuvre", ['oeuvreId' => $oeuvre->getId()]);
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $file = $form['groupsImages']->getData();
            $form = $this->ErrorForm($form, $oeuvre, ['modifier' => true, 'texte_bouton' => 'Modifier']);
            if ($file) {
                $extensions_autorisees = array('png', 'jpg', 'jpeg', 'gif', 'webp');
                foreach ($file as $value) {
                    foreach ($value->getPhotos() as $key => $photo) {
                        if ($value->getFiles()[$key] != null && !in_array($value->getFiles()[$key]->getClientOriginalExtension(), $extensions_autorisees)) {
                            $form['groupsImages']->addError(new FormError('Au moins une image secondaire n\'a pas le bon format'));
                            return $this->render('oeuvres/oeuvre_modif.html.twig', [
                                        'oeuvre' => $oeuvre,
                                        'form' => $form->createView()
                            ]);
                        }
                    }
                }
            }
        }

        return $this->render('oeuvres/oeuvre_modif.html.twig', [
                    'oeuvre' => $oeuvre,
                    'form' => $form->createView(),
        ]);
    }

}
