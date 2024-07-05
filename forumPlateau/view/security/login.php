
<h1>Connexion</h1>

    <form id="formPrincipal" action="index.php?ctrl=Security&action=login" method="post">
        <p>
            <label>
                Pseudo :
                <input type="text" name="nickName">
            </label>
        </p>
        <p>
            <label>
                Mot de passe :
                <input type="password" name="password">
            </label>
        </p>
        <P><input type="submit" name="submit" value="connexion"></p>
    </form>