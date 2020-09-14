#language: fr
  Fonctionnalité: Suppression d'une oeuvre
    En tant qu'administrateur,
    Il est possible d'utiliser les outils d'administration
    Afin de supprimer une oeuvre

  Scénario: Suppression d'une oeuvre - OK
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "toDelete" créée dans la catégorie "catTest"
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet de suppression d'une oeuvre
    Quand l'utilisateur supprime l'oeuvre "toDelete"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet de suppression d'une oeuvre
    Et l'oeuvre "toDelete" est supprimée

    Scénario: Suppression d'une oeuvre - 2 fois la même oeuvre
      Etant donné l'accès au site effectué avec JS
      Et la catégorie "catTest" créée préalablement
      Et l'oeuvre "toDeleteTwice" créée dans la catégorie "catTest"
      Et l'utilisateur connecté en tant qu'administrateur
      Et une nouvelle page ouverte sur l'onglet de suppression d'une oeuvre
      Et l'utilisateur sur l'onglet de suppression d'une oeuvre
      Quand l'utilisateur supprime l'oeuvre "toDeleteTwice"
      Alors l'utilisateur est redirigé
      Et l'utilisateur est sur l'onglet de suppression d'une oeuvre
      Et l'oeuvre "toDeleteTwice" est supprimée
      Quand le second utilisateur supprime l'oeuvre "toDeleteTwice"
      Alors le second utilisateur est redirigé
      Et le second utilisateur est sur l'onglet de suppression d'une oeuvre
      Et le message d'erreur "La oeuvre que vous vouliez supprimer n'existe plus" est affiché sur la deuxième page