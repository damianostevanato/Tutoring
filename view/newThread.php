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
<br>
<br>
<br>
<h1 class="text-center my-h1-padding-top" id="titolo"></h1>
<div class="container my-container-padding my-container-border my-container-margin my-container-color-white" id="container_domanda">
            <form method="post" action="index.php?controller=newThreadController&action=nuovaDomanda">
                <div class="form-group row">
                    <label for="titolo_domanda" class="col-sm-2 col-form-label">Titolo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="titolo_domanda"  name="titolo_domanda" placeholder="Titolo domanda" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="testo_domanda" class="col-sm-2 col-form-label">Domanda</label>
                    <div class="col-sm-10">
                        <textarea style="max-width: 1000px;width: inherit;height: inherit;max-height: inherit;min-height: 200px;" id="testo_domanda"  name="testo_domanda" placeholder="Scrivi qui la tua domanda" ></textarea>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Invia Domanda</button>
            </form>
</div>
<script src="./includes/jquery/jquery-3.4.0.min.js"></script>
<script src="./includes/bootstrap/js/bootstrap.min.js"></script>
<script src="./includes/myjs/newthread.js"></script>
</body