#language: fr
Fonctionnalité: Publication d'un commentaire
  En tant que membre,
  Il est possible de rechercher une oeuvre en renseignant une chaine de caractères dans une barre de recherche
  Afin d'afficher une liste d'oeuvre correspondant à la recherche

  Scénario: Publication commentaire - OK
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "oeuvreTestC" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "oeuvreTestC"
    Alors l'oeuvre correspondant au nom "oeuvreTestC" est affichée
    Quand l'utilisateur clique sur l'oeuvre "oeuvreTestC" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "oeuvreTestC"
    Quand l'utilisateur écrit un commentaire "commentaireTest"
    Et l'utilisateur valide la publication du commentaire
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de l'oeuvre "oeuvreTestC"
    Et le commentaire "commentaireTest" apparait sur la page de l'oeuvre "oeuvreTestC"

  Scénario: Publication commentaire - commentaire vide
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "oeuvreTestC2" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "oeuvreTestC2"
    Alors l'oeuvre correspondant au nom "oeuvreTestC2" est affichée
    Quand l'utilisateur clique sur l'oeuvre "oeuvreTestC2" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "oeuvreTestC2"
    Quand l'utilisateur écrit un commentaire ""
    Alors le bouton de validation de commentaire n'est pas cliquable

  Scénario: Publication commentaire - commentaire plein d'espaces
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "oeuvreTestC3" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "oeuvreTestC3"
    Alors l'oeuvre correspondant au nom "oeuvreTestC3" est affichée
    Quand l'utilisateur clique sur l'oeuvre "oeuvreTestC3" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "oeuvreTestC3"
    Quand l'utilisateur écrit un commentaire "                    "
    Alors le bouton de validation de commentaire n'est pas cliquable

  Scénario: Publication commentaire - le bouton d'envoi n'est pas cliquable
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "oeuvreTest4" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "oeuvreTest"
    Alors l'oeuvre correspondant au nom "oeuvreTest4" est affichée
    Quand l'utilisateur clique sur l'oeuvre "oeuvreTest4" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "oeuvreTest4"
    Et le bouton de validation de commentaire n'est pas cliquable

  Scénario: Publication commentaire - commentaire trop long
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "oeuvreTest5" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "oeuvreTest"
    Alors l'oeuvre correspondant au nom "oeuvreTest5" est affichée
    Quand l'utilisateur clique sur l'oeuvre "oeuvreTest5" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "oeuvreTest5"
    Quand l'utilisateur écrit un commentaire "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet blandit orci. Nullam venenatis ante a ullamcorper porta. Aenean ex libero, mattis id nisi eget, fermentum aliquet purus. Aliquam finibus malesuada nisi, quis sagittis lorem tincidunt a. Aenean hendrerit magna in nisl ornare, a congue eros laoreet. Phasellus cursus porta neque sit amet condimentum. Donec ultricies leo vitae justo finibus, sit amet pharetra dui luctus.   In ac est fermentum, pharetra mauris id, consectetur erat. Nulla vel purus et ex sodales sagittis. Mauris bibendum, nunc vitae dignissim ultricies, libero mi varius ipsum, in maximus lacus sapien at nibh. Quisque sem mauris, pulvinar in augue nec, commodo tincidunt sapien. Pellentesque est velit, sodales eu sapien eget, placerat accumsan velit. Curabitur vel tincidunt velit, eget posuere est. Cras et nisi viverra, euismod arcu sit amet, consequat nibh. Vivamus felis orci, venenatis a egestas nec, suscipit vel nisi. Integer auctor dolor metus, at porta nibh lacinia fermentum.   Quisque in neque vitae elit pulvinar laoreet venenatis a eros. Quisque commodo ipsum tellus, faucibus sagittis odio volutpat vel. Phasellus sit amet est enim. Proin ut metus eu dui suscipit laoreet id eu neque. Duis a quam neque. Etiam lobortis eu mauris non scelerisque. Mauris blandit felis nec turpis elementum, et fermentum mauris sodales. Pellentesque eu molestie arcu. Nunc ac luctus urna, id ullamcorper sapien. Fusce et eros eget ex dignissim tempor scelerisque eget nulla. Cras pulvinar, leo in ultrices iaculis, turpis lorem ornare massa, non lobortis libero risus vel lectus. Pellentesque vulputate ipsum rutrum enim tincidunt commodo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean non lorem ac nibh accumsan egestas. Curabitur at metus auctor, suscipit risus quis, maximus elit.    Nulla eleifend felis ligula, nec bibendum nulla commodo quis. Sed fermentum sollicitudin finibus. Curabitur justo felis, congue ac tortor sed, venenatis porttitor metus. Duis elit volutpat."
    Et l'utilisateur valide la publication du commentaire
    Alors l'utilisateur est redirigé
    Et le message d'erreur "Votre commentaire est trop long" est affiché
    Et l'utilisateur est sur la page de l'oeuvre "oeuvreTest5"
    Et le commentaire n'a pas été ajouté à l'oeuvre "oeuvreTest5"
    Et le message d'erreur "Votre commentaire est trop long" est affiché

  Scénario: Publication commentaire - OK avec suppression des espaces en début et fin
    Etant donné l'accès au site effectué avec JS
    Et la catégorie "catTest" créée préalablement
    Et l'oeuvre "oeuvreTest6" créée dans la catégorie "catTest" par "userTest"
    Et l'utilisateur connecté en tant que membre
    Quand l'utilisateur renseigne la chaine de caractère "oeuvreTest6"
    Alors l'oeuvre correspondant au nom "oeuvreTest6" est affichée
    Quand l'utilisateur clique sur l'oeuvre "oeuvreTest6" dans la liste recherchée
    Alors l'utilisateur est sur la page de l'oeuvre "oeuvreTest6"
    Quand l'utilisateur écrit un commentaire "     commentaireTest      "
    Et l'utilisateur valide la publication du commentaire
    Alors l'utilisateur est redirigé
    Et l'utilisateur est sur la page de l'oeuvre "oeuvreTest6"
    Et le commentaire "commentaireTest" apparait sur la page de l'oeuvre "oeuvreTest6"
