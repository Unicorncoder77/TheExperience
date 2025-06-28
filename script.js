function passShow(){
    var id = document.getElementById("createPass");
    if (id.type === "password"){
        id.type = "text";
    }
    else {
        id.type = "password";
    }
}

/*function signUp(){

}*/