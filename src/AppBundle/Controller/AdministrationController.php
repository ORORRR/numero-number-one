<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categorie;
use AppBundle\Entity\Oeuvre;
use AppBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends Controller
{
    /**
     * @Route("/admin", name="administration")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function administrationAction(Request $request)
    {
        return $this->redirectToRoute("adminCategories");
    }

    //--------------------------------------------------------------------

    /**
     * Page de l'administration qui permet de gérer les catégories
     *
     * @Route("/admin/categories", name="adminCategories")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function categoriesAction(Request $request, $errors = null)
    {
        //récupération des catgorie existentes
        $cats = $this->getDoctrine()->getRepository(Categorie::class)->findAll();

        // construction du formulaire pour ajouter une catégorie
        $categorie = new Categorie();
        $form = $this->createFormBuilder($categorie)
            ->add('nom', TextType::class)
            ->getForm();

        // submit du form d'ajout de catégorie
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // sauvegarde de la catégorie
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute("adminCategories");
        }

        // affichage de la page de gestion des catégories
        return $this->render('administration/Categories.html.twig', [
            'form' => $form->createView(),
            'cats' => $cats
        ]);
    }

    /**
     * @Route("/admin/suppression-categorie/{categorieId}", name="suppressionCategorie")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function suppressionCategorie(Request $request, $categorieId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categorie = $entityManager->getRepository(Categorie::class)->find($categorieId);

        if ($categorie == null) {
            //add error flash message
            $this->addFlash(
                'error',
                'La catégorie que vous vouliez supprimer n\'existe plus'
            );
        }
        else{
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute("adminCategories");
    }

    //--------------------------------------------------------------------

    /**
     * Page de l'administration qui permet de gérer les oeuvres
     *
     * @Route("/admin/oeuvres", name="adminOeuvres")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function oeuvresAction(Request $request)
    {
        $oeuvres = $this->getDoctrine()->getRepository(Oeuvre::class)->findAll();
        return $this->render('administration/Oeuvres.html.twig', [
            'oeuvres' => $oeuvres
        ]);
    }

    /**
     * @Route("/admin/suppression-oeuvre/{oeuvreId}", name="suppressionOeuvre")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function suppressionOeuvre(Request $request, $oeuvreId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $oeuvre = $entityManager->getRepository(Oeuvre::class)->find($oeuvreId);

        if ($oeuvre == null) {
            //add error flash message
            $this->addFlash(
                'error',
                'La oeuvre que vous vouliez supprimer n\'existe plus'
            );
        }else{
            $entityManager->remove($oeuvre);
            $entityManager->flush();
        }

        return $this->redirectToRoute("adminOeuvres");
    }

    //--------------------------------------------------------------------

    /**
     * Page de l'administration qui permet de gérer les utilisateurs
     *
     * @Route("/admin/utilisateurs", name="adminUtilisateurs")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function utilisateursAction(Request $request)
    {
        $utilisateurRepository = $this->getDoctrine()->getRepository(Utilisateur::class);

        //creation du formulaire de recherche d'utilisateur
        $form_recherche = $this->createFormBuilder()
            ->add('login', TextType::class, [
                'label' => 'Recherche par login'
            ])
            ->add('chercher', SubmitType::class, [
                'label' => false,
                'attr' => [
                    'value' => ''
                ],
            ])->getForm();

        $utilisateurs = $utilisateurRepository->findAllUtilisateurs();

        //submit du formulaire de recherche
        $form_recherche->handleRequest($request);
        if ($form_recherche->isSubmitted() && $form_recherche->isValid()) {
            //recherche des utilisateur par leur login
            $login = $form_recherche->getData()['login'];
            $utilisateurs = $utilisateurRepository->findUtilisateursByLogin($login);
        }

        return $this->render('administration/Utilisateurs.html.twig', [
            'form_recherche' => $form_recherche->createView(),
            'utilsateurs' => $utilisateurs
        ]);
    }

    /**
     * @Route("/admin/suppression-utilisateur/{userId}", name="suppressionUtilisateur")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function suppressionUtilisateur(Request $request, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Utilisateur::class)->find($userId);

        if ($user == null) {
            //add error flash message
            $this->addFlash(
                'error',
                'L\'utilisateur que vous vouliez supprimer n\'existe plus'
            );
        }
        else{
            //anomymisation des oeuvres créée l'utilisateur
            foreach ($user->getOeuvres() as $oeuvre) {
                $oeuvre->setCreateur(null);
            }

            //anonymisation des commentaires posté l'utilisateur
            foreach ($user->getCommentaires() as $commentaire) {
                $commentaire->setUtilisateur(null);
            }

            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute("adminUtilisateurs");
    }
}
