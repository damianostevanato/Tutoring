var userLogged=false;
var isAdmin=false;
$(document).ready(function () {
    checkUserLogged();
    setMateria();
   

});


function getListaDomandeByMateriaID() {
    $.ajax({
        url: 'index.php?controller=MateriaController&action=getDomande',
        dataType: "JSON",
        success: function (response) {
            populateThreadTable(response.result);
           
        },
        error: function (xhr, status, error) {
            console.log(xhr + ' ' + status + ' ' + error);
        },
    });
}

function populateThreadTable(data) {
	console.log(data);
    let html = "";
    if(isAdmin){
		console.log(isAdmin);
         html = "<thead><tr>"+
		  "<th scope='col' hidden>ID_MAteria</th>"+
        "<th scope='col'>Data</th>"+
        "<th scope='col'>Titolo</th>"+
        "<th scope='col'>Autore</th>"+
        "<th scope='col'>Azioni</th>"+
        "<th scope='col' hidden>ID</th>"+
        "</tr></thead><tbody>";
        for (let i = 0; i < data.length; i++) {
        
            html += "<tr><td hidden>"+data[i]['id_materia']+"</td><th scope='row'>" + data[i]['data'] + "</th><td>" + data[i]['titolo_domanda'] + "</td><td>" + data[i]['email'] + "</td><td id='td_del'><button type='button' class='btn btn-secondary' id='deldomanda' value='"+data[i]['id_domanda']+"'>Elimina Domanda</button></td><td hidden>"+data[i]['id_domanda']+"</td></tr>";
        }
    }else{
      
         html = "<thead><tr>"+
		 "<th scope='col' hidden>ID_MAteria</th>"+
        "<th scope='col'>Data</th>"+
        "<th scope='col'>Titolo</th>"+
        "<th scope='col'>Autore</th>"+
        "<th scope='col' hidden>ID</th>"+
        "</tr></thead><tbody>";
        for (let i = 0; i < data.length; i++) {
        
        html += "<tr><td hidden>"+data[i]['id_materia']+"</td><td scope='row'>" + data[i]['data'] + "</th><td>" + data[i]['titolo_domanda'] + "</td><td>" + data[i]['email'] + "</td><td hidden>"+data[i]['id_domanda']+"</td></tr>";
        }
    }
    html+="</tbody>";
    
    $('#thread-table').html(html);
   
    let table = $('#thread-table').DataTable();
    
    if(isAdmin){
        $('.dataTable').on('click', 'tbody tr', function(e) {
            
            if(e.target.nodeName!=="TD"){
                var data = "id_domanda="+$(this).find('td:last').text();
                
               $.ajax({
                    url: "index.php?controller=MateriaController&action=deleteDomanda",
                    type: "post",
                    dataType: "JSON",
                    data: data,
                    success: function(response){
                        
                        if(response===true){
                             getListaDomandeByMateriaID(true);
                        }
                       
                    }
               });
            }else{
                 
                   $("#id_domanda").val($(this).find('td:last').text());
				   $("#id_materia").val($(this).find('td:first').text());
				  
                   $("#form_thread").submit();
            }
          })
    }else{
        $('.dataTable').on('click', 'tbody tr', function(e) {
            
            if(e.target.nodeName!=="TD"){
                
              
            }else{
                 
                   $("#id_domanda").val($(this).find('td:last').text());
				   $("#id_materia").val($(this).find('td:first').text());
                   $("#form_thread").submit();
            }
          })
    }
}

function setMateria() {
    $.ajax({
        url: 'index.php?controller=MateriaController&action=getMateria',
        dataType: "JSON",
        success: function (response) {
            $("#titolo").text("Sezione Domande " + response.result[0]['nome_materia']);
            console.log(response);
            let html = "<form method='post' id='nuova_domanda' name='nuova_domanda' action='index.php?controller=newThreadController&action=make'>"+
                "<input id='materia' name='materia' value='"+response.result[0]['id_materia']+"' hidden></input>"+
            "<button id='button_new_thread' class='btn btn-secondary' type='button'>Nuova Domanda</button>"+
            "</form>";
            $("#nuova_domanda_div").html(html);
                $("#button_new_thread").click(function(e){
                    if(!userLogged){
                       $('#modal_login').modal('show');
                    }else{
                       $("#nuova_domanda").submit();
                    }
                })
            
        
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
                navBarLogged(response.result[0]['nome_utente'],response.result[0]['email']);
                userLogged =  true;
				getListaDomandeByMateriaID();
                if(response.result[0]['ruolo']==="1"){
                    isAdmin=true;
                }else{
                    isAdmin=false;
                }
            } else {
                var e =getUrl("e");
                if(e==="1"){
                window.history.pushState('','/tutoring/index.php?controller=MateriaController&action=make');

                   alert("Nome utente o password errati");
                }
                getListaDomandeByMateriaID();
                navBarNotLogged();
                isAdmin=false;
                userLogged =  false;
            }
        }
        

    });
   
}

function navBarNotLogged() {
    $("#mynavbar").load('./view/navbar_not_logged.php',function(){
         $("#nav-left").html("<li class='nav-item'><form method='post' action='index.php?controller=HomepageController&action=make'><button class='btn btn-secondary' style='margin-right: 5px;' type='submit'>Torna alla Home</button></form></li>");
    });
   
}

function navBarLogged(nome,email) {
    $("#mynavbar").load('./view/navbar_logged.php', function addItemsOnLogin() {
        $("#navlogged-left").html("<form method='post' action='index.php?controller=HomepageController&action=make'><button class='btn btn-secondary' style='margin-right: 5px;' type='submit'>Torna alla Home</button></form><label style='color: white;'>Benvenuto: " + nome + "</label>");
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