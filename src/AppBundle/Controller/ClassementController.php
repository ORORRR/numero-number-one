<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categorie;
use AppBundle\Entity\Oeuvre;
use DateTime;
use Doctrine\Common\Proxy\Exception\OutOfBoundsException;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassementController extends Controller
{
    /**
     * @Route("/classement", name="classement")
     *
     * @param Request $request
     *
     * @return Response
     * @throws \Exception
     */
    public function classementAction(Request $request)
    {
        // build the form
        $form = $this->createFormBuilder()
            ->add('nom', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'invalid_message' => 'La catégorie sélectionnée n\'existe pas (ou plus).',
            ])
            ->add('periode', ChoiceType::class, [
                'choices' => [
                    'Année' => 1,
                    'Mois' => 2,
                    'Semaine' => 3,
                ],
            ])
            ->getForm();

        // traitement du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form['nom']->getData();
            $periode = $form['periode']->getData();

            $categorieId = $categorie->getId();

            if ($periode == 1) {
                $p1 = new \DateInterval('P1Y');
                $beginDate = new DateTime();
                $beginDate->format('Y-m-d H:i:s');
                $beginDate->sub($p1);

            } else if ($periode == 2) {
                $p1 = new \DateInterval('P1M');
                $beginDate = new DateTime();
                $beginDate->format('Y-m-d H:i:s');
                $beginDate->sub($p1);
            } else {
                $p1 = new \DateInterval('P7D');
                $beginDate = new DateTime();
                $beginDate->format('Y-m-d H:i:s');
                $beginDate->sub($p1);
            }

            $endDate = new DateTime();
            $endDate->format('Y-m-d H:i:s');

            //récupération de toutes les oeuvres de la catégorie qui ont avis pendant la période indiquée
            $oeuvres = $this->getDoctrine()->getRepository(Oeuvre::class)
                ->findOeuvresByCategorieByAvisCreatedBetweenTwoDates($beginDate, $endDate, $categorieId);

            //tri des oeuvres par pourcentages positifs
            usort($oeuvres, function (Oeuvre $a, Oeuvre $b) {
                if ($b->ratioAvisPourcentage() != $a->ratioAvisPourcentage())
                    return $b->ratioAvisPourcentage() - $a->ratioAvisPourcentage();
                else
                    return $b->getNbAvisPositif() - $a->getNbAvisPositif();
            });

            return $this->render('classement/classement.html.twig', [
                'form' => $form->createView(),
                'oeuvres' => $oeuvres
            ]);
        }

        // render the category form
        return $this->render(
            'classement/classement.html.twig',
            ['form' => $form->createView()]
        );
    }
}