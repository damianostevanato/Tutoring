$(document).ready(function () {
    checkUserLogged();
    
});

function navBarNotLogged() {
    $("#mynavbar").load('./view/navbar_not_logged.php',function(){
        
    });
    
}

function navBarLogged(nome,email) {
    $("#mynavbar").load('./view/navbar_logged.php', function addItemsOnLogin() {
        $("#navlogged-left").html("<label style='color: white;'>Benvenuto: " + nome + "</label>");
        $("#navlogged-right").html("<button id='button_profilo' class='btn btn-secondary' style='margin-right: 10px;' data-toggle='modal' data-target='#modal_profilo'>Profilo</button>"+
        "<form method='post' action='index.php?controller=MainController&action=logOut'><button class='btn btn-secondary'>Esci</button></form>");
        

    });
}


function sectionLoad(isAdmin){
    $.ajax({
        url: "index.php?controller=HomepageController&action=getSections",
        dataType: "JSON",
        type: "POST",
        success: function(response){
               createSections(response,isAdmin);

        }
    });
}

function createSections(materie,isAdmin){
    var html = "<hr style=\"color: rgba(255,255,255,0.1);\">";
    if(isAdmin){
        for(let i=0;i<materie.length;i++){
              html+= "<div class='row'>" +
                "            <div class='col-md-6' >" +
                "               <img src='./includes/img/"+materie[i]['nome_materia']+".png'><span class='card-title' style='padding-left: 5px; font-size: 35px;'>"+materie[i]['nome_materia']+"</span>" +
                "            </div>" +
                "            <div class='col-md-6 my-row-align-center'>" + 
        "                        <form method='post' action='index.php?controller=MateriaController&action=make'>" +
        "                            <button class='btn btn-primary' type='submit' value='"+materie[i]['id_materia']+"' id='materia' name='materia'>Vai alla sezione</button>" +
        "                        </form>" +
        "                            <button class='btn btn-primary' type='button' value='"+materie[i]['id_materia']+"' id='delmateria' name='delmateria'>" +
        "                                Elimina Materia</button>" +
                "                    </div>" +
                "        </div>" +
                "<hr style='color: rgba(255,255,255,0.1);'>"
        }
    }else{
    
    for(let i=0;i<materie.length;i++){
        html+= "<div class='row'>" +
                "            <div class='col-md-6'>" +
                "               <img src='./includes/img/"+materie[i]['nome_materia']+".png'><span class='card-title' style='padding-left: 5px; font-size: 35px;'>"+materie[i]['nome_materia']+"</span>" +
                "            </div>" +
                "            <div class='col-md-6 my-row-align-center'>" +   
        "                        <form method='post' action='index.php?controller=MateriaController&action=make'>" +
        "                            <button class='btn btn-primary' type='submit' value='"+materie[i]['id_materia']+"' id='materia' name='materia'>Vai alla sezione</button>" +
        "                        </form>" +
                "            </div>" +
                "</div>" +
                "<hr style='color: rgba(255,255,255,0.1);'>"
    }
   
    }
    $("#sections").html(html);
   
    $("#sections").on('click','button',function(e){
        
        if(e.target.name==="delmateria"){
            console.log("XD");
            var data="id_materia="+this.value;
            $.ajax({
                url: "index.php?controller=HomepageController&action=cancellaSezione",
                type: "POST",
                dataType: "JSON",
                data: data,
                success: function(response){
                    if(response===true){
                        sectionLoad(true);
                    }
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
       
    });
}
function checkUserLogged() {
    $.ajax({
        url: "index.php?controller=MainController&action=checkLogin",
        dataType: "JSON",
        type: "POST",
        success: function (response) {
            if (response.error === 0) {
                $('#modal_profilo').on('show.bs.modal', function (event) {
                    $('#modal_profilo .modal-body').html(" <form id='form_modifica' method='post' action='index.php?controller=ModificaController&action=modificaUtente'>"+
                                                            "<div class='form-group row'>"+
                                                                "<label for='nome' class='col-sm-2 col-form-label'>Nome</label>"+
                                                                "<div class='col-sm-10'>"+
                                                                    "<input type='text' class='form-control' id='nome' name='nome' value='"+response.result[0]['nome_utente']+"' >"+
                                                                "</div>"+
                                                            "</div>"+
                                                            "<div class='form-group row'>"+
                                                                "<label for='email' class='col-sm-2 col-form-label'>Email</label>"+
                                                                "<div class='col-sm-10'>"+
                                                                    "<input type='text' class='form-control' id='email' name='email'  value='"+response.result[0]['email']+"' >"+
                                                                "</div>"+
                                                            "</div>"+
                                                            "<div class='form-group row'>"+
                                                                "<label for='password' class='col-sm-2 col-form-label'>Password</label>"+
                                                                "<div class='col-sm-10'>"+
                                                                    "<input type='text' class='form-control' id='password' name='password' >"+
                                                                "</div>"+
                                                            "</div>"+
                                                            "<div class='form-group row'>"+
                                                            "<label for='password_conf' class='col-sm-2 col-form-label'>Vecchia Password</label>"+
                                                            "<div class='col-sm-10'>"+
                                                                "<input type='text' class='form-control' id='password_conf' name='password_conf' >"+
                                                            "</div>"+
                                                        "</div>"+
                                                            "<div class='form-group'><label id='error' class='errorMsg'> </label></div></form>");
                                                                $("#aggiorna").click(function(){
                                                                
                                                                var nome = $("#nome").val();
                                                                var email = $("#email").val();
                                                                var password_conf = $("#password_conf").val();
                                                                var password = $("#password").val();
                                                                console.log(nome+email+password_conf);
                                                                    if(nome==="" || email ===""  || password_conf===""){
                                                                        $("#error").text("Nome E-mail e Vecchia password sono neccessari!");
                                                                        $("#error").show();
                                                                    }else if(password_conf===""){
                                                                        $("#error").text("La vecchia password e' obbligatoria!");
                                                                        $("#error").show();
                                                                    }else if(nome!=="" && email !==""  && password_conf!==""){
                                                                            $("#form_modifica").submit();
                                                                    }
                                                            
                                                            });
                                                            
                                                            
                  });
                
                if(response.result[0]['ruolo']==="1"){
                    navBarLogged(response.result[0]['nome_utente'],response.result[0]['email']);
                    sectionLoad(true);
                   
                $("#div_modal").load('./view/modal_admin.php',function(){
                   
                    $("#modal_sezione").off().on('click','button',function(){
                        if(this.id==="nuova_sezione"){
                            var data ="nome_materia="+$("#nome_materia").val();
                            
                           $.ajax({
                               url: "index.php?controller=HomepageController&action=nuovaSezione",
                               type: "POST",
                               dataType: "JSON",
                               data: data,
                               success: function(response){
                                   if(response===true){
                                       sectionLoad(true);
                                       $("#close").trigger('click');
                                   }else if(response===false){
                                    console.log(response);
                                       $("#err").show();
                                   }
                               }
                           })
                        }
                    });
                   });
 
                 
                }else{
                    navBarLogged(response.result[0]['nome_utente']);
                    sectionLoad(false);
                }
               
            } else {
                navBarNotLogged();
                var e =getUrl("e");
                if(e==="1"){
                window.history.pushState('','/tutoring/index.php?controller=HomepageController&action=make');
					sectionLoad(false);
                    alert("Nome utente o password errati");
                  
                }else{
					sectionLoad(false);
				}
                
            }
        }


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