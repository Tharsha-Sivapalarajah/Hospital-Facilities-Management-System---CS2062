"use strict";

const hospitalNames = document.querySelectorAll(".hos-name");
const buttons =document.querySelectorAll(".button");
const hospitals=document.querySelectorAll(".hospital");

const filterList = (searchTerm, optionsList) => {
    searchTerm = searchTerm.toLowerCase();
    optionsList.forEach((option) => {
      let label =
        option.innerText.toLowerCase();
      if (label.indexOf(searchTerm) != -1) {
        option.parentElement.style.display = "block";
      } else {
        option.parentElement.style.display = "none";
      }
    });
  };


document.querySelector(".search").addEventListener("keyup",function (e) {
    filterList(e.target.value, hospitalNames);
  }

);


document.querySelector(".search").addEventListener("keyup",function (e) {
  filterList(e.target.value, hospitalNames);
}

);

// buttons.forEach(button=>{
//   button.addEventListener("click",function(){
//       // document.querySelector(".window").style.display="none";
//       setStyle(".window","display","none");
//   });
// });

// hospitals.forEach(hospital=>{
//   hospital.addEventListener("click",function(){
      
//       document.querySelector(".window").style.display="block";
//   });
// }

// );