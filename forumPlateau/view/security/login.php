
<h1>Connexion</h1>

    <form id="formPrincipal" action="index.php?ctrl=Security&action=login" method="post">
        <p>
            <label class="form-label mt-4" for="readOnlyInput">
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
        <P><input class="btn btn-primary" type="submit" name="submit" value="connexion"></p>
    </form>