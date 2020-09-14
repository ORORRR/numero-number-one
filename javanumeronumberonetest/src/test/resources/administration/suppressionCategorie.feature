#language: fr

  Fonctionnalité: Suppression d'une catégorie
    En tant qu'administrateur,
    Il est possible d'utiliser les outils d'administration
    Afin de supprimer une catégorie d'oeuvre

  Scénario: Suppression d'une catégorie - OK
    Etant donné l'accès au site effectué avec JS
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet de suppression d'une catégorie
    Et la catégorie "toDelete" créée
    Quand l'utilisateur supprime la catégorie "toDelete"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet de suppression d'une catégorie
    Et la catégorie "toDelete" est supprimée
    
  Scénario: Suppression d'une catégorie - 2 fois la même catégorie
    Etant donné l'accès au site effectué avec JS
    Et l'utilisateur connecté en tant qu'administrateur
    Et la catégorie "toDeleteTwice" créée
    Et une nouvelle page ouverte sur l'onglet de suppression d'une catégorie
    Et l'utilisateur sur l'onglet de suppression d'une catégorie
    Quand l'utilisateur supprime la catégorie "toDeleteTwice"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet de suppression d'une catégorie
    Et la catégorie "toDeleteTwice" est supprimée
    Quand le second utilisateur supprime la catégorie "toDeleteTwice"
    Alors le second utilisateur est redirigé
    Et le second utilisateur est sur l'onglet de suppression d'une catégorie
    Et le message d'erreur "La catégorie que vous vouliez supprimer n'existe plus" est affiché sur la deuxième page

  Scénario: Suppression d'une catégorie - Sous-oeuvres existantes
    Etant donné l'accès au site effectué avec JS
    Et l'utilisateur connecté en tant qu'administrateur
    Et la catégorie "Opera" créée
    Et une oeuvre "La traviata" créée dans la catégorie "Opera"
    Et l'utilisateur sur l'onglet de suppression d'une catégorie
    Quand l'utilisateur supprime la catégorie "Opera"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet de suppression d'une catégorie
    Et la catégorie "Opera" est supprimée
    Et l'oeuvre "La traviata" est supprimée