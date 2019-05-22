<!DOCTYPE html>
<html lang="em">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Registrazione</title>
    <link rel="stylesheet" href="./includes/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./includes/mycss/Registration-Form.css">
    <link rel="stylesheet" href="./includes/mycss/mycss.css">
</head>

<body style="background-color: #017bff;">
    <!-- Start: Registration Form with Photo -->
    <div class="container my-container-padding my-container-border my-container-margin my-container-color-white">
        <!-- Start: Form Container -->
        <div class="container  my-container-color-white">
            <form id="registra-form" method="post" action="index.php?controller=RegistrazioneController&action=nuovoUtente">
                <h2 class="text-center"><strong>Crea un account</strong></h2>
                <div class="form-group"><input class="form-control" type="text" id="nome" name="nome" placeholder="Nome"></div>
                <div class="form-group"><input class="form-control" type="email" id="email" name="email" placeholder="Email" ></div>
                <div class="form-group"><input class="form-control" type="password" id="password" name="password" placeholder="Password"></div>
                <div class="form-group"><input class="form-control" type="password" id="password-repeat" name="password-repeat" placeholder="Password (conferma)" ></div>
                <div class="form-group"><label id="error" class="errorMsg"> </label></div>
                <div class="form-group"><button class="btn btn-primary btn-block text-dark" type="button" id="registrazione" style="background-color: rgb(247,249,252);">Registrati</button></div>
            </form>
        </div>
        <!-- End: Form Container -->
    </div>
	<footer class="footer">
        <div class="container">
            <h6 align="center">Progetto tutoring realizzato da Stevanato Damiano, Mamprin Riccardo, Pellizzon Tommaso e Simonato Mattia</span>
        </div>
    </footer>
    <!-- End: Registration Form with Photo -->
    <script src="./includes/jquery/jquery-3.4.0.min.js"></script>
    <script src="./includes/bootstrap/js/bootstrap.js"></script>
    <script src="./includes/myjs/registrazione.js"></script>
</body>

</html>