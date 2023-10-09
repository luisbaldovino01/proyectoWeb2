const btnSignIn = document.getElementById("inicio"), 
      btnSignUp =  document.getElementById("registrar");
      formRegister = document.querySelector(".registrar"),
      formLogin = document.querySelector(".login");

btnSignIn.addEventListener("click", e => {
    formRegister.classList.add("hide");
    formLogin.classList.remove("hide");
})

btnSignUp.addEventListener("click", e => {
    formLogin.classList.add("hide");
    formRegister.classList.remove("hide");
})
