/*function darkMode(){
    var body = document.body
    body.classList.toggle("darkMode");
}*/

let darkModeToggle = document.getElementById('darkModeToggle');

let body = document.body

darkModeToggle.addEventListener('click', function(){
    enableDarkMode();
    /*if (darkModeToggle.click){
        enableDarkMode();
    }
    else {
        disabledarkMode();
    }*/
});

function enableDarkMode(){
    body.classList.add('darkMode');
};

function disabledarkMode(){
    body.classList.remove('darkMode');
};

function darkMode(){
    var navBar = document.getElementById("navigation-bar");
    if (navBar.className === "homeNav"){
        navBar.className += "responsive";
    }
    else {
        navBar.className = "homeNav";
    }
};

/*document.addEventListener("DOMContentLoaded", () => {
    let signup = document.querySelector(".signupBtn");
    let login = document.querySelector(".loginBtn");
    let slider = document.querySelector(".slider");
    let forms = document.querySelector(".forms");

    signup.addEventListener("click", () => {
        slider.classList.add("moveslider");
        forms.classList.add("forms-move");
    });

    login.addEventListener("click", () => {
        slider.classList.remove("moveslider");
        forms.classList.remove("forms-move");
    });
    
});*/


