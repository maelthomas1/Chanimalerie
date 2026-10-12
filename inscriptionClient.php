<div class="container my-5">
    <!-- Page de contact -->
    <div class="bg-pink bg-gradient text-white text-center rounded-3 p-2 mb-5 shadow">
        <h1 class="display-4 fw-bold mb-3">
            Inscritpion
        </h1>
    </div>

    <form action="inscriptionClient_exe.php" method="post" class="text-start w-75 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Login :</label>
                <input name="login" type="text" class="form-control" required />
            </div>
            <div class="col-md-6 mb-3">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Mot de passe :</label>
                <input name="mdp" type="password" class="form-control" required />
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Confirmer le mot de passe :</label>
                <input name="mdpConfirm" type="password" class="form-control" required />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Prénom :</label>
                <input name="prenom" type="text" class="form-control" required />
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nom :</label>
                <input name="nom" type="text" class="form-control" required />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Mail :</label>
                <input name="mail" type="email" class="form-control" />
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Téléphone :</label>
                <input name="telephone" type="text" class="form-control" />
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-pink btn-lg">Valider l'inscription</button>
        </div>
    </form>

</div>