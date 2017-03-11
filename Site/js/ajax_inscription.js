function valider(){
    if(validateUsername($("#username").val())){
         if(validateEmail($("#courriel").val())){
            if(validateTelephone($("#telephone").val())){
                if(validatePassword($("#pass").val()) && validatePassword($("#confpass").val())){
                    $.ajax({
                       type: "POST",
                       url: "php_scripts/inscrire.php",
                       data: {
                       'username': $("#user").val(), 
                       'prenom': $("#prenom").val(), 
                       'nom': $("#nom_t").val(), 
                       'courriel': $("#courriel").val(), 
                       'telephone': $("#telephone").val(), 
                       'sexe': $("input[type='radio'][name='sexe']:checked").val(),
                       'password': $("#pass").val(),
                       'confirm_password': $("#confpass").val(),
                       'type_utilisateur':$("#type_utilisateur").val(),
                       'code' : $("#code_acces").val()}, 
                       success: function (data) {
                           console.log(data);
                           if(data == "Inscription réussie")
                           {
                               location.reload();
                           }
                       },
                       error: function (req) { 
                       }
                    })
                }else alert("le mot de passe ne peut contenir un espace");
             }else alert("Téléphone non conforme ex: (819) 597-5423");
            }else alert("Couriel non conforme ex: exemple@hotmail.com"); 
        }else alert("Votre nom d'utilisateur ne peut contenir des caractères spéciaux");
}


function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateTelephone(tel){
    
    if(tel == "")
    {
      return true;
    }  
    else
    {
    var re = /^\(\d{3}\)\s{0,1}\d{3}-\d{4}$/
    return re.test(tel);
    }
}

function validateUsername(username){
    if(hasWhiteSpace(username) || verif_caracter_underscore(username))
    {
      return false;
    }
    else
    {
      return true;
    }

}

function validatePassword(pass){
    
    if(hasWhiteSpace(pass))
    {
      return false;
    }
    else
    {
      return true;
    }
}


