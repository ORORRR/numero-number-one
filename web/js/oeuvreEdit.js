"use strict";

var load = function () {
    positionInputId = 0;
    positionInputName = 1;
    index = document.getElementById("editScript").getAttribute("nbFiles");
    groupIndex = document.getElementById("editScript").getAttribute("nbFiles");
    fileIndex = groupIndex;
    initVariables();
    //filesName = JSON.parse(document.getElementById("editScript").getAttribute("filesName"));
};

load();

var liFiles;
var editButtons;
var deleteButtons;

var editFile = function (e) {
    var idButton = e.id.substr("edit_file_".length);
    var edited = document.getElementById("hide_file_" + idButton);
    var newButtonValue;
    var newDisplay;
    if (edited.style.display === "block") {
        newButtonValue = "Modifier";
        newDisplay = "none";
    }
    else {
        newButtonValue = "Annuler";
        newDisplay = "block";
    }
    srcElement = e;
    srcElement.value = newButtonValue;
    edited.style.display = newDisplay;
};

var deleteFile = function (e) {
    var idButton = e.id.substr("delete_file_".length);
    var toDelete = document.getElementById("span_image_" + idButton).parentNode.parentNode;
    var confirmation = confirm("Êtes-vous sûr de supprimer ce fichier ?");
    if (confirmation) {
        //récupère le div qui contient tous les champs de saisie
        var hide = document.getElementById("hide_file_" + idButton);
        //récupère tous les champs de saisie, sélectionne celui à l'index défini pour obtenir
        //le nom, et récupère le champ texte pour le nom
        var name = hide.querySelectorAll("input")[positionInputName].value;
        //let index = filesName.indexOf(name);
        //if (index > -1) {
        //    filesName.splice(index, 1);
        //}
        toDelete.remove();
    }
};
