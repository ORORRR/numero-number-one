<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Oeuvre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{

    /**
     * Page principale de NuméroNumberOne
     *
     * @Route("/", name="home")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function homeAction(Request $request)
    {
        // creation du formulaire de recherchre d'oeuvres
        $recherche_oeuvre_form = $this->createFormBuilder(null)
            ->add('Barre', TextType::class, [
                'label' => false
            ])
            ->add('Rechercher', SubmitType::class, [
                'label' => false,
                'attr' => [
                    'value' => ''
                ]
            ])->getForm();

        // traitement du forumlaire de recherche d'oeuvres
        $recherche_oeuvre_form->handleRequest($request);
        if ($recherche_oeuvre_form->isSubmitted() && $recherche_oeuvre_form->isValid()) {

            $recherche = $recherche_oeuvre_form->getData()['Barre'];

            $oeuvreRepository = $this->getDoctrine()->getRepository(Oeuvre::class);
            $oeuvres = $oeuvreRepository->findOeuvre($recherche);

            return $this->render('home.html.twig', [
                'form' => $recherche_oeuvre_form->createView(),
                'recherche' => $recherche,
                'oeuvres' => $oeuvres
            ]);
        }

        return $this->render('home.html.twig', [
            'form' => $recherche_oeuvre_form->createView()
        ]);
    }
}
