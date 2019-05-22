<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Homepage</title>
    <link rel="stylesheet" href="./includes/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./includes/dataTable/datatables.css"/>
    <link rel="stylesheet" href="./includes/mycss/mycss.css">

</head>
<body class="my-background">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mynavbar">
    <button class="navbar-toggler" type="button" style="color:white;" data-toggle="collapse"
            data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">

    </div>
</nav>
<div class="container my-width my-div-margin-top my-container-border my-container-border my-container-color-white">
<h1 class="text-center" id="titolo"></h1>
</div>
<div class="container my-container-padding my-container-border my-container-margin my-container-color-white">
   
    <div class="container my-container-color-white">
        <div id="nuova_domanda_div">

        </div>
        <br>
        <form id='form_thread' name='form_thread' method='post' action='index.php?controller=ThreadController&action=make'>
        <input id='id_domanda' name='id_domanda' hidden/>
		<input id='id_materia' name='id_materia' hidden/>
        </form>
            <table id="thread-table" class="table " style="width:100%;">
                <thead>
                
                </thead>

                <tbody>

                </tbody>
            </table>
           
        


    </div>
    <div id="modal_login" name="modal_login" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="index.php?controller=MainController&action=login" class="px-4 py-3" method="post">
            <div class="modal-body">
              

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input class="form-control" id="email" name="email" placeholder="email@example.com" type="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" name="password" placeholder="Password" type="password">
                </div>
                <div class="dropdown-divider"></div>
            <a class="dropdown-item" style="text-align: left;" href="index.php?controller=RegistrazioneController&action=make">New around here? Sign up</a>

               
            <div class="modal-footer">
                <button class="btn btn-primary" id="login" name="login" type="submit" value="login">Sign in</button>
                <button type="button" id="close" name="close" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            </div>
            </form>
            </div>
        </div>
        </div>
</div>


<script type="text/javascript" src="./includes/jquery/jquery-3.4.0.min.js"></script>
<script type="text/javascript" src="./includes/dataTable/datatables.js"></script>
<script type="text/javascript" src="./includes/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./includes/myjs/materia.js"></script>
</body>

</html>