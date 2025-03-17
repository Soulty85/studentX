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

        <div class="container mt-5">
    <button class="btn btn-primary mb-3" style="width: auto; padding: 10px 25px; font-size: 16px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" data-bs-toggle="modal" data-bs-target="#addUserModal">
        Ajouter un Utilisateur
    </button>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Matricule</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td><?= $etudiant['user_id'] ?></td>
                    <td><?= $etudiant['nom'] ?></td>
                    <td><?= $etudiant['prenom'] ?></td>
                    <td><?= $etudiant['email'] ?></td>
                    <td><?= $etudiant['matricule'] ?></td>
                    <td><?= $etudiant['tel'] ?></td>
                    <td><?= $etudiant['adresse'] ?></td>
                    <td>
                        <!-- Modifier button -->
                        <button class="btn btn-warning btn-sm btn-edit" 
                                data-id="<?= $etudiant['user_id'] ?>" 
                                data-nom="<?= $etudiant['nom'] ?>" 
                                data-prenom="<?= $etudiant['prenom'] ?>" 
                                data-email="<?= $etudiant['email'] ?>" 
                                data-matricule="<?= $etudiant['matricule'] ?>" 
                                data-tel="<?= $etudiant['tel'] ?>" 
                                data-adresse="<?= $etudiant['adresse'] ?>" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editUserModal">
                            Modifier
                        </button>

                        <!-- Supprimer button -->
                        <button class="btn btn-danger btn-sm btn-delete" 
                                data-id="<?= $etudiant['user_id'] ?>" 
                                data-bs-toggle="modal" 
                                data-bs-target="#confirmDeleteModal">
                            Supprimer
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

        
      <!-- Modal pour ajouter un utilisateur -->
      <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addUserModalLabel">Ajouter un utilisateur</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="userForm" action="userMainController" method="POST">
                <div class="mb-3">
                  <label for="nom" class="form-label">Nom</label>
                  <input type="text" class="form-control" id="nom" name="nom" required>
                  <div id="errorNom" style="color: red;"></div>
                </div>
                <div class="mb-3">
                  <label for="prenom" class="form-label">Prenom</label>
                  <input type="text" class="form-control" id="prenom" name="prenom" required>
                  <div id="errorPrenom" style="color: red;"></div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                  <div id="errorEmail" style="color: red;"></div>
                </div>
                <select class="form-control mb-3" id="role" name="role" required onchange="affichierChamps()">
                    <option value="" disabled selected>Choisir un rôle</option>
                    <option value="Admin" selected>Admin</option>
                    <option value="Etudiant">Etudiant</option>
                </select>

                <!-- champs pour les etudiants -->
                <div id="etudiants" style="display: none;">
                  <div class="mb-3">
                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" class="form-control" id="matricule" name="matricule" required>
                    <div id="errorMatricule" style="color: red;"></div>
                  </div>
                  <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                    <div id="errorAdresse" style="color: red;"></div>
                  </div>
                  <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required>
                    <div id="errorTelephone" style="color: red;"></div>
                  </div>
                </div>  

                <button type="submit" name="formUser" class="btn btn-primary">Ajouter</button>
              </form>
            </div>
          </div>
        </div>
      </div>

          <!-- Modal pour modifier un etudiant -->
          <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modifier l'étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="userForm" action="userMainController" method="POST">
                  <input type="hidden" name="id" id="idStudent">
                  <div class="mb-3">
                    <label for="editNom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="editNom" name="nom",required>
                  </div>
                  <div class="mb-3">
                    <label for="editPrenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="editPrenom" name="prenom" required>
                  </div>
                  <div class="mb-3">
                    <label for="editEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="editEmail" name="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="editMatricule" class="form-label">Matricule</label>
                    <input type="text" class="form-control" id="editMatricule" name="matricule" required>
                  </div>
                  <div class="mb-3">
                    <label for="editTel" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="editTel" name="tel" required>
                  </div>
                  <div class="mb-3">
                    <label for="editAdresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="editAdresse" name="adresse" required>
                  </div>
                  <button type="submit" name="updateStudent" class="btn btn-primary">Modifier</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal pour suprimer un etudiant -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="userMainController" method="POST">
                <input type="hidden" name="id" id="idStudentDel">
                  <p>Êtes-vous sûr de vouloir supprimer cet étudiant ? Cette action est irréversible.</p>
                                </div>
                                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-danger" name="deleteStudent">Supprimer</button>
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

    <script src="public/js/users/fields.js" ></script>

  </body>
</html>
