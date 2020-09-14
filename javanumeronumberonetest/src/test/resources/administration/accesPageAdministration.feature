#language: fr
  Fonctionnalité: Accès à la page d'administration
    En tant qu'administrateur,
    Il est possible d'accéder à la page d'administration
    Afin de réaliser les différentes opérations d'administration

  Scénario: Accès à la page par le bouton
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Alors le lien d'accès à la page d'administration est visible
    Quand l'utilisateur se déconnecte
    Et l'utilisateur connecté en tant que membre
    Alors le lien d'accès à la page d'administration n'est plus visible

  Scénario: Accès à la page par le lien en tant qu'utilisateur
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur accède à la page "admin" par le lien
    Alors le message d'erreur "403 - Accès refusé" est affiché
    Quand l'utilisateur accède à la page "admin/categories" par le lien
    Alors le message d'erreur "403 - Accès refusé" est affiché
    Quand l'utilisateur accède à la page "admin/utilisateurs" par le lien
    Alors le message d'erreur "403 - Accès refusé" est affiché
    Quand l'utilisateur accède à la page "admin/oeuvres" par le lien
    Alors le message d'erreur "403 - Accès refusé" est affiché
    Alors l'utilisateur clique sur le bouton de retour à l'acceuil
    Et l'utilisateur est sur la page principale
