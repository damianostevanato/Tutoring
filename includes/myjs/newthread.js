$(document).ready(function () {
    checkUserLogged();
});

function checkUserLogged() {
    $.ajax({
        url: "index.php?controller=MainController&action=checkLogin",
        dataType: "JSON",
        type: "POST",
        success: function (response) {
            if (response.error === 0) {
                navBarLogged(response.result[0]['nome_utente'],response.result[0]['email']);
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
    $("#mynavbar").load('./view/navbar_not_logged.php');
}

function navBarLogged(nome,email) {
    $("#mynavbar").load('./view/navbar_logged.php', function addItemsOnLogin() {
        $("#navlogged-left").html("<form method='post' action='index.php?controller=MateriaController&action=make'><button class='btn btn-secondary' style='margin-right: 5px;' type='submit'>Torna Alle Domande</button></form><span></span><label style='color: white;'>Benvenuto: " + nome + "</label>");
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