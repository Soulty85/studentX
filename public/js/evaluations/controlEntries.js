document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("evaluationForm");

    if (!form) {
        console.error("❌ Le formulaire #evaluationForm n'existe pas !");
        return;
    }

    form.addEventListener("submit", function (event) {
        // Vérification du contexte (ajout ou modification)
        let nomInput;
        let errorDiv = document.getElementById("errorNom");

        if (!errorDiv) {
            console.error("❌ Impossible de trouver l'élément #errorNom !");
            return;
        }

        if (document.getElementById("nom")) {
            nomInput = document.getElementById("nom").value.trim();
        } else if (document.getElementById("editNom")) {
            nomInput = document.getElementById("editNom").value.trim();
        }

        // Contrôle de la saisie du nom
        if (!nomInput) {
            errorDiv.textContent = "Le nom de l'évaluation est requis.";
            event.preventDefault();
        } else if (nomInput.length < 3 || nomInput.length > 50) {
            errorDiv.textContent = "Le nom doit contenir entre 3 et 50 caractères.";
            event.preventDefault();
        } else if (!/^[a-zA-ZÀ-ÿ\s]+$/.test(nomInput)) {
            errorDiv.textContent = "Le nom ne doit contenir que des lettres.";
            event.preventDefault();
        } else {
            errorDiv.textContent = ""; // Réinitialisation de l'erreur si la validation passe
        }
    });

    // Ajout d'un contrôle en temps réel pour réinitialiser les erreurs dès qu'on modifie le champ 'nom' ou 'editNom'
    const inputs = [document.getElementById("nom"), document.getElementById("editNom")];
    inputs.forEach(input => {
        if (input) {
            input.addEventListener("input", function () {
                document.getElementById("errorNom").textContent = "";
            });
        }
    });
});