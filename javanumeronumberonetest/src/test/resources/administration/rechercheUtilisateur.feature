#language: fr
  Fonctionnalité: Recherche d'un utilisateur
    En tant qu'administrateur,
    Il est possible de rechercher un utilisateur,
    Afin de le supprimer si besoin est

  Scénario: Recherche utilisateur - OK
    Etant donné l'accès au site effectué
    Et l'utilisateur "frosqh" créé
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet de gestion des utilisateurs
    Quand l'utilisateur renseigne le nom "fro"
    Alors la ligne correspondant au nom "frosqh" est affichée

  Scénario: Recherche utilisateur - Non existant
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Et l'utilisateur sur l'onglet de gestion des utilisateurs
    Et l'utilisateur "jals" n'existant pas
    Quand l'utilisateur renseigne le nom "jals"
    Alors le message "Pas d'utilisateur trouvé." s'affiche