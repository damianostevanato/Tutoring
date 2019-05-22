<ul class="navbar-nav  mr-auto" id="nav-left">

</ul>
<ul class="navbar-nav  ml-auto">
    <li class="nav-item dropdown" style="margin-right:  10px;">
        <button aria-expanded="false" aria-haspopup="true" class="btn btn-secondary " data-toggle="dropdown"
                id="dropdownMenu2" type="button">
            Login
        </button>
        <div aria-labelledby="navbarDropdownMenuLink" class="dropdown-menu login">
            <form action="index.php?controller=MainController&action=login" class="px-4 py-3" method="post">

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input class="form-control " id="email" name="email" placeholder="email@example.com" type="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control " id="password" name="password" placeholder="Password" type="password">
                </div>
                <button class="btn btn-secondary" id="login" name="login" type="submit" value="login">Sign in</button>

            </form>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="index.php?controller=RegistrazioneController&action=make">Sei nuovo? Registrati!</a>
        </div>
    </li>
    <li class="nav-item">
        <form action="index.php?controller=RegistrazioneController&action=make" method="post">
            <button class="btn btn-secondary" id="registra" name="registra" type="submit">Registrati</button>
        </form>
    </li>
</ul>
