var state = false;
function toggle(){
    if(state){
        document.getElementById("password").setAttribute("type","password");
        state = false;
        document.getElementById("eye").style.color = '#2196f3';
    }else{
        document.getElementById("password").setAttribute("type","text");
        state = true;
        document.getElementById("eye").style.color = '#069818';

    }
}
var state1 = false;
function toggle1(){
    if(state1){
        document.getElementById("password1").setAttribute("type","password");
        state1 = false;
        document.getElementById("eye1").style.color = '#2196f3';
    }else{
        document.getElementById("password1").setAttribute("type","text");
        state1= true;
        document.getElementById("eye1").style.color = '#069818';

    }
}
var state2 = false;
function toggle2(){
    if(state2){
        document.getElementById("password2").setAttribute("type","password");
        state2 = false;
        document.getElementById("eye2").style.color = '#2196f3';
    }else{
        document.getElementById("password2").setAttribute("type","text");
        state2 = true;
        document.getElementById("eye2").style.color = '#069818';

    }
}
var state3 = false;
function toggle3(){
    if(state3){
        document.getElementById("password3").setAttribute("type","password");
        state3 = false;
        document.getElementById("eye3").style.color = '#2196f3';
    }else{
        document.getElementById("password3").setAttribute("type","text");
        state3 = true;
        document.getElementById("eye3").style.color = '#069818';

    }
}