<?php 
    require_once("DBRepository.php");
    
    class NoteRepository extends DBRepository {
        public function getNote($id) {            
            $sql = "SELECT ev.nom, ev.evaluation_id, ev.semestre, ev.type, n.note, n.note_id
                    FROM notes n
                    JOIN evaluations ev ON n.evaluation_id = ev.evaluation_id
                    JOIN etudiants et ON n.etudiant_id = et.etudiant_id
                    WHERE et.user_id = :id";
            
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'id' => $id
                ]);
                
                $note = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                return $note;
                
            } catch (PDOException $e) {
                error_log("erreur lors de la recuperation de la note " . $e);
            }
        }

        public function addNote($idEtd, $ideval, $note) {
            $sql = "INSERT INTO notes (note, etudiant_id, evaluation_id) VALUES (:note, :idetd, :eval)";
            
            
            try {
                $statement = $this->db->prepare($sql);
                
                $statement->execute([
                    "note" => $note,
                    "idetd" => $idEtd,
                    "eval" => $ideval
                ]);
                
                return $this->db->lastInsertId();
                
            } catch (PDOException $e) {
                error_log("erreur lors de l'ajout de la note " . $e);
            }
        }

        public function updateNote($idNote, $note) {
            $sql = "UPDATE  notes SET notes.note = :newnote WHERE notes.note_id = :id";
            
            
            try {
                $statement = $this->db->prepare($sql);
                
                $statement->execute([
                    "newnote" => $note,
                    "id" => $idNote,
                ]);
                
                return $statement->rowCount() > 0;
            }
            catch (PDOException $e) {
                error_log("Erreur lors de la modification de la note " . $e->getMessage());
            }
        }

        public function deleteNotel($id) {
            $sql = "DELETE FROM notes WHERE note_id = :id";
            
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute(["id" => $id]);

                return $statement->rowCount() > 0;

            } catch(PDOException $e) {
                error_log("Erreur lors de la suppression de la note " . $e);
            }

        }
    }


?>