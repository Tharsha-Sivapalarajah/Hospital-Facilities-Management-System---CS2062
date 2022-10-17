"use strict";

import { setStyle } from "./styleFacade.js";

const selectBoxes = document.querySelectorAll(".select-box");
const optionsContainers = document.querySelectorAll(".options-container");
const selecteds = document.querySelectorAll(".selected");
const searchbars = document.querySelectorAll(".search-bar");

const filterList = (searchTerm, optionsList) => {
  searchTerm = searchTerm.toLowerCase();
  optionsList.forEach((option) => {
    let label =
      option.firstElementChild.nextElementSibling.innerText.toLowerCase();
    if (label.indexOf(searchTerm) != -1) {
      option.style.display = "block";
    } else {
      option.style.display = "none";
    }
  });
};


for (let i = 0; i < 3; i++) {
  selecteds[i].addEventListener("click", () => {
    optionsContainers[i].classList.toggle("active");
    searchbars[i].classList.toggle("active");
  });
}

const disOptions = document.querySelectorAll(".dis-option");
var district;
for (let i = 0; i < disOptions.length; i++) {
  disOptions[i].addEventListener("click", () => {

    setStyle(['.dis-selected'],'border','1px solid white');

    document.querySelector(".dis-selected").textContent = disOptions[i].textContent;
    district = disOptions[i].textContent.trim();
    optionsContainers[0].classList.toggle("active");
    searchbars[0].classList.toggle("active");

    for (let j = 0; j < hosOptions.length; j++) {
      hosOptions[j].style.display = "none";
    }

    const hosHideOptions = document.querySelectorAll(
      `.hos-option.${disOptions[i].textContent.trim()}`
    );
    for (let j = 0; j < hosHideOptions.length; j++) {
      hosHideOptions[j].style.display = "block";
    }

  });
}

const facOptions = document.querySelectorAll(".fac-option");
var facility;
for (let i = 0; i < facOptions.length; i++) {
  facOptions[i].addEventListener("click", () => {

    setStyle([".fac-selected"],"border","1px solid white");


    document.querySelector(".fac-selected").textContent = facOptions[i].textContent;
    facility = facOptions[i].textContent.trim();
    optionsContainers[1].classList.toggle("active");
    searchbars[1].classList.toggle("active");
  });
}

const hosOptions = document.querySelectorAll(".hos-option");
var hospital;
for (let i = 0; i < hosOptions.length; i++) {
  hosOptions[i].addEventListener("click", () => {
    optionsContainers[2].classList.toggle("active");
    searchbars[2].classList.toggle("active");
    document.querySelector(".hos-selected").textContent = hosOptions[i].textContent;

    setStyle([".hos-selected"],"border","1px solid white");

    hospital = hosOptions[i].textContent.trim();
    document.querySelector(".dis-selected").style.border = "1px solid white";
    document.querySelector(".dis-selected").textContent =
      hosOptions[i].classList[2];
  });
}

// send http request
const button = document.querySelector('.submit-button');
const xhttp = new XMLHttpRequest();

button.addEventListener("click",() => {
    if(hospital !== undefined && facility !== undefined){
      window.location.href = "../Result/ResultPage.php?hos="+ hospital+"&dis="+district+"&fac="+facility;

    } else {
      prompt("Please fill all the columns");
    }
});

// adding search functionality
searchbars[2].addEventListener("keyup", function (e) {
  filterList(e.target.value, hosOptions);
});

searchbars[1].addEventListener("keyup", function (e) {
  filterList(e.target.value, facOptions);
});

searchbars[0].addEventListener("keyup", function (e) {
  filterList(e.target.value, disOptions);
});

