"use strict";
import { setStyle } from "./styleFacade.js";

const notify= document.querySelectorAll(".notify-me");
const overlay=document.querySelector(".overlay");
const okButton = document.querySelector(".ok");
const hospital = document.querySelector('.hos-name').firstElementChild.textContent.trim();
const emailNode = document.querySelector('.email');
let facility = null;
let time=null;

for (let i = 0; i < notify.length; i++) {
    const element = notify[i];
    element.addEventListener('click', function(){
        setStyle(['.hidden'],'display','block');
        facility = element.parentElement.firstElementChild.textContent.trim();
        time = element.parentElement.querySelector(".fac-time").textContent;
    });
}

/*implementation */
function addEmailDetails(type,url,subscriberEmail,subscribedFacility,subscribedHospital,time){
    if(isValidEmail(subscriberEmail)){
        $.ajax({
            type: type,
            url: url,
            data: {email: subscriberEmail, fac: subscribedFacility, hos: subscribedHospital, times:time},
            success: function (response) {
                setStyle(['.hidden'],'display','none');
                alert("Successfully added");
                console.log(response);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert("Refresh and try again");
            }
        });
    }else {
        alert("Enter a valid Email Address in the field");
    }
}

/* bridge*/
function addEmailDetailsBridge(){
    var subscriberEmail=emailNode.value.trim();
    var subscribedFacility=facility;
    var subscribedHospital=hospital;
    var type= "POST";
    var url= "dataSaver.php";
    addEmailDetails(type,url,subscriberEmail,subscribedFacility,subscribedHospital, time);
}

okButton.addEventListener("click", function(){
    addEmailDetailsBridge();
});


function isValidEmail(email) {
    if(email.includes("@",".")) return true;

    return false;
}

    
overlay.addEventListener("click",function(){
    setStyle(['.hidden'],'display','none');

});