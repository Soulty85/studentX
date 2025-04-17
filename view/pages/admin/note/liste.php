<!DOCTYPE html>
<html lang="fr">
    <!-- Section Head -->
    <?php require_once(realpath(__DIR__ . "/../../../sections/admin/head.php")); ?>
    
    <body class="sb-nav-fixed">
        <!-- Section Menu Haut -->
        <?php require_once(realpath(__DIR__ . "/../../../sections/admin/menuHaut.php")); ?>

        <div id="layoutSidenav">
            <!-- Section Menu Gauche -->
            <?php require_once(realpath(__DIR__ . "/../../../sections/admin/menuGauche.php")); ?>

            <div id="layoutSidenav_content">
                <!-- Bouton pour afficher le modal d'ajout -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noteModal">Ajouter une note</button>

                <div class="container mt-5">
                    <h2>Informations de l'Étudiant</h2>
                    <table class="table table-bordered">
                        <tr><th>Nom</th><td><?= $etudiant['nom'] ?></td></tr>
                        <tr><th>Prénom</th><td><?= $etudiant['prenom'] ?></td></tr>
                        <tr><th>Email</th><td><?= $etudiant['email'] ?></td></tr>
                        <tr><th>Téléphone</th><td><?= $etudiant['tel'] ?></td></tr>
                        <tr><th>Adresse</th><td><?= $etudiant['adresse'] ?></td></tr>
                    </table>

                    <h3 class="mt-4">Liste des Évaluations</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Évaluation ID</th>
                                <th>Semestre</th>
                                <th>Type</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notes as $evaluation) : ?>
                                <tr>
                                    <td><?= $evaluation['nom'] ?></td>
                                    <td><?= $evaluation['evaluation_id'] ?></td>
                                    <td><?= $evaluation['semestre'] ?></td>
                                    <td><?= $evaluation['type'] ?></td>
                                    <td><?= $evaluation['note'] ?? 'Pas de note' ?></td>
                                    <td><?= $evaluation['note'] ?? 'Pas de note' ?></td>
                                    <td>
                                        <form action="noteMainController" method="GET">
                                            <input type="hidden" value="<?= $etudiant['user_id'] ?>" name="id">
                                            <input type="hidden" value="<?= $evaluation['note_id'] ?>" name="idNote">
                                            
                                            <button type="button" 
                                                    class="btn btn-primary btn-edit-note" 
                                                    data-id="<?= $evaluation['note_id'] ?>" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editNoteModal">
                                                Modifier notes
                                            </button>

                                        </form> 
                                        
                                        <button class="btn btn-danger btn-deleteNote" data-id="<?= $evaluation['note_id'] ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Supprimer</button>  

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal d'ajout de note -->
                <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="noteModalLabel">Ajouter une note</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="noteMainController">
                                    <input type="hidden" name="etd" value="<?= $_SESSION['etdId'] ?>">

                                    <!-- Input pour la note -->
                                    <div class="mb-3">
                                        <label for="noteInput" class="form-label">Note (0 à 20)</label>
                                        <input type="number" class="form-control" id="noteInput" name="note" min="0" max="20" required>
                                    </div>

                                    <!-- Bouton de soumission -->
                                    <button type="submit" name="addNote" class="btn btn-primary">Ajouter la note</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de modification de note -->
                <div class="modal fade" id="editNoteModal" tabindex="-1" aria-labelledby="editNoteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <form action="noteMainController" method="POST">
                            <div class="modal-header">
                            <h5 class="modal-title" id="editNoteModalLabel">Modifier la note</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                            <input type="hidden" name="id" id="editNoteId">
                            <div class="mb-3">
                                <label for="editNoteValue" class="form-label">Nouvelle note (0 à 20)</label>
                                <input type="number" class="form-control" name="note" id="editNoteValue" min="0" max="20" required>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" name="updateNote" class="btn btn-primary">Mettre à jour</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>


                <!-- Modal pour suprimer une note -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="noteMainController" method="POST">
                            <input type="hidden" name="id" id="idNoteDel">
                            <p>Êtes-vous sûr de vouloir supprimer cet étudiant ? Cette action est irréversible.</p>
                                            </div>
                                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger" name="deleteNote">Supprimer</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Section Footer -->
                <?php require_once(realpath(__DIR__ . "/../../../sections/admin/footer.php")) ?>
            </div>
        </div>

        <!-- Section Scripts -->
        <?php require_once(realpath(__DIR__ . "/../../../sections/admin/script.php")) ?>

        <script src="public/js/users/test.js" ></script>
    </body>
</html>
