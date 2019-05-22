$(document).ready(function () {
    checkUserLogged();
    setDomanda();
    var showtable = getUrl("tab");
    if(showtable==="1"){
        setDomanda();
    }
});


function setDomanda() {
    $.ajax({
        url: 'index.php?controller=ThreadController&action=getDomanda',
        dataType: "JSON",
        success: function (response) {
            console.log(response);
            $("#titolo").text("Titolo: " + response.result[0]['titolo_domanda']);
            $("#textDomanda").val(response.result[0]['testo_domanda']);
            var text = "<h4 id='username' class='card-title'>"+response.result[0]['nome_utente']+"</h4>";
            $("#userDomanda").html(text);
            console.log(response.result[0]['Numero_risposte']);
            if(response.result[0]['Numero_risposte']>0){
                $.ajax({
                    url:'index.php?controller=ThreadController&action=getRisposte',
                    dataType: 'JSON',
                    success : function(response){
                        console.log(response);
                        var html="<h1 class='text-center' >Risposte</h1><br>";
                        for(i=0;i<response.result.length;i++){
                            html+="<div class='row'>" +
                                "       <div class='col-12 col-md-7 col-xl-4 offset-xl-0 mb-4' style='width: 100px;'>" +
                                "           <div class='card'>" +
                                "               <div class='card-body'>" +
                                "                   <h4 class='card-title'>"+response.result[i]['nome_utente']+"</h4>" +
                                "               </div>" +
                                "           </div>" +
                                "        </div>" +
                                "        <div class='col-12 col-md-5 col-xl-8 mb-4'><textarea  style='max-width: 650px;width: inherit;height: inherit;max-height: inherit;min-height: 200px;' readonly>"+response.result[i]['testo_risposta']+"</textarea></div>" +
                                "    </div>" +
                                "<br>";

                        }
                        $("#divRisposte").html(html);
                    }
                });
            }
        }
    })

}


function checkUserLogged() {
    $.ajax({
        url: "index.php?controller=MainController&action=checkLogin",
        dataType: "JSON",
        type: "POST",
        success: function (response) {
            
            if (response.error === 0) {
               
                navBarLogged(response.result[0]['nome_utente']);
            } else {
                
                var e =getUrl("e");
                if(e==="1"){
                window.history.pushState('','/tutoring/index.php?controller=HomepageController&action=make');

                   alert("Nome utente o password errati");
                }
                navBarNotLogged();
            }
        }


    });
}

function navBarNotLogged() {
    $("#mynavbar").load('./view/navbar_not_logged.php',function(){
        $("#nav-left").html("<li class='nav-item'><form method='post' action='index.php?controller=MateriaController&action=make'><button class='btn btn-secondary' style='margin-right: 5px;' type='submit'>Torna alle Domande</button></form></li>");
    });
}
function navBarLogged(nome,email) {
    $("#button_rispondi").show();
    $("#mynavbar").load('./view/navbar_logged.php', function addItemsOnLogin() {
        $("#navlogged-left").html("<form method='post' action='index.php?controller=MateriaController&action=make'><input id='id_materia' name='id_materia' hidden><button class='btn btn-secondary' style='margin-right: 5px;' type='submit'>Torna alle Domande</button></form><label style='color: white;'>Benvenuto: " + nome + "</label>");
        $("#navlogged-right").html("<form method='post' action='index.php?controller=MainController&action=logOut'><button class='btn btn-secondary'>Esci</button></form>");
    });
}

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