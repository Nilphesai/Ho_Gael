
<h1>Inscription</h1>

    <form id="formPrincipal" action="index.php?ctrl=Security&action=register" method="post">
        <p>
            <label class="form-label mt-4">
                Pseudo :
                <input class="form-control" placeholder="Pseudo" type="text" name="nickName">
            </label>
        </p>
        <p>
            <label for="InputPassword1" class="form-label mt-4">
                Mot de passe :
                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
            </label>
        </p>
        <p>
            <label for="InputPassword2" class="form-label mt-4">
                confirmation du mot de passe :
                <input type="password" name="password2" class="form-control" placeholder="Password" autocomplete="off">
            </label>
        </p>
        <p>
            <label for="InputEmail" class="form-label mt-4">
                adresse email :
                <input class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="Email" type="email" name="email">
            </label>
        </p>
        <P><input class="btn btn-primary" type="submit" name="submit" value="inscription"></p>
    </form>