#language: fr
Fonctionnalité: Ajouter une oeuvre
  En tant que membre,
  Il est possible d'ajouter une oeuvre
  Afin de la partager sur le site avec les autres utilisateurs

  Scénario: Accès à la page
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Alors le lien d'accès à la page d'ajout d'oeuvre n'est pas visible
    Quand l'utilisateur se déconnecte
    Et l'utilisateur connecté en tant que membre
    Alors le lien d'accès à la page d'ajout d'oeuvre est visible

  Scénario: Mes Oeuvres - accès à la page en tant qu'administrateur par lien
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Quand l'utilisateur accède à la page "ajout-oeuvre" par le lien
    Alors le message d'erreur "403 - Accès refusé" est affiché

  Scénario: Ajouter une oeuvre - OK
    Etant donné l'accès au site effectué
    Et la catégorie "Peinture" créée préalablement
    Et l'oeuvre ("Guernica", "Peinture", "Picasso") n'existe pas
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre "Guernica"
    Et le descriptif "Peinture quelque peu originale"
    Et la catégorie "Peinture"
    Et l'auteur "Picasso"
    Et la date "04/06/1937"
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors un message de validation s'affiche
    Et l'utilisateur est redirigé vers la page de son nouveau post ("Guernica", "Peinture", "Picasso")

  Scénario: Ajouter une oeuvre - Illustration fournie
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "Sculpture" créée préalablement
    Et l'oeuvre ("Le penseur", "Sculpture", "Rodin") n'existe pas
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre "Le penseur"
    Et le descriptif "Vraiment ?"
    Et la catégorie "Sculpture"
    Et l'auteur "Rodin"
    Et la date "01/01/1902"
    Et l'utilisateur ajoute une image principale et une secondaire avec un format valide
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors un message de validation s'affiche
    Et l'utilisateur est redirigé vers la page de son nouveau post ("Le penseur", "Sculpture", "Rodin")

  Scénario: Ajouter une oeuvre - Titre vide
    Etant donné l'accès au site effectué
    Et la catégorie "Poésie" créée préalablement
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre ""
    Et le descriptif "Jooli"
    Et la catégorie "Poésie"
    Et l'auteur "Victor Hugo"
    Et la date "04/10/1847"
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors le message d'erreur "Le nom de l'oeuvre doit être renseigné" est affiché
    Et l'utilisateur est sur la page d'ajout d'une oeuvre

  Scénario: Ajouter une oeuvre - Titre trop long
    Etant donné l'accès au site effectué
    Et la catégorie "Poésie" créée préalablement
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre "Au jardin des cyprès je filais en rêvant, Suivant longtemps des yeux les flocons que le vent Prenait à ma quenouille, ou bien par les allées Jusqu’au bassin mourant que pleurent les saulaiesJe marchais à pas lents, m’arrêtant aux jasmins,Me grisant du parfum des lys, tendant les mainsVers les iris fées gardés par les grenouilles.Pour y filer un jour les éternels cyprès.Guillaume Apollinaire"
    Et le descriptif "Jooli"
    Et la catégorie "Poésie"
    Et l'auteur "Victor Hugo"
    Et la date "04/10/1847"
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors le message d'erreur "Le titre est trop long" est affiché
    Et l'utilisateur est sur la page d'ajout d'une oeuvre

  Scénario: Ajouter une oeuvre - Description vide
    Etant donné l'accès au site effectué
    Et la catégorie "Poésie" créée préalablement
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre "Demain dès l'aube"
    Et le descriptif ""
    Et la catégorie "Poésie"
    Et l'auteur "Victor Hugo"
    Et la date "04/10/1847"
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors le message d'erreur "Le descriptif de l'oeuvre doit être renseigné" est affiché
    Et l'utilisateur est sur la page d'ajout d'une oeuvre

  Scénario: Ajouter une oeuvre - Catégorie vide
    Etant donné l'accès au site effectué
    Et la catégorie "Poésie" créée préalablement
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre "Demain dès l'aube"
    Et le descriptif "Joolie"
    Et l'auteur "Victor Hugo"
    Et la date "04/10/1847"
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors le message d'erreur "La catégorie de l'oeuvre doit être renseignée" est affiché
    Et l'utilisateur est sur la page d'ajout d'une oeuvre

  Scénario: Ajouter une oeuvre - Auteurs trop long
    Etant donné l'accès au site effectué
    Et la catégorie "Poésie" créée préalablement
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre "Demain dès l'aube"
    Et le descriptif "Jooli"
    Et la catégorie "Poésie"
    Et l'auteur "Au jardin des cyprès je filais en rêvant, Suivant longtemps des yeux les flocons que le vent Prenait à ma quenouille, ou bien par les allées Jusqu’au bassin mourant que pleurent les saulaiesJe marchais à pas lents, m’arrêtant aux jasmins,Me grisant du parfum des lys, tendant les mainsVers les iris fées gardés par les grenouilles.Pour y filer un jour les éternels cyprès.Guillaume Apollinaire"
    Et la date "04/10/1847"
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors le message d'erreur "Le contenu du champ Auteurs est trop long" est affiché
    Et l'utilisateur est sur la page d'ajout d'une oeuvre

  Scénario: Ajouter une oeuvre - Illustration principale non valide
    Etant donné l'accès au site effectué
    Et la catégorie "Chanson" créée préalablement
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre "Savages"
    Et le descriptif "We're savages on the run"
    Et la catégorie "Chanson"
    Et l'auteur "Halocene"
    Et la date "10/11/2016"
    Et l'utilisateur ajoute un fichier avec un format non valide comme illustration principale
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors le message d'erreur "L'image principale n'est pas dans un format autorisé" est affiché
    Et l'utilisateur est sur la page d'ajout d'une oeuvre

  Scénario: Ajouter une oeuvre - Illustration secondaire non valide
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "Chanson" créée préalablement
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre "Savages2"
    Et le descriptif "We're savages on the run"
    Et la catégorie "Chanson"
    Et l'auteur "Halocene"
    Et la date "10/11/2016"
    Et l'utilisateur ajoute un fichier avec un format non valide comme illustration secondaire
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors le message d'erreur "Au moins une image secondaire n'a pas le bon format" est affiché
    Et l'utilisateur est sur la page d'ajout d'une oeuvre

  Scénario: Ajouter une oeuvre - Catégorie supprimée
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "toDelRightAway" créée préalablement
    Et une nouvelle page ouverte sur l'onglet de suppression d'une catégorie
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur clique sur le bouton correspondant à l'ajout d'une oeuvre
    Alors l'utilisateur est redirigé vers le formulaire d'ajout
    Quand l'utilisateur saisit le titre "Savages7"
    Et le descriptif "We're savages on the run"
    Et la catégorie "toDelRightAway"
    Et l'auteur "Halocene"
    Et la date "10/11/2016"
    Quand le second utilisateur supprime la catégorie "toDelRightAway"
    Et l'utilisateur appuie sur le bouton de validation de l'ajout
    Alors le message d'erreur "La catégorie sélectionnée n'existe pas (ou plus)." est affiché



#    ajouter une oeuvre dans une catégorie qui n'existe plus