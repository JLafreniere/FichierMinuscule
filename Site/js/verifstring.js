function RestrictSpaceSpecial(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) ||  k == 8 || (k >= 48 && k <= 57));

}

function restrictSpecial(e){
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123)||  k == 8 || k == 95 || (k >= 48 && k <= 57));
}

function onlyCaracter(e){
        var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123));
}

function hasWhiteSpace(s) {
 let re = new RegExp("\\s", "g")
  return re.test(s);
}

function verif_caracter(s){
var iChars = "~`!#$%^&*+=-[]_\\\';,/{}|\":<>?";
var x = true;
for (var i = 0; i < s.length; i++)
{
  if (iChars.indexOf(s.charAt(i)) != -1)
  {
     
     x =  false;
  }
}
return x;
}

function verif_caracter_underscore(s){
    //verif caracter sans "_"
    var iChars = "~`!#$%^&*+=-[]\\\';,/{}|\":<>?";
var x = false;
for (var i = 0; i < s.length; i++)
{
  if (iChars.indexOf(s.charAt(i)) != -1)
  {
     
     x =  true;
  }
}
return x;
}

function verif_caracter_tiret(s){
    //verif caracter sans "-"
    var iChars = "~`!#$%^&*+=_[]\\\';,/{}|\":<>?";
    var x = true;
    for (var i = 0; i < s.length; i++)
    {
    if (iChars.indexOf(s.charAt(i)) != -1)
        {
            x =  false;
        }
    }
    return x;
}