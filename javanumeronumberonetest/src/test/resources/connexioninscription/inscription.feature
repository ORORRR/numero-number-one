#language: fr
Fonctionnalité: Inscription
  En tant que Visiteur du Site,
  Il est possible de s'inscrire en renseignant un login et un mot de passe
  Afin de disposer d'un compte utilisateur

  Scénario: Inscription - OK
    Etant donné l'accès au site effectué
    Et l'utilisateur sur la page d'inscription
    Quand l'utilisateur renseigne le nom d'utilisateur "jean"
    Et les mots de passe "paul"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est connecté en tant que "jean"
    Et le bouton de déconnexion est visible

  Scénario: Inscription - Nom vide
    Etant donné l'accès au site effectué
    Et l'utilisateur sur la page d'inscription
    Quand l'utilisateur renseigne le nom d'utilisateur ""
    Et les mots de passe "password"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page d'inscription
    Et le message d'erreur "Le login doit être renseigné" est affiché

  Scénario: Inscription - Mot de passe vide
    Etant donné l'accès au site effectué
    Et l'utilisateur sur la page d'inscription
    Quand l'utilisateur renseigne le nom d'utilisateur "jean"
    Et les mots de passe ""
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page d'inscription
    Et le message d'erreur "Le mot de passe doit être renseigné" est affiché

  Scénario: Inscription - Compte déjà existant
    Etant donné l'accès au site effectué
    Et l'utilisateur "jeanne" créé
    Et l'utilisateur sur la page d'inscription
    Quand l'utilisateur renseigne le nom d'utilisateur "jeanne"
    Et les mots de passe "test"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page d'inscription
    Et le message d'erreur "Ce login est déjà utilisé" est affiché

  Scénario: Inscription - Compte déjà existant (modulo espace)
    Etant donné l'accès au site effectué
    Et l'utilisateur "jeannot" créé
    Et l'utilisateur sur la page d'inscription
    Quand l'utilisateur renseigne le nom d'utilisateur "jeannot      "
    Et les mots de passe "pwd"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page d'inscription
    Et le message d'erreur "Ce login est déjà utilisé" est affiché

  Scénario: Inscription - Mots de passe non identiques
    Etant donné l'accès au site effectué
    Et l'utilisateur sur la page d'inscription
    Quand l'utilisateur renseigne le nom d'utilisateur "Regis"
    Et les mots de passe "test1","test2"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page d'inscription
    Et le message d'erreur "Les mots de passes doivent être identiques" est affiché

  Scénario: Inscription - Login trop long
    Etant donné l'accès au site effectué
    Et l'utilisateur sur la page d'inscription
    Quand l'utilisateur renseigne le nom d'utilisateur "HerculeSavinienCyranoDeBergeracLeGrandLeBeauLeFortQueDisJeLeFortLeParfaitEtCestUnPeuCourtJeuneHommeOnPouvaitDireOhDieuBienDesChosesEnSommeEnVariantLeTonParExempleTenezChristopheIsabelleThaisArthurPhillippeCharleneJulienJustineAlicePatriceCecileAureleEdgarMathilde"
    Et les mots de passe "test"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page d'inscription
    Et le message d'erreur "Le login est trop long" est affiché