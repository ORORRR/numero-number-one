#language: fr
Fonctionnalité: Création d'une catégorie
    En tant qu'administrateur,
    Il est possible d'utiliser les outils d'administration
    Afin de créer une nouvelle catégorie d'oeuvre

  Scénario: Création Catégorie - OK
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet d'ajout d'une catégorie
    Quand l'utilisateur renseigne le nom de catégorie "Test2"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "Test2" est créée
    Et aucun message d'erreur n'est affiché

  Scénario: Création Catégorie - Nom avec des espace avant et après
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet d'ajout d'une catégorie
    Quand l'utilisateur renseigne le nom de catégorie "   lol       "
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "lol" est créée
    Et aucun message d'erreur n'est affiché

  Scénario: Création Catégorie - Nom Trop Long
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet d'ajout d'une catégorie
    Quand l'utilisateur renseigne le nom de catégorie "nombeaucouptroplongdeplusdecinquantecaracteresquipasserapas"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "nombeaucouptroplongdeplusdecinquantecaracteresquipasserapas" n'est pas créée
    Et le message d'erreur "La catégorie ne doit pas faire plus de 50 caractères" est affiché

  Scénario: Création Catégorie - Nom vide
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet d'ajout d'une catégorie
    Quand l'utilisateur renseigne le nom de catégorie ""
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "" n'est pas créée
    Et le message d'erreur "Le nom de la catégorie doit être renseigné" est affiché

  Scénario: Création Catégorie - Nom plein d'espace
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet d'ajout d'une catégorie
    Quand l'utilisateur renseigne le nom de catégorie "          "
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "" n'est pas créée
    Et le message d'erreur "Le nom de la catégorie doit être renseigné" est affiché

  Scénario: Création Catégorie - Ajout de deux fois la même catégorie
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet d'ajout d'une catégorie
    Quand l'utilisateur renseigne le nom de catégorie "Test"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "Test" est créée
    Et aucun message d'erreur n'est affiché
    Quand l'utilisateur renseigne le nom de catégorie "Test"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "Test" n'est présente qu'une fois
    Et le message d'erreur "Cette catégorie existe déjà" est affiché

  Scénario: Création Catégorie - Ajout de deux fois la même catégorie avec des casses différentes
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet d'ajout d'une catégorie
    Quand l'utilisateur renseigne le nom de catégorie "yolo"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "yolo" est créée
    Et aucun message d'erreur n'est affiché
    Quand l'utilisateur renseigne le nom de catégorie "YoLo"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "yolo" n'est présente qu'une fois
    Et le message d'erreur "Cette catégorie existe déjà" est affiché

  Scénario: Création Catégorie - Ajout de deux fois la même catégorie avec des espaces différents
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet d'ajout d'une catégorie
    Quand l'utilisateur renseigne le nom de catégorie "film en noir et blanc"
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "film en noir et blanc" est créée
    Et aucun message d'erreur n'est affiché
    Quand l'utilisateur renseigne le nom de catégorie "    film en noir et blanc     "
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur l'onglet d'ajout d'une catégorie
    Et la catégorie "film en noir et blanc" n'est présente qu'une fois
    Et le message d'erreur "Cette catégorie existe déjà" est affiché