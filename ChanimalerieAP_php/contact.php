<div class="container my-5">
    <!-- Page de contact -->
    <div class="bg-success bg-gradient text-white text-center rounded-3 p-2 mb-5 shadow">
        <h1 class="display-4 fw-bold mb-3">
            Page de contact
        </h1>
    </div>

    <h2 class="mb-4">Connexion à la partie "Administration"</h2>

    <label for="nom" class="form-label">Nom :</label><br>
    <input type="text" id="nom" class="form-control mb-3"><br>

    <label for="prenom" class="form-label">Prénom :</label><br>
    <input type="text" id="prenom" class="form-control mb-3"><br>

    <label for="email" class="form-label">E-mail :</label><br>
    <input type="email" id="email" class="form-control mb-3"><br>

    <label for="telephone" class="form-label">Téléphone :</label><br>
    <input type="tel" id="telephone" class="form-control mb-3"><br>

    <label class="form-check-label"><input type="checkbox" id="newsletter" class="form-check-input">Abonnement à la
        newsletter</label>

    <div class="mt-2"><button type="button" onclick="verifierContact()" class="btn btn-success">Valider</button></div>

    <div id="messageErreur" class="erreur"></div><br>

</div>