const vaccinationNames = document.querySelectorAll(".vaccination-name");
const buttons =document.querySelectorAll(".button");
const vaccinations=document.querySelectorAll(".vaccination");

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
    filterList(e.target.value, vaccinationNames);
  }

);


document.querySelector(".search").addEventListener("keyup",function (e) {
  filterList(e.target.value, vaccinationNames);
}

);

// buttons.forEach(button=>{
//   button.addEventListener("click",function(){
//       document.querySelector(".window").style.display="none";
//   });
// });

// vaccinations.forEach(vaccination=>{
//   vaccination.addEventListener("click",function(){
      
//       document.querySelector(".window").style.display="block";
//   });
// }

// );