<div class="container my-5">
    <!-- Page de contact -->
    <div class="bg-success bg-gradient text-white text-center rounded-3 p-2 mb-5 shadow">
        <h1 class="display-4 fw-bold mb-3">
            Connexion
        </h1>
    </div>

    <label for="login" class="form-label">Login :</label><br>
    <input type="text" id="login" class="form-control mb-3"><br>

    <label for="password" class="form-label">Mot de passe :</label><br>
    <input type="password" id="password" class="form-control mb-3"><br>

    <label class="form-check-label mb-3"><input type="checkbox" id="connexion" class="form-check-input">Connexion
        sécurisée ?</label>

    <div><label class="form-label">Domaine</label></div>
    <div><select id="domaine" class="form-select mb-3">
            <option value="domaine">Choisir un domaine</option>
            <option value="local">Local</option>
            <option value="tec19">Serveur Tec19</option>
            <option value="tec25">Serveur Tec25</option>
        </select>
    </div>

    <button type="button" onclick="verifierConnexion()" class="btn btn-success">Valider</button>

    <div id="messageErreur" class="erreur"></div><br>

</div>