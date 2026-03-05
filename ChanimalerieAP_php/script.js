function verifierConnexion() {
    let login = document.getElementById("login").value;
    let password = document.getElementById("password").value;
    let connexion = document.getElementById("connexion").checked;
    let domaine = document.getElementById("domaine").value;
    let message = document.getElementById("messageErreur");
    message.textContent = ""; // on vide le message précédent

    if (login.length < 7) {
        message.textContent = "Le login doit contenir au moins 7 caractères.";
    } 

    else if (password === "") {
        message.textContent = "Le mot de passe ne peut pas être vide.";
    }

    else if (connexion === false) {
        message.textContent = "La connexion doit être sécurisée.";
    }
    
    else if (domaine === 'domaine') {
        message.textContent = "Veuillez choisir le domaine.";
    }

    else if (domaine != 'tec19') {
        message.textContent = "Le domaine sélectionné doit être \"Tec19\".";
    }

    else {
        location.href = "admin.html";
    }
}

function verifierContact() {
    let nom = document.getElementById("nom").value;
    let prenom = document.getElementById("prenom").value;
    let email = document.getElementById("email").value;
    let telephone = document.getElementById("telephone").value
    let message = document.getElementById("messageErreur");
    message.textContent = "";

    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (nom === "") {
        message.textContent = "Le nom ne peut pas être vide."
    }

    else if (prenom === "") {
        message.textContent = "Le prénom ne peut pas être vide."
    }

    else if (email === "") {
        message.textContent = "L'email ne peut pas être vide."
    }

    else if (!emailRegex.test(email)) {
        message.textContent = "Veuillez entrez une adresse email valide."
    }

    else if (telephone === "") {
        message.textContent = "Le numéro de téléphone ne peut pas être vide."
    }
    else {
        alert("Le contact a bien été crée.")
    }
}