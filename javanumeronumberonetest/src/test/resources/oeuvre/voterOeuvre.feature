#language: fr
Fonctionnalité: Voter pour une oeuvre
  En tant que membre,
  Il est possible de voter pour les oeuvres des autres utilisateurs

  Scénario: Voter pour une oeuvre - Avis positif
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "voterOeuvreTestP" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "voterOeuvreTestP"
    Alors l'oeuvre correspondant au nom "voterOeuvreTestP" est affichée
    Quand l'utilisateur clique sur l'oeuvre "voterOeuvreTestP" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "voterOeuvreTestP"
    Et le bouton de vote est disponible
    Quand l'utilisateur vote positivement
    Alors un message le remercie pour son vote
    Et la page de l'oeuvre "voterOeuvreTestP" est reactualisé avec le vote positif pris en compte

  Scénario: Voter pour une oeuvre - Avis negatif
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "voterOeuvreTestN" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "voterOeuvreTestN"
    Alors l'oeuvre correspondant au nom "voterOeuvreTestN" est affichée
    Quand l'utilisateur clique sur l'oeuvre "voterOeuvreTestN" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "voterOeuvreTestN"
    Et le bouton de vote est disponible
    Quand l'utilisateur vote negativement
    Alors un message le remercie pour son vote
    Et la page de l'oeuvre "voterOeuvreTestN" est reactualisé avec le vote négatif pris en compte

  Scénario: Voter pour une oeuvre - supprimer son vote positif
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "voterOeuvreTestM" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur vote positivement pour l'oeuvre "voterOeuvreTestM"
    Et l'utilisateur renseigne la chaine de caractère "voterOeuvreTestM"
    Alors l'oeuvre correspondant au nom "voterOeuvreTestM" est affichée
    Quand l'utilisateur clique sur l'oeuvre "voterOeuvreTestM" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "voterOeuvreTestM"
    Et le bouton de vote est disponible
    Quand l'utilisateur supprime son vote
    Alors la page de l'oeuvre "voterOeuvreTestM" est reactualisé avec la suppression du vote prise en compte

  Scénario: Voter pour une oeuvre - supprimer son vote negatif
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "voterOeuvreTestM2" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur vote négativement pour l'oeuvre "voterOeuvreTestM2"
    Et l'utilisateur renseigne la chaine de caractère "voterOeuvreTestM2"
    Alors l'oeuvre correspondant au nom "voterOeuvreTestM2" est affichée
    Quand l'utilisateur clique sur l'oeuvre "voterOeuvreTestM2" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "voterOeuvreTestM2"
    Et le bouton de vote est disponible
    Quand l'utilisateur supprime son vote
    Alors la page de l'oeuvre "voterOeuvreTestM2" est reactualisé avec la suppression du vote prise en compte

  Scénario: Voter pour une oeuvre - Utilisateur ayant posté une oeuvre ne peut pas voter
    Etant donné l'accès au site effectué
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "voterOeuvreTest" créée dans la catégorie "catTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "voterOeuvreTest"
    Alors l'oeuvre correspondant au nom "voterOeuvreTest" est affichée
    Quand l'utilisateur clique sur l'oeuvre "voterOeuvreTest" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "voterOeuvreTest"
    Et le bouton de vote n'est pas disponible

  Scénario: Voter pour une oeuvre - vote positif suprimé
    Etant donné l'accès au site effectué
    Et l'oeuvre "voter2" créée dans la catégorie "catTest" par "userTest"
    Et une nouvelle page ouverte sur l'onglet de suppression d'une oeuvre
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "voter2"
    Et l'utilisateur clique sur l'oeuvre "voter2" dans la liste recherchée
    Et le second utilisateur supprime l'oeuvre "voter2"
    Et l'utilisateur vote positivement
    Alors le message d'erreur "404 - Page non trouvée" est affiché

  Scénario: Voter pour une oeuvre - vote négatif suprimé
    Etant donné l'accès au site effectué
    Et l'oeuvre "voter3" créée dans la catégorie "catTest" par "userTest"
    Et une nouvelle page ouverte sur l'onglet de suppression d'une oeuvre
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "voter3"
    Et l'utilisateur clique sur l'oeuvre "voter3" dans la liste recherchée
    Et le second utilisateur supprime l'oeuvre "voter3"
    Et l'utilisateur vote negativement
    Alors le message d'erreur "404 - Page non trouvée" est affiché