"use strict";

if (document.body.contains(document.getElementById("aulaC"))) {
    document.getElementById("aulaC").addEventListener("blur", () => {
        document.getElementById("aulaC").focus();
    });

    window.onload = function () {
        document.getElementById("aulaC").focus();
    };
}