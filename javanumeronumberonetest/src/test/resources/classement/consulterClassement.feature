#language: fr
  Fonctionnalité: Consulter un classement
    En tant que membre,
    Il est possible de consulter un classement des oeuvres par catégories/durée

 Scénario: Accès à la page
   Etant donné l'accès au site effectué
   Et l'utilisateur connecté en tant qu'administrateur
   Alors le lien d'accès à la page des classements n'est pas visible
   Quand l'utilisateur se déconnecte
   Et l'utilisateur connecté en tant que membre
   Alors le lien d'accès à la page des classements est visible

 Scénario: Consulter un Classement - OK
   Etant donné l'accès au site effectué
   Et la catégorie "catTest" créée préalablement
   Et l'utilisateur connecté en tant que membre
   Et l'utilisateur sur le menu des classements
   Quand l'utilisateur sélectionne la catégorie "catTest"
   Et l'utilisateur valide le classement
   Alors l'utilisateur est redirigé
   Et l'utilisateur est sur la page des classements pour la catégorie "catTest"

 Scénario: Consulter un Classement - MàJ en continu
   Etant donné l'accès au site effectué
   Et la catégorie "Peinture" créée préalablement
   Et l'utilisateur "voteurfou", "fou" inscrit
   Et l'utilisateur "voteurmodere", "modere" inscrit
   Et l'utilisateur "voteur", "hesitant" inscrit
   Et une oeuvre "Tableau n1" créée dans la catégorie "Peinture"
   Et une oeuvre "Tableau n2" créée dans la catégorie "Peinture"
   Et une oeuvre "Tableau n3" créée dans la catégorie "Peinture"
   Et l'utilisateur connecté avec le compte "voteurfou", "fou"
   Quand l'utilisateur vote positivement pour l'oeuvre "Tableau n1"
   Et l'utilisateur vote positivement pour l'oeuvre "Tableau n2"
   Et l'utilisateur vote positivement pour l'oeuvre "Tableau n3"
   Etant donné l'utilisateur connecté avec le compte "voteurmodere", "modere"
   Quand l'utilisateur vote positivement pour l'oeuvre "Tableau n1"
   Et l'utilisateur vote positivement pour l'oeuvre "Tableau n2"
   Etant donné l'utilisateur connecté avec le compte "voteur", "hesitant"
   Quand l'utilisateur vote positivement pour l'oeuvre "Tableau n1"
   Et l'utilisateur va sur le menu des classements
   Et sélectionne la catégorie "Peinture"
   Et l'utilisateur valide le classement
   Alors l'oeuvre "Tableau n1" est en position "1"
   Et l'oeuvre "Tableau n2" est en position "2"
   Et l'oeuvre "Tableau n3" est en position "3"
   Quand l'utilisateur vote négativement pour l'oeuvre "Tableau n1"
   Et l'utilisateur va sur le menu des classements
   Et sélectionne la catégorie "Peinture"
   Et l'utilisateur valide le classement
   Alors l'oeuvre "Tableau n2" est en position "1"
   Et l'oeuvre "Tableau n3" est en position "2"
   Et l'oeuvre "Tableau n1" est en position "3"
   Quand l'utilisateur vote positivement pour l'oeuvre "Tableau n2"
   Et l'utilisateur va sur le menu des classements
   Et sélectionne la catégorie "Peinture"
   Et l'utilisateur valide le classement
   Alors l'oeuvre "Tableau n2" est en position "1"
   Et l'oeuvre "Tableau n3" est en position "2"
   Et l'oeuvre "Tableau n1" est en position "3"

  Scénario: Consulter un Classement - pas d'oeuvre avec vote dans une categorie
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "Oeuvre Française" créée préalablement
    Et l'oeuvre "Oeuvre Originale" créée dans la catégorie "Oeuvre Française" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur va sur le menu des classements
    Et sélectionne la catégorie "Oeuvre Française"
    Et l'utilisateur valide le classement
    Alors le message "Aucune oeuvre avec avis trouvée pour cette catégorie et période" est affiché
    Quand l'utilisateur vote négativement pour l'oeuvre "Oeuvre Originale"
    Et l'utilisateur va sur le menu des classements
    Et sélectionne la catégorie "Oeuvre Française"
    Et l'utilisateur valide le classement
    Alors l'oeuvre "Oeuvre Originale" est en position "1"
    Quand l'utilisateur supprime son vote pour l'oeuvre "Oeuvre Originale"
    Et l'utilisateur va sur le menu des classements
    Et sélectionne la catégorie "Oeuvre Française"
    Et l'utilisateur valide le classement
    Alors le message "Aucune oeuvre avec avis trouvée pour cette catégorie et période" est affiché
    Quand l'utilisateur vote positivement pour l'oeuvre "Oeuvre Originale"
    Et l'utilisateur va sur le menu des classements
    Et sélectionne la catégorie "Oeuvre Française"
    Et l'utilisateur valide le classement
    Alors l'oeuvre "Oeuvre Originale" est en position "1"
    Quand l'utilisateur supprime son vote pour l'oeuvre "Oeuvre Originale"
    Et l'utilisateur va sur le menu des classements
    Et sélectionne la catégorie "Oeuvre Française"
    Et l'utilisateur valide le classement
    Alors le message "Aucune oeuvre avec avis trouvée pour cette catégorie et période" est affiché


#    accès à une oeuvre supprimé depuis un classement

  Scénario: Consulter un Classement - OK
    Etant donné l'accès au site effectué
    Et la catégorie "toDelRightAway" créée préalablement
    Et une nouvelle page ouverte sur l'onglet de suppression d'une catégorie
    Et l'utilisateur connecté en tant que membre
    Et l'utilisateur sur le menu des classements
    Quand l'utilisateur sélectionne la catégorie "toDelRightAway"
    Et le second utilisateur supprime la catégorie "toDelRightAway"
    Et l'utilisateur valide le classement
    Alors l'utilisateur est redirigé
    Et le message d'erreur "La catégorie sélectionnée n'existe pas (ou plus)." est affiché