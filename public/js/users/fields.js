// page user/liste.php
function affichierChamps() {
    const role = document.getElementById('role').value;
    const etudiants = document.getElementById('etudiants');

    if (role === 'Etudiant') {
        etudiants.style.display = "block";
    }
    else {
        etudiants.style.display = "none";
    }
}

// permet la modification d'un utilisateur sur la page user/liste.php 
const update = document.querySelectorAll(".btn-edit");
update.forEach(boutton => {
    boutton.addEventListener("click", (e)=>{
        const id = boutton.getAttribute("data-id");
        const nom = boutton.getAttribute("data-nom");
        const prenom = boutton.getAttribute("data-prenom");
        const email = boutton.getAttribute("data-email");
        const matricule = boutton.getAttribute("data-matricule");
        const tel = boutton.getAttribute("data-tel");
        const adresse = boutton.getAttribute("data-adresse");
        
        document.getElementById('idStudent').value = id;
        document.getElementById('editNom').value = nom;
        document.getElementById('editPrenom').value = prenom;
        document.getElementById('editEmail').value = email;
        document.getElementById('editMatricule').value = matricule;
        document.getElementById('editTel').value = tel;
        document.getElementById('editAdresse').value = adresse;
    });
});

// permet la modification d'une evaluation page evaluation/liste.php
const updateEval = document.querySelectorAll(".btn-editEval");
updateEval.forEach(boutton => {
    boutton.addEventListener('click', ()=>{
        const id = boutton.getAttribute("data-id");
        const nom = boutton.getAttribute("data-nom");
        const semestre = boutton.getAttribute("data-semestre");
        const type = boutton.getAttribute("data-type");

        document.getElementById("idEval").value = id;
        document.getElementById("editNom").value = nom;
        document.getElementById("editSemestre").value = semestre;
        document.getElementById("editType").value = type
    });
});

// permet la modification d'une note page note/liste.php
const updateNote = document.querySelectorAll(".btn-editEval");
updateNote.forEach(boutton => {
    boutton.addEventListener('click', ()=>{
        const id = boutton.getAttribute("data-id");
        const nom = boutton.getAttribute("data-nom");
        const semestre = boutton.getAttribute("data-semestre");
        const type = boutton.getAttribute("data-type");

        document.getElementById("idEval").value = id;
        document.getElementById("editNom").value = nom;
        document.getElementById("editSemestre").value = semestre;
        document.getElementById("editType").value = type
    });
});

// Bouton suprimer etudiant
const deleteStd = document.querySelectorAll(".btn-delete");
deleteStd.forEach(boutton => {
    boutton.addEventListener("click", (e)=>{
        const id = boutton.getAttribute("data-id");
        document.getElementById('idStudentDel').value = id;
    });
});

// Bouton suprimer evaluation
const deleteEval = document.querySelectorAll(".btn-deleteEval");
deleteEval.forEach(boutton => {
    boutton.addEventListener("click", (e)=>{
        const id = boutton.getAttribute("data-id");
        document.getElementById('idEvalDel').value = id;
    });
});

// Bouton suprimer evaluation
const deleteButtons = document.querySelectorAll('.btn-deleteNote');
const hiddenInput = document.getElementById('idNoteDel');

deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
        const noteId = this.getAttribute('data-id');
        hiddenInput.value = noteId;
    });
});
