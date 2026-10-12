<div class="container my-5">
    <!-- Page de contact -->
    <div class="bg-pink bg-gradient text-white text-center rounded-3 p-2 mb-5 shadow">
        <h1 class="display-4 fw-bold mb-3">
            Connexion à la partie administration
        </h1>
    </div>


    <?php
    if (isset($_GET["erreur"])) {
        $erreur = $_GET["erreur"];
        ?>
        <div class="mt-2 p-3 w-75 mx-auto alert alert-danger role=" alert">
            <?php echo $erreur ?>
        </div>
        <?php
    }
    if (isset($_GET["info"])) {
        $info = $_GET["info"];
        ?>
        <div class="mt-2 p-3 w-75 mx-auto alert alert-pink role=" alert">
            <h2>
                <?php echo $info ?>
            </h2>
        </div>
        <?php
    }
    ?>

    <form action="connexion_exe.php" method="post">
        <div>
            <label>Votre login :</label>
            <input name="login" id="login" type="text" class="form-control mb-3" />
        </div>

        <div>
            <label>Mot de passe :</label>
            <input name="mdp" id="mdp" type="password" class="form-control mb-3" />
        </div>

        <button type="submit" class="btn btn-pink">Valider</button>

        <div id="messageErreur" class="erreur"></div><br>
    </form>


</div>