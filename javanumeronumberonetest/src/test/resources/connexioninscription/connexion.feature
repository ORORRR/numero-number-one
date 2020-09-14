#language: fr
  Fonctionnalité: Connexion
    En tant que visiteur du site,
    Il est possible de se connecter à l'aide d'un login et d'un mot de passe,
    Afin d'accéder à ses données

  Scénario: Connexion - OK
    Etant donné l'accès au site effectué
    Et l'utilisateur "loginTest", "mdpTest123" inscrit
    Quand l'utilisateur renseigne le login "loginTest"
    Et le mot de passe "mdpTest123"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est connecté en tant que "loginTest"
    Et le bouton de déconnexion est visible

  Scénario: Connexion - Champ vide
    Etant donné l'accès au site effectué
    Et l'utilisateur "404" n'existant pas
    Quand l'utilisateur renseigne le login "404"
    Et le mot de passe ""
    Alors l'utilisateur est redirigé
    Et l'utilisateur n'est pas connecté
    Et le message d'erreur "Identifiants incorrects." est affiché
    Quand l'utilisateur renseigne le login "404"
    Et le mot de passe "password"
    Alors l'utilisateur est redirigé
    Et l'utilisateur n'est pas connecté
    Et le message d'erreur "Identifiants incorrects." est affiché

  Scénario: Connexion - Mot de passe incorrect
    Etant donné l'accès au site effectué
    Et l'utilisateur "loginTest", "mdpTest123" inscrit
    Quand l'utilisateur renseigne le login "loginTest"
    Et le mot de passe "mdpTest1234"
    Alors l'utilisateur est redirigé
    Et l'utilisateur n'est pas connecté
    Et le message d'erreur "Identifiants incorrects." est affiché

  Scénario: Connexion - Utilisateur déjà connecté
    Etant donné l'accès au site effectué
    Et l'utilisateur déjà connecté
    Quand l'utilisateur accède à la page de connexion
    Alors l'utilisateur est redirigé
    Et l'utilisateur est connecté
    Et l'utilisateur est sur la page principale

  Scénario: Connexion - Utilisateur inconnu
    Etant donné l'accès au site effectué
    Et l'utilisateur "404" n'existant pas
    Quand l'utilisateur renseigne le login "404"
    Et le mot de passe "512"
    Alors l'utilisateur est redirigé
    Et l'utilisateur n'est pas connecté
    Et le message d'erreur "Identifiants incorrects." est affiché

  Scénario: Connexion - accès à la page principale sans être connecté
    Etant donné l'accès au site effectué
    Quand l'utilisateur accède à la page "" par le lien
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de connexion

  Scénario: Connexion - accès à l'administration sans être connecté
    Etant donné l'accès au site effectué
    Quand l'utilisateur accède à la page "admin" par le lien
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de connexion
    Quand l'utilisateur accède à la page "admin/categories" par le lien
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de connexion
    Quand l'utilisateur accède à la page "admin/oeuvres" par le lien
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de connexion
    Quand l'utilisateur accède à la page "admin/utilisateurs" par le lien
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de connexion

  Scénario: Connexion - accès à l'ajout d'oeuvre sans être connecté
    Etant donné l'accès au site effectué
    Quand l'utilisateur accède à la page "ajout-oeuvre" par le lien
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de connexion

  Scénario: Connexion - accès à mes-oeuvres sans être connecté
    Etant donné l'accès au site effectué
    Quand l'utilisateur accède à la page "mes-oeuvres" par le lien
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de connexion

  Scénario: Connexion - accès aux classements sans être connecté
    Etant donné l'accès au site effectué
    Quand l'utilisateur accède à la page "classement" par le lien
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de connexion