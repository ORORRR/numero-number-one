#language: fr
Fonctionnalité: Visualiser une oeuvre
  En tant que membre, ou administrateur
  Il est possible de visualiser une oeuvre

  Scénario: Visualiser une oeuvre - utilisateur qui a créé l'oeuvre
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest" créée dans la catégorie "catTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "visualiserOeuvreTest"
    Et l'utilisateur clique sur l'oeuvre "visualiserOeuvreTest" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "visualiserOeuvreTest"
    Et le bouton de vote n'est pas disponible
    Et le bouton d'edition s'affiche
    Et le formulaire de commentaire n'est pas disponible

  Scénario: Visualiser une oeuvre - administrateur
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest2" créée dans la catégorie "catTest"
    Et l'utilisateur connecté en tant qu'administrateur
    Quand l'utilisateur renseigne la chaine de caractère "visualiserOeuvreTest2"
    Et l'utilisateur clique sur l'oeuvre "visualiserOeuvreTest2" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "visualiserOeuvreTest2"
    Et le bouton de vote n'est pas disponible
    Et le bouton d'edition ne s'affiche pas
    Et le formulaire de commentaire n'est pas disponible

  Scénario: Visualiser une oeuvre - utilisateur qui n'as pas créé l'oeuvre
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest3" créée dans la catégorie "catTest" par "UserTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "visualiserOeuvreTest3"
    Et l'utilisateur clique sur l'oeuvre "visualiserOeuvreTest3" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "visualiserOeuvreTest3"
    Et le bouton de vote est disponible
    Et le bouton d'edition ne s'affiche pas
    Et le formulaire de commentaire est disponible

  ##############################################################################

  Scénario: Visualiser une oeuvre - affichage des avis - aucun avis
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest4" créée dans la catégorie "catTest" par "UserTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur vas à la page de l'oeuvre "visualiserOeuvreTest4"
    Alors l'avis affiché est "Aucun avis"
    Et le nombre d'avis est "0"
    Et aucun pourcentage n'est affiché dans la barre d'avis

  Scénario: Visualiser une oeuvre - affichage des avis - très positifs
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest5" créée dans la catégorie "catTest" par "UserTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur vas à la page de l'oeuvre "visualiserOeuvreTest5"
    Et l'utilisateur vote positivement
    Alors l'avis affiché est "Très positifs"
    Et le nombre d'avis est "1"
    Et le pourcentage "100" est affiché dans la barre d'avis

  Scénario: Visualiser une oeuvre - affichage des avis - très négatifs
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest6" créée dans la catégorie "catTest" par "UserTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur vas à la page de l'oeuvre "visualiserOeuvreTest6"
    Et l'utilisateur vote negativement
    Alors l'avis affiché est "Très négatifs"
    Et le nombre d'avis est "1"
    Et le pourcentage "0" est affiché dans la barre d'avis

  Scénario: Visualiser une oeuvre - affichage des avis - mitigés
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest7" créée dans la catégorie "catTest" par "UserTest"
    Et l'utilisateur "voteurVisualiserOeuvre7a", "1234" inscrit
    Quand l'utilisateur connecté en tant que membre
    Et l'utilisateur vote négativement pour l'oeuvre "visualiserOeuvreTest7"
    Quand l'utilisateur connecté avec le compte "voteurVisualiserOeuvre7a", "1234"
    Et l'utilisateur vas à la page de l'oeuvre "visualiserOeuvreTest7"
    Et l'utilisateur vote positivement
    Alors l'avis affiché est "Mitigés"
    Et le nombre d'avis est "2"
    Et le pourcentage "50" est affiché dans la barre d'avis

  Scénario: Visualiser une oeuvre - affichage des avis - plutôt positifs
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTes8" créée dans la catégorie "catTest" par "UserTest"
    Et l'utilisateur "voteurVisualiserOeuvre8a", "1234" inscrit
    Et l'utilisateur "voteurVisualiserOeuvre8b", "1234" inscrit
    Et l'utilisateur "voteurVisualiserOeuvre8c", "1234" inscrit
    Quand l'utilisateur connecté en tant que membre
    Et l'utilisateur vote positivement pour l'oeuvre "visualiserOeuvreTes8"
    Quand l'utilisateur connecté avec le compte "voteurVisualiserOeuvre8a", "1234"
    Et l'utilisateur vote positivement pour l'oeuvre "visualiserOeuvreTes8"
    Quand l'utilisateur connecté avec le compte "voteurVisualiserOeuvre8b", "1234"
    Et l'utilisateur vote positivement pour l'oeuvre "visualiserOeuvreTes8"
    Quand l'utilisateur connecté avec le compte "voteurVisualiserOeuvre8c", "1234"
    Et l'utilisateur vas à la page de l'oeuvre "visualiserOeuvreTes8"
    Et l'utilisateur vote negativement
    Alors l'avis affiché est "Plutôt positifs"
    Et le nombre d'avis est "4"
    Et le pourcentage "75" est affiché dans la barre d'avis

  Scénario: Visualiser une oeuvre - affichage des avis - plutôt négatifs
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTes9" créée dans la catégorie "catTest" par "UserTest"
    Et l'utilisateur "voteurVisualiserOeuvre9a", "1234" inscrit
    Et l'utilisateur "voteurVisualiserOeuvre9b", "1234" inscrit
    Et l'utilisateur "voteurVisualiserOeuvre9c", "1234" inscrit
    Quand l'utilisateur connecté en tant que membre
    Et l'utilisateur vote négativement pour l'oeuvre "visualiserOeuvreTes9"
    Quand l'utilisateur connecté avec le compte "voteurVisualiserOeuvre9a", "1234"
    Et l'utilisateur vote négativement pour l'oeuvre "visualiserOeuvreTes9"
    Quand l'utilisateur connecté avec le compte "voteurVisualiserOeuvre9b", "1234"
    Et l'utilisateur vote négativement pour l'oeuvre "visualiserOeuvreTes9"
    Quand l'utilisateur connecté avec le compte "voteurVisualiserOeuvre9c", "1234"
    Et l'utilisateur vas à la page de l'oeuvre "visualiserOeuvreTes9"
    Et l'utilisateur vote positivement
    Alors l'avis affiché est "Plutôt négatifs"
    Et le nombre d'avis est "4"
    Et le pourcentage "25" est affiché dans la barre d'avis

  Scénario: Visualiser une oeuvre - Oeuvre supprimée - depuis recherche
    Etant donné l'accès au site effectué
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest10" créée dans la catégorie "catTest" par "userTest"
    Et une nouvelle page ouverte sur l'onglet de suppression d'une oeuvre
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "visualiserOeuvreTest10"
    Et le second utilisateur supprime l'oeuvre "visualiserOeuvreTest10"
    Et l'utilisateur clique sur l'oeuvre "visualiserOeuvreTest10" dans la liste recherchée
    Alors le message d'erreur "404 - Page non trouvée" est affiché

  Scénario: Visualiser une oeuvre - Oeuvre supprimée - depuis admin
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest11" créée dans la catégorie "catTest" par "userTest"
    Et une nouvelle page ouverte sur l'onglet de suppression d'une oeuvre
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet de suppression d'une oeuvre
    Quand le second utilisateur supprime l'oeuvre "visualiserOeuvreTest11"
    Et l'utilisateur clique sur l'oeuvre "visualiserOeuvreTest11" dans la liste des oeuvres disponibles
    Alors le message d'erreur "404 - Page non trouvée" est affiché

  Scénario: Visualiser une oeuvre - Oeuvre supprimée - depuis mes oeuvres
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest12" créée dans la catégorie "catTest"
    Et une nouvelle page ouverte sur l'onglet de suppression d'une oeuvre
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur accède à ses oeuvres
    Et le second utilisateur supprime l'oeuvre "visualiserOeuvreTest12"
    Et l'utilisateur clique sur l'oeuvre "visualiserOeuvreTest12" dans la liste de ses oeuvres
    Alors le message d'erreur "404 - Page non trouvée" est affiché

  Scénario: Visualiser une oeuvre - Oeuvre supprimée - depuis classement
    Etant donné l'accès au site effectué
    Et la catégorie "JustForThisOne" créée préalablement
    Et l'oeuvre "visualiserOeuvreTest13" créée dans la catégorie "JustForThisOne" par "userTest"
    Et une nouvelle page ouverte sur l'onglet de suppression d'une oeuvre
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur vote positivement pour l'oeuvre "visualiserOeuvreTest13"
    Et l'utilisateur va sur le menu des classements
    Et l'utilisateur sélectionne la catégorie "JustForThisOne"
    Et l'utilisateur valide le classement
    Et le second utilisateur supprime l'oeuvre "visualiserOeuvreTest13"
    Et l'utilisateur clique sur l'oeuvre "visualiserOeuvreTest13" dans le classement
    Alors le message d'erreur "404 - Page non trouvée" est affiché

