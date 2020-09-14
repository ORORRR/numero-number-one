#language: fr
Fonctionnalité: Page mes Oeuvre
  En tant que membre,
  Il est possible de visualiser la liste des oeuvres que l'on a poster

  Scénario: Mes Oeuvres - Aucune oeuvre
    Etant donné l'accès au site effectué
    Et l'utilisateur "Nicolas" n'ayant pas été créé
    Quand l'utilisateur "Nicolas" s'inscrit
    Et l'utilisateur accède à ses oeuvres
    Alors aucune oeuvre n'est listée

  Scénario: Mes Oeuvres - Une seule oeuvre
    Etant donné l'accès au site effectué
    Et la catégorie "catTest" créée préalablement
    Et l'utilisateur "Nicole" n'ayant pas été créé
    Quand l'utilisateur "Nicole" s'inscrit
    Et l'utilisateur crée l'oeuvre "Mon Oeuvre"
    Et l'utilisateur accède à ses oeuvres
    Alors seule l'oeuvre "Mon Oeuvre" est listée

  Scénario: Mes Oeuvres - Deux oeuvres
    Etant donné l'accès au site effectué
    Et la catégorie "catTest" créée préalablement
    Et l'utilisateur "Nicolie" n'ayant pas été créé
    Quand l'utilisateur "Nicolie" s'inscrit
    Et l'utilisateur crée l'oeuvre "Mon Prologue"
    Et l'utilisateur crée l'oeuvre "Mon Sicstus"
    Et l'utilisateur accède à ses oeuvres
    Alors les 2 oeuvres "Mon Prologue","Mon Sicstus" sont listées

  Scénario: Mes Oeuvres - Administrateur
    Etant donné l'accès au site effectué
    Et l'utilisateur connecté en tant qu'administrateur
    Quand l'utilisateur accède à la page "mes-oeuvres" par le lien
    Alors le message d'erreur "403 - Accès refusé" est affiché