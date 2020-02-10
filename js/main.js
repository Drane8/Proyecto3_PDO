"use strict";

window.onload = function (){
    this.showSliderValue();
};

if (document.body.contains(document.getElementById("aulaC"))) {
    document.getElementById("aulaC").addEventListener("blur", () => {
        document.getElementById("aulaC").focus();
    });

    window.onload = function () {
        document.getElementById("aulaC").focus();
    };
}
var rangeSlider = document.getElementById("cantidadArticulos");
var rangeBullet = document.getElementById("rs-bullet");

rangeSlider.addEventListener("input", showSliderValue, false);

function showSliderValue() {
  rangeBullet.innerHTML = rangeSlider.value;
  var bulletPosition = ((rangeSlider.value / 100) * 280) + 26.22;
  rangeBullet.style.left = bulletPosition  + "px";
}
