<!DOCTYPE html>
<html lang="en">
<!-- Section Head -->
<?php require_once(realpath(__DIR__ . "/../../../sections/admin/head.php")); ?>

<body class="sb-nav-fixed">
    <!-- Section Menu Haut -->
    <?php require_once(realpath(__DIR__ . "/../../../sections/admin/menuHaut.php")); ?>

    <div id="layoutSidenav">
    <!-- Section Menu Gauche -->
    <?php require_once(realpath(__DIR__ . "/../../../sections/admin/menuGauche.php")); ?>

    <div id="layoutSidenav_content">
        <!-- Section Content -->
        
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEvalModal">Ajouter une Evaluation</button>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Semestre</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>  
            <tbody>
                <?php foreach($evaluations as $evaluation): ?>
                <tr>
                    <td><?= $evaluation['nom'] ?></td>
                    <td><?= $evaluation['semestre'] ?></td>
                    <td><?= $evaluation['type'] ?></td>
                    <td>
                    <button class="btn btn-warning btn-editEval" 
                            data-nom="<?= $evaluation['nom'] ?>" 
                            data-semestre="<?= $evaluation['semestre'] ?>" 
                            data-type="<?= $evaluation['type'] ?>" 
                            data-id="<?= $evaluation['evaluation_id'] ?>" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editEvalModal">
                        Modifier
                    </button>
                    
                    <button class="btn btn-danger btn-deleteEval" data-id="<?= $evaluation['evaluation_id'] ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Supprimer</button>        </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
          </table>

          <!-- Modal pour ajouter une evaluation -->
          <div class="modal fade" id="addEvalModal" tabindex="-1" aria-labelledby="addEvalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addUserModalLabel">Ajouter une evaluation</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="evalMainController" method="POST">
                    <div class="mb-3">
                      <label for="nom" class="form-label">Nom</label>
                      <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                      <label for="semestre" class="form-label">Semestre</label>
                      <select class="form-control" id="semestre" name="semestre">
                        <option value="Semestre 1">Semestre 1</option>
                        <option value="Semestre 2">Semestre 2</option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="type" class="form-label">Type</label>
                      <select class="form-control" id="type" name="type">
                        <option value="Examen">Examen</option>
                        <option value="Devoir">Devoir</option>
                      </select>
                    </div>
                  
  
                    <button type="submit" name="addEval" class="btn btn-primary">Ajouter</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal pour modifier un evaluation -->
          <div class="modal fade" id="editEvalModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier l'Evaluation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
                <form action="evalMainController" method="POST">
                  <input type="hidden" name="id" id="idEval">

                  <div class="mb-3">
                    <label for="editNom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="editNom" name="nom">
                  </div>

                  <div class="mb-3">
                    <label for="editSemestre" class="form-label">Semestre</label>
                    <input type="text" class="form-control" id="editSemestre" name="semestre">
                  </div>

                  <div class="mb-3">
                    <label for="editType" class="form-label">Type</label>
                    <select class="form-control" id="editType" name="type">
                      <option value="Examen">Examen</option>
                      <option value="Devoir">Devoir</option>
                    </select>
                  </div>

                  <button type="submit" name="updateEval" class="btn btn-primary">Modifier</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal pour suprimer une evaluation -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
                <form action="evalMainController" method="POST">
                <input type="hidden" name="id" id="idEvalDel">
                  <p>Êtes-vous sûr de vouloir supprimer cet évaluation ? Cette action est irréversible.</p>
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-danger" name="deleteEval">Supprimer</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- Section Footer -->
        <?php require_once(realpath(__DIR__ . "/../../../sections/admin/footer.php")); ?>
    </div>
    </div>
    <!-- Section Scripts -->
    <?php require_once(realpath(__DIR__ . "/../../../sections/admin/script.php")); ?>
    
    <script src="public/js/users/fields.js" ></script
  </body>
</html>



