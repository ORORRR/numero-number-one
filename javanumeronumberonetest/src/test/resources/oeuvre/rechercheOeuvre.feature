#language: fr
Fonctionnalité: Recherche d'une oeuvre
  En tant que membre,
  Il est possible de rechercher une oeuvre en renseignant une chaine de caractères dans une barre de recherche
  Afin d'afficher une liste d'oeuvre correspondant à la recherche

  Scénario: Recherche oeuvre - OK
    Etant donné l'accès au site effectué
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "oeuvreTest" créée dans la catégorie "catTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "oeuvreTest"
    Alors l'oeuvre correspondant au nom "oeuvreTest" est affichée

  Scénario: Recherche oeuvre - Non existant
    Etant donné l'accès au site effectué
    Et l'oeuvre "carotte" n'existe pas
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "carotte"
    Alors le message "Aucune oeuvre trouvée." est affiché