"use strict"
const facilities = document.querySelectorAll(".facility-box");
const addfac= document.querySelector(".add-fac");
const closeModels= document.querySelectorAll(".close-model");
const delFac= document.querySelector(".del");
const notConfirm = document.querySelector(".no-delete");
const changeHos= document.querySelector(".change-hos-model");


facilities.forEach(function(facilityBox){
    
    facilityBox.addEventListener("click", function(){
        console.log(facilityBox.querySelector(".facility-heading").textContent);
        document.querySelector(".add-form-model").style.display="block";
        document.getElementById("fac").value=facilityBox.querySelector(".facility-heading").textContent;
        document.getElementById("start-time").value=facilityBox.querySelector(".start-time").querySelector(".time").textContent;
        document.getElementById("end-time").value=facilityBox.querySelector(".end-time").querySelector(".time").textContent;
        

    });});

addfac.addEventListener("click",function(){
    document.querySelector(".add-form-model").style.display="block";
    document.getElementById("fac").value=null;
    document.getElementById("fac").placeholder="Enter Facility Name";
    document.getElementById("start-time").value=null;
    document.getElementById("end-time").value=null;


});

closeModels.forEach(function(closeModel){
    closeModel.addEventListener("click",function(){
        closeModel.parentElement.style.display="none";
    });
});



// delFac.addEventListener("click",function(){
//     document.querySelector(".confirm-deletion-model").style.display="block";

// });

// notConfirm.addEventListener("click",function(){
//    changeHos.style.display="block";
//    notConfirm.parentElement.parentElement.parentElement.style.display="none";

// } );