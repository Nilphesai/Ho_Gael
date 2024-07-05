
<h1>Inscription</h1>

    <form id="formPrincipal" action="index.php?ctrl=Security&action=register" method="post">
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
        <p>
            <label>
                confirmation du mot de passe :
                <input type="password" name="password2">
            </label>
        </p>
        <p>
            <label>
                adresse email :
                <input type="text" name="email">
            </label>
        </p>
        <P><input type="submit" name="submit" value="inscription"></p>
    </form>