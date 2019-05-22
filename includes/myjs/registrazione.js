$(document).ready(function(){
  var e = getUrl("e");
  
  if(e==="1"){
    alert("Nome o E-mail utente gia in uso");
  }
  $("#registrazione").click(function(e){
      var nome = $("#nome").val();
      var email = $("#email").val();
      var password = $("#password").val();
      var password_repeat = $("#password-repeat").val();
        if(nome==="" && email ==="" && password==="" && password_repeat===""){
            $("#nome").css("border-color","red");
            $("#email").css("border-color","red");
            $("#password").css("border-color","red");
            $("#password-repeat").css("border-color","red");
            $("#error").text("Compilare tutti i campi!");
            $("#error").show();
        }else if(nome!=="" && email ==="" && password==="" && password_repeat===""){
            $("#nome").css("border-color","");
            $("#email").css("border-color","red");
            $("#password").css("border-color","red");
            $("#password-repeat").css("border-color","red");
            $("#error").text("Compilare tutti i campi!");
            $("#error").show();
        }else if(nome!=="" && email ==="" && password!=="" && password_repeat!==""){
            $("#nome").css("border-color","");
            $("#email").css("border-color","red");
            $("#password").css("border-color","");
            $("#password-repeat").css("border-color","");
            $("#error").text("Compilare tutti i campi!");
            $("#error").show();
        }else if(nome==="" && email !=="" && password==="" && password_repeat===""){
            $("#email").css("border-color","");
            $("#nome").css("border-color","red");
            $("#password").css("border-color","red");
            $("#password-repeat").css("border-color","red");
            $("#error").text("Compilare tutti i campi!");
            $("#error").show();
        }else if(nome!=="" && email !=="" && password!==password_repeat){
            $("#nome").css("border-color",""); $("#email").css("border-color","");
            $("#password").css("border-color","red");
            $("#password-repeat").css("border-color","red");
            $("#error").text("Le password non corrispondono");
            $("#error").show();
        }else if(nome!=="" && email !=="" && password==="" && password_repeat===""){
            $("#nome").css("border-color",""); $("#email").css("border-color","");
            $("#password").css("border-color","red");
            $("#password-repeat").css("border-color","red");
            $("#error").text("Compilare tutti i campi!");
            $("#error").show();
        }else if(nome!=="" && email !=="" && password!=="" && password_repeat===""){
            $("#nome").css("border-color",""); $("#email").css("border-color","");$("#password").css("border-color",""); 
            $("#password-repeat").css("border-color","red");
            $("#error").text("Compilare tutti i campi!");
            $("#error").show();
        }else if(nome!=="" && email !=="" && password!=="" && password_repeat!==""){
            $("#nome").css("border-color",""); $("#email").css("border-color","");$("#password").css("border-color",""); $("#password-repeat").css("border-color",""); 
            $("#registra-form").submit();
        } 
  })
  
});


function getUrl(param){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for(var i=0;i<sURLVariables.length ; i++){
        var sParameterName = sURLVariables[i].split('=');
        if( sParameterName[0] == param){
            return sParameterName[1];
        }
    }
}



