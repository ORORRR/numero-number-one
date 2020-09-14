#language: fr
  Fonctionnalité: Déconnexion
    En tant Visiteur du Site connecté,
    Il est possible de se déconnecter du site,
    Afin de perdre les privilèges de connexion

  Scénario: Déconnexion - OK
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur se déconnecte
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de connexion