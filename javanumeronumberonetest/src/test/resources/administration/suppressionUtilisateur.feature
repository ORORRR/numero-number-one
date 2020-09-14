#language: fr
  Fonctionnalité: Suppression d'un utilisateur
    En tant qu'administrateur,
    Il est possible de supprimer un utilisateur,
    À partir de la liste des utilisateurs

  Scénario: Suppression d'un utilisateur - OK
    Etant donné l'accès au site effectué avec JS
    Et l'utilisateur "roger" créé
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet de gestion des utilisateurs
    Quand l'utilisateur supprime l'utilisateur "roger"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet de gestion des utilisateurs
    Et l'utilisateur "roger" est supprimé

  Scénario: Suppression d'un utilisateur - 2 fois le même utilisateur
    Etant donné l'accès au site effectué avec JS
    Et l'utilisateur "philippe" créé
    Et l'utilisateur connecté en tant qu'administrateur
    Et une nouvelle page ouverte sur l'onglet de gestion des utilisateurs pour supprimer "philippe"
    Et l'utilisateur sur l'onglet de gestion des utilisateurs
    Quand l'utilisateur supprime l'utilisateur "philippe"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet de gestion des utilisateurs
    Et l'utilisateur "philippe" est supprimé
    Quand le second utilisateur supprime l'utilisateur "philippe"
    Alors le second utilisateur est redirigé
    Et le second utilisateur est sur l'onglet de gestion des utilisateurs
    Et le message d'erreur "L'utilisateur que vous vouliez supprimer n'existe plus" est affiché sur la deuxième page