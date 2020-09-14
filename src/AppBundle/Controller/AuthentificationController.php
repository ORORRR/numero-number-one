<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateur;
use AppBundle\Form\UserType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class AuthentificationController extends Controller
{
    /**
     * @Route("/connexion", name="connexion")
     *
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function connextionAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // si l'utilisateur est déjà connecté le rediriger vers la page principale
        if($this->getUser() != null){
            return $this->redirectToRoute('home');
        }

        // récupération du dernier login entré dans le formulaire
        $lastUsername = $authenticationUtils->getLastUsername();

        // récupération de l'erreur de connexion (s'il y en a une)
        $error = $authenticationUtils->getLastAuthenticationError();

        // changement de l'erreur BadCredential pour qu'elle soit en français
        if($error instanceof BadCredentialsException){
            $error = new CustomUserMessageAuthenticationException('Identifiants incorrects.');
        }

        return $this->render('authentification/connexion.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     * @return Response
     */
    public function inscriptionAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // si l'utilisateur est déjà connecté le rediriger vers la page principale
        if($this->getUser() != null){
            return $this->redirectToRoute('home');
        }

        // build the form
        $user = new Utilisateur();
        $form = $this->createForm(UserType::class, $user);

        // handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $plainPassword = $user->getPlainPassword();
            if($plainPassword == null){
                $form->addError(new FormError("Le mot de passe doit être renseigné"));
            }

            if ($form->isValid()){
                // Encode the password
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);

                // save the User
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                //connect the user
                // The third parameter "main" can change according to the name of your firewall in security.yml
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);

                $this->get('session')->set('_security_main', serialize($token));

                // Fire the login event manually
                $event = new InteractiveLoginEvent($request, $token);
                $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

                //redirect the user to home page
                return $this->redirectToRoute("home");
            }
        }

        // render the inscription form
        return $this->render('authentification/inscription.html.twig', [
                'form' => $form->createView()
        ]);
    }
}
