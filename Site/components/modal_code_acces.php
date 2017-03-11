<div id="modal_code" class="modal">
  <div class="modal-content">
    <div class="entete-modal" style="text-align:center;margin-bottom: 15px;">
      <img src="http://www.cegeptr.qc.ca/wp-content/uploads/2013/01/defi-sante-300x251.png" id="imgDef" style="height:150px;width:150px;">
    </div>
    <div class="contenu-modal">
      <div class="row">
        <form class="col s12">
          <div class="row" style="margin-bottom:0px">
            <div class="input-field col s12" style="margin-top:15px">
              <i class="material-icons prefix">vpn_key</i>
              <input id="code_acces" name="code_acces" onkeypress="return RestrictSpaceSpecial(event)"  maxlength="5" type="text" class="validate">
              <label for="code_acces">Code d'accès</label>
            </div>
            
            <div class="col s12" style="margin-top:15px">
              <button class="btn green waves-effect waves-light col s12 l12" type="button" onclick="confirmerCode()" name="code_confirm">Confirmer le code</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<script src="js/verifstring.js"></script>
<script>
  

  function confirmerCode(){
    if(hasWhiteSpace($("#code_acces").val()) || verif_caracter("#code_access") ){
      alert ("Le code contient un de ces caractères ~`!#$%^&*+=-[]\\\';,/{}|\":<>? \nCes caractères ne sont pas permit\n");
    }else{
    $.ajax({
            type: "POST",
            url: "php_scripts/validerCode.php",
            data: {'code': $("#code_acces").val()}, 
            success: function (data) {
                  if(data != "fail"){
                    if (data=='Groupe'){
                      $('#nePasAfficher').attr('hidden','true');
                      $('#modal_code').modal('close');
                      $('#modal_ins').modal('open');
                    }
                    else if (data == 'SansGroupe'){
                      $('#nePasAfficher').removeAttr('hidden');
                      $('#modal_code').modal('close');
                      $('#modal_ins').modal('open');
                    }
                    else{
                      alert("Code d'accès invalide");
                    }
                  }else{alert("Code d'accès invalide")};   
        },
            error: function (req) {
                alert("erreur");
            }
        });
      }
}    

</script>