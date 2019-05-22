<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>risposte</title>
    <link rel="stylesheet" href="./includes/bootstrap/css/bootstrap.min.css">
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
<div class="container my-container-max my-container-padding my-container-border my-container-margin my-container-color-white">
<h1 class="text-center my-h1-padding-top" id="titolo"></h1>
</div>
<div class="container my-container-padding my-container-border my-container-margin my-container-color-white">
    <div class="row">
        <div class="col-12 col-md-7 col-xl-4 offset-xl-0 mb-4" style="width: 100px;">
            <div class="card">
                <div class="card-body">
                    <div class="container" id="userDomanda">

                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-xl-8 mb-4"><textarea id="textDomanda" style="max-width: 650px;width: inherit;height: inherit;max-height: inherit;min-height: 200px;" placeholder="Scrivi qui la tua domanda" readonly></textarea></div>
    </div>
    <div class="row">
        <div class="col-xl-3 offset-xl-8 text-right" style="padding-left: 0px;padding-right: 15px;"><button id="button_rispondi" class="btn btn-primary text-dark btn-background button-hidden" data-toggle="modal" data-target="#myModal" style="background-color: #ffffff;" type="submit">Rispondi</button></div>
    </div>
    <hr>
    <div class="container" id="divRisposte">

    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="myModal" name="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Risposta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="index.php?controller=ThreadController&action=sendAnswer">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <textarea class="form-control" id="answer" name="answer" rows="3" ></textarea>
                            </div>
                        </div><br>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-info" data-dismiss="modal">Annulla</button>
                    <button type="submit" id="modificaButton" name="modificaButton" class="btn btn-outline-info">Invia</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="./includes/jquery/jquery-3.4.0.min.js"></script>
<script src="./includes/bootstrap/js/bootstrap.min.js"></script>
<script src="./includes/myjs/thread.js"></script>
</body>

</html>