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
                                    <td>
                                        <button class="btn btn-warning">Modifier Note</button>

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
                                <form method="POST" action="NoteMainController">
                                    <input type="hidden" name="etd" value="<?= $_SESSION['etdId'] ?>">

                                    <!-- Sélection de l'évaluation -->
                                    <div class="mb-3">
                                        <label for="evaluationSelect" class="form-label">Sélectionner une évaluation</label>
                                        <select class="form-select" id="evaluationSelect" name="evaluation" required>
                                            <?php foreach ($evaluations as $evaluation): ?>
                                                <option value="<?= $evaluation['evaluation_id'] ?>"><?= $evaluation['nom'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

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

                <!-- Section Footer -->
                <?php require_once(realpath(__DIR__ . "/../../../sections/admin/footer.php")) ?>
            </div>
        </div>

        <!-- Section Scripts -->
        <?php require_once(realpath(__DIR__ . "/../../../sections/admin/script.php")) ?>
    </body>
</html>
