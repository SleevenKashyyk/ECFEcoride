const mailInput = document.getElementById("InputEmail");
const passwordInput = document.getElementById("InputPassword");
const btnConnexion = document.getElementById("btnConnexion");

btnConnexion.addEventListener("click", checkCredentials);


function checkCredentials(){
        //Ici, il faudra appeler l'API pour vérifier les credentials en BDD
        
    if(mailInput.value == "test@mail.com" && passwordInput.value == "123"){
            //Il faudra récupérer le vrai token
            const token = "lkjsdngfljsqdnglkjsdbglkjqskjgkfjgbqslkfdgbskldfgdfgsdgf";
            setToken(token);
            //placer ce token en cookie
    
            setCookie(RoleCookieName, "admin", 7);
            location.replace("/");
    }
    else{
            mailInput.classList.add("is-invalid");
            passwordInput.classList.add("is-invalid");
    }
 }

