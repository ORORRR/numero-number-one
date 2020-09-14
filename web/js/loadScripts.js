"use strict";

var FuncOL = [];

// Fonction de stockage des scripts à charger FuncOL = new Array();
var StkFunc = function (Obj) {
    FuncOL[FuncOL.length] = Obj;
};

// Execution des scripts au chargement de la page window.onload =

window.onload = function () {
    for (let i = 0; i < FuncOL.length; i++) {
        FuncOL[i]();
    }
};
