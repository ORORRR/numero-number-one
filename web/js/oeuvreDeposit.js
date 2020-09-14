"use strict";

var positionInputId;
var positionInputImg;
var positionInputName;
var positionInputDelete;

//partie dépôt des données
var addGroupButton;
var groupCollectionHolder;
var fileCollectionHolder;
var index;
var groupIndex;
var fileIndex;
var newGroupDiv;
var groupPrototype;
var filePrototype;
var form;
var filesName;
var templateGroup;

var createElementFromHTML = function (htmlString){
    var div = document.createElement("div");
    div.innerHTML = htmlString.trim();
    // Change this to div.childNodes to support multiple top-level nodes
    return div.firstChild;
};

var basename = function (str, sep) {
    return str.substr(str.lastIndexOf(sep) + 1);
};

var addFileForm = function (templateGroup, file) {
    var name = file.name;
    if (name.toUpperCase().indexOf("README") !== -1) {
        alert("Vous ne pouvez pas déposer un fichier avec ce nom");
        return false;
    }
    if (filesName.indexOf(name) >=0) {
        alert("Vous ne pouvez pas déposer deux fichiers ayant le même nom.");
        return false;
    }
    filesName.push(name);
    var divFile = createElementFromHTML(filePrototype.replace(/__group__/g, groupIndex).replace(/__file__/g, fileIndex));
    divFile.childNodes[positionInputName].setAttribute("class", "imageName");

    divFile.childNodes[positionInputName].lastChild.value = name;
    divFile.childNodes[positionInputName].lastChild.defaultValue = name;

    templateGroup.appendChild(divFile);
    fileIndex++;
    return true;
};

var addMultipleFilesForm = function (e) {
    templateGroup = createElementFromHTML(groupPrototype.replace(/__group__/g, groupIndex));
    var successFiles = new Array();
    var failsFiles = 0;
	var success;
    for (var i = 0; i < e.target.files.length; i++) {
        success = addFileForm(templateGroup, e.target.files[i]);
        successFiles.push(success);
        if (!success) {
            failsFiles++;
        }
    }
    if (failsFiles === 0) {
        var filesInputAdded = e.target.cloneNode(true);
        filesInputAdded.id = "oeuvre_groupsImages_" + groupIndex + "_files";
        filesInputAdded.name = "oeuvre[groupsImages][" + groupIndex + "][files][]";
        var newFiles = document.createElement("div");
        newFiles.appendChild(filesInputAdded);
        var deleteGroupButton = document.createElement("input");
        deleteGroupButton.type = "button";
        deleteGroupButton.value = "Supprimer";
        deleteGroupButton.id = "group_files_" + groupIndex + "_delete";
        deleteGroupButton.addEventListener("click", deleteGroup);
        templateGroup.appendChild(deleteGroupButton);
        templateGroup.replaceChild(newFiles, templateGroup.childNodes[0]);
        filesInputAdded.setAttribute("style", "display:none");
        newGroupDiv.appendChild(templateGroup);
        groupIndex++;
    }
    //réinitialise la sélection des fichiers à ajouter
    e.target.value = null;
};

var deleteGroup = function (e) {
    var button = e.srcElement || e.originalTarget;
    var groupId = button.id.substr("group_files_".length).replace("_delete", "");
    var divGroupId = "oeuvre_groupsImages_" + groupId;
    var divGroup = document.getElementById(divGroupId);
    var inputNames = divGroup.getElementsByClassName("imageName");
    var originalName;
    var i, j;
    for (i = 0; i < inputNames.length; i++) {
        originalName = inputNames[i].getElementsByTagName("input")[0].defaultValue;
        for (j = 0; j < filesName.length; j++) {
            if (filesName[j] === originalName) {
                filesName.splice(j, 1);
            }
        }
    }
    divGroup.remove();
};

var initVariables = function () {
    form = document.querySelector("form");
    addGroupButton = document.getElementById("oeuvre_addGroup");
    addGroupButton.addEventListener("change", addMultipleFilesForm);
    groupCollectionHolder = document.getElementById("data_groups");
    groupPrototype = groupCollectionHolder.getAttribute('data-group-prototype');
    filePrototype = groupCollectionHolder.getAttribute('data-file-prototype');
    filesName = [];
    newGroupDiv = document.getElementById("groups_list");
    groupCollectionHolder.appendChild(newGroupDiv);
};


var load = function () {
    positionInputName = 0;
    index = 0;
    groupIndex = 0;
    fileIndex = 0;
    initVariables();
};

load();
