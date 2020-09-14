#language: fr
Fonctionnalité: Editer une oeuvre
  En tant que membre,
  Il est possible d'éditer une oeuvre ajouté par soi-même

  Scénario: Editer une oeuvre - OK
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et la catégorie "Jeu Vidéo" créée préalablement
    Et l'oeuvre "editerOeuvreTest" créée dans la catégorie "catTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest"
    Alors l'oeuvre correspondant au nom "editerOeuvreTest" est affichée
    Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest"
    Et le bouton de vote n'est pas disponible
    Quand l'utilisateur appuie sur le bouton d'édition
    Alors l'utilisateur est redirigé vers le formulaire d'édition
    Quand l'utilisateur saisit le titre "Half-Life"
    Et le descriptif "À quand le 3 ?!"
    Et la catégorie "Jeu Vidéo"
    Et l'auteur "Freeman"
    Et la date "19/11/1998"
    Et l'utilisateur appuie sur le bouton de validation de l'édition
    Alors un message de validation s'affiche
    Et l'utilisateur est redirigé vers la page de "editerOeuvreTest" modifiée ("Half-Life","Jeu Vidéo","Freeman")

  Scénario: Editer une oeuvre - Un utilisateur n'ayant pas posté ne peut éditer
    Etant donné l'accès au site effectué
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "editerOeuvreTest2" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest2"
    Alors l'oeuvre correspondant au nom "editerOeuvreTest2" est affichée
    Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest2" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest2"
    Et le bouton de vote est disponible
    Et le bouton d'edition ne s'affiche pas

  Scénario: Editer une oeuvre - Supprimer illustration Principale
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et la catégorie "Jeu Vidéo" créée préalablement
    Et l'oeuvre "editerOeuvreTest3" créée dans la catégorie "catTest" avec photo
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest3"
    Alors l'oeuvre correspondant au nom "editerOeuvreTest3" est affichée
    Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest3" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest3"
    Et le bouton de vote n'est pas disponible
    Quand l'utilisateur appuie sur le bouton d'édition
    Alors l'utilisateur est redirigé vers le formulaire d'édition
    Quand l'utilisateur saisit le titre "Portal"
    Et le descriptif "The Cake is a Lie"
    Et la catégorie "Jeu Vidéo"
    Et l'auteur "Glad0s"
    Et la date "10/10/2007"
    Et l'utilisateur supprime l'ilustration principale
    Et l'utilisateur appuie sur le bouton de validation de l'édition
    Alors un message de validation s'affiche
    Et l'utilisateur est redirigé vers la page de "editerOeuvreTest3" modifiée ("Portal","Jeu Vidéo","Glad0s")
    Et aucune illustration principale n'est renseignée

  Scénario: Editer une oeuvre - ajouter illustration principale
    Etant donné l'accès au site effectué
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "editerOeuvreTest4" créée dans la catégorie "catTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest4"
    Alors l'oeuvre correspondant au nom "editerOeuvreTest4" est affichée
    Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest4" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest4"
    Et le bouton de vote n'est pas disponible
    Quand l'utilisateur appuie sur le bouton d'édition
    Alors l'utilisateur est redirigé vers le formulaire d'édition
    Quand l'utilisateur saisit le titre "Counter-Strike"
    Et le descriptif "Fire in the Hole"
    Et la catégorie "Jeu Vidéo"
    Et l'auteur "Gooseman"
    Et la date "19/06/1999"
    Et l'utilisateur ajoute une nouvelle illustrationPrincipale
    Et l'utilisateur appuie sur le bouton de validation de l'édition
    Alors un message de validation s'affiche
    Et l'utilisateur est redirigé vers la page de "editerOeuvreTest4" modifiée ("Counter-Strike","Jeu Vidéo","Gooseman")
    Et une illustration principale est visible

  Scénario: Editer une oeuvre - ajouter illustration secondaire
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "editerOeuvreTest4" créée dans la catégorie "catTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest4"
    Alors l'oeuvre correspondant au nom "editerOeuvreTest4" est affichée
    Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest4" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest4"
    Et le bouton de vote n'est pas disponible
    Quand l'utilisateur appuie sur le bouton d'édition
    Alors l'utilisateur est redirigé vers le formulaire d'édition
    Quand l'utilisateur saisit l'auteur "Someone"
    Et l'utilisateur ajoute une nouvelle illustrationSecondaire
    Et l'utilisateur appuie sur le bouton de validation de l'édition
    Alors un message de validation s'affiche
    Et l'utilisateur est redirigé vers la page de "editerOeuvreTest4" modifiée ("editerOeuvreTest4","catTest","Someone")
    Et au moins une illustration secondaire est visible

 Scénario: Editer une oeuvre - Titre vide
   Etant donné l'accès au site effectué
   Et la catégorie "catTest" créée préalablement
   Et l'oeuvre "editerOeuvreTest5" créée dans la catégorie "catTest"
   Et l'utilisateur connecté en tant que membre
   Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest5"
   Alors l'oeuvre correspondant au nom "editerOeuvreTest5" est affichée
   Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest5" dans la liste recherchée
   Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest5"
   Et le bouton de vote n'est pas disponible
   Quand l'utilisateur appuie sur le bouton d'édition
   Alors l'utilisateur est redirigé vers le formulaire d'édition
   Quand l'utilisateur saisit le titre ""
   Et l'utilisateur appuie sur le bouton de validation de l'édition
   Alors le message d'erreur "Le nom de l'oeuvre doit être renseigné" est affiché

 Scénario: Editer une oeuvre - Description vide
   Etant donné l'accès au site effectué
   Et la catégorie "catTest" créée préalablement
   Et l'oeuvre "editerOeuvreTest6" créée dans la catégorie "catTest"
   Et l'utilisateur connecté en tant que membre
   Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest6"
   Alors l'oeuvre correspondant au nom "editerOeuvreTest6" est affichée
   Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest6" dans la liste recherchée
   Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest6"
   Et le bouton de vote n'est pas disponible
   Quand l'utilisateur appuie sur le bouton d'édition
   Alors l'utilisateur est redirigé vers le formulaire d'édition
   Quand l'utilisateur saisit la description ""
   Et l'utilisateur appuie sur le bouton de validation de l'édition
   Alors le message d'erreur "Le descriptif de l'oeuvre doit être renseigné" est affiché

 Scénario: Editer une oeuvre - Titre trop long
   Etant donné l'accès au site effectué
   Et la catégorie "catTest" créée préalablement
   Et l'oeuvre "editerOeuvreTest7" créée dans la catégorie "catTest"
   Et l'utilisateur connecté en tant que membre
   Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest7"
   Alors l'oeuvre correspondant au nom "editerOeuvreTest7" est affichée
   Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest7" dans la liste recherchée
   Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest7"
   Et le bouton de vote n'est pas disponible
   Quand l'utilisateur appuie sur le bouton d'édition
   Alors l'utilisateur est redirigé vers le formulaire d'édition
   Quand l'utilisateur saisit le titre "Au jardin des cyprès je filais en rêvant, Suivant longtemps des yeux les flocons que le vent Prenait à ma quenouille, ou bien par les allées Jusqu’au bassin mourant que pleurent les saulaiesJe marchais à pas lents, m’arrêtant aux jasmins,Me grisant du parfum des lys, tendant les mainsVers les iris fées gardés par les grenouilles.Pour y filer un jour les éternels cyprès.Guillaume Apollinaire"
   Et l'utilisateur appuie sur le bouton de validation de l'édition
   Alors le message d'erreur "Le titre est trop long" est affiché

 Scénario: Editer une oeuvre - Categorie vide
   Etant donné l'accès au site effectué
   Et la catégorie "catTest" créée préalablement
   Et l'oeuvre "editerOeuvreTest8" créée dans la catégorie "catTest"
   Et l'utilisateur connecté en tant que membre
   Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest8"
   Alors l'oeuvre correspondant au nom "editerOeuvreTest8" est affichée
   Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest8" dans la liste recherchée
   Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest8"
   Et le bouton de vote n'est pas disponible
   Quand l'utilisateur appuie sur le bouton d'édition
   Alors l'utilisateur est redirigé vers le formulaire d'édition
   Quand l'utilisateur choisit la catégorie "Veuillez choisir une catégorie"
   Et l'utilisateur appuie sur le bouton de validation de l'édition
   Alors le message d'erreur "La catégorie de l'oeuvre doit être renseignée" est affiché

 Scénario: Editer une oeuvre - Auteurs trop long
   Etant donné l'accès au site effectué
   Et la catégorie "catTest" créée préalablement
   Et l'oeuvre "editerOeuvreTest9" créée dans la catégorie "catTest"
   Et l'utilisateur connecté en tant que membre
   Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest9"
   Alors l'oeuvre correspondant au nom "editerOeuvreTest9" est affichée
   Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest9" dans la liste recherchée
   Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest9"
   Et le bouton de vote n'est pas disponible
   Quand l'utilisateur appuie sur le bouton d'édition
   Alors l'utilisateur est redirigé vers le formulaire d'édition
   Quand l'utilisateur saisit l'auteur "Au jardin des cyprès je filais en rêvant, Suivant longtemps des yeux les flocons que le vent Prenait à ma quenouille, ou bien par les allées Jusqu’au bassin mourant que pleurent les saulaiesJe marchais à pas lents, m’arrêtant aux jasmins,Me grisant du parfum des lys, tendant les mainsVers les iris fées gardés par les grenouilles.Pour y filer un jour les éternels cyprès.Guillaume Apollinaire"
   Et l'utilisateur appuie sur le bouton de validation de l'édition
   Alors le message d'erreur "Le contenu du champ Auteurs est trop long" est affiché

 Scénario: Editer une oeuvre - Illustration principale non valide
   Etant donné l'accès au site effectué
   Et la catégorie "catTest" créée préalablement
   Et l'oeuvre "editerOeuvreTest10" créée dans la catégorie "catTest"
   Et l'utilisateur connecté en tant que membre
   Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest10"
   Alors l'oeuvre correspondant au nom "editerOeuvreTest10" est affichée
   Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest10" dans la liste recherchée
   Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest10"
   Et le bouton de vote n'est pas disponible
   Quand l'utilisateur appuie sur le bouton d'édition
   Alors l'utilisateur est redirigé vers le formulaire d'édition
   Quand l'utilisateur ajoute un fichier avec un format non valide comme illustration principale
   Et l'utilisateur appuie sur le bouton de validation de l'édition
   Alors le message d'erreur "L'image principale n'est pas dans un format autorisé" est affiché

 Scénario: Editer une oeuvre - Illustration secondaire non valide
   Etant donné l'accès au site effectué avec JS
   Et la catégorie "catTest" créée préalablement
   Et l'oeuvre "editerOeuvreTest11" créée dans la catégorie "catTest"
   Et l'utilisateur connecté en tant que membre
   Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest11"
   Alors l'oeuvre correspondant au nom "editerOeuvreTest11" est affichée
   Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest11" dans la liste recherchée
   Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest11"
   Et le bouton de vote n'est pas disponible
   Quand l'utilisateur appuie sur le bouton d'édition
   Alors l'utilisateur est redirigé vers le formulaire d'édition
   Quand l'utilisateur ajoute un fichier avec un format non valide comme illustration secondaire
   Et l'utilisateur appuie sur le bouton de validation de l'édition
   Alors le message d'erreur "Au moins une image secondaire n'a pas le bon format" est affiché

 Scénario: Editer une oeuvre - Oeuvre d'un autre
   Etant donné l'accès au site effectué avec JS
   Et la catégorie "catTest" créée préalablement
   Et l'oeuvre "editerOeuvreTest12" créée dans la catégorie "catTest" par "userTest"
   Et l'utilisateur connecté en tant que membre
   Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest12"
   Alors l'oeuvre correspondant au nom "editerOeuvreTest12" est affichée
   Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest12" dans la liste recherchée
   Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest12"
   Quand l'utilisateur va sur la page d'édition de l'oeuvre actuelle
   Alors le message d'erreur "403 - Accès refusé" est affiché

  Scénario: Editer une oeuvre - Catégorie supprimée
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "toDelRightAway" créée préalablement
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "editerOeuvreTest13" créée dans la catégorie "catTest"
    Et une nouvelle page ouverte sur l'onglet de suppression d'une catégorie
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "editerOeuvreTest13"
    Alors l'oeuvre correspondant au nom "editerOeuvreTest13" est affichée
    Quand l'utilisateur clique sur l'oeuvre "editerOeuvreTest13" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "editerOeuvreTest13"
    Et le bouton de vote n'est pas disponible
    Quand l'utilisateur appuie sur le bouton d'édition
    Alors l'utilisateur est redirigé vers le formulaire d'édition
    Quand l'utilisateur choisit la catégorie "toDelRightAway"
    Quand le second utilisateur supprime la catégorie "toDelRightAway"
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors le message d'erreur "La catégorie sélectionnée n'existe pas (ou plus)." est affiché