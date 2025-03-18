<?php 
    require_once("DBRepository.php");
    
    class NoteRepository extends DBRepository {
        public function getNote($id) {            
            $sql = "SELECT ev.nom, ev.evaluation_id, ev.semestre, ev.type, n.note
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

        public function addNote($idEtd, $eval, $note) {
            $sql = "INSERT INTO notes (note, etudiant_id, evaluation_id) VALUES (:note, :idetd, :eval)";
            
            
            try {
                $statement = $this->db->prepare($sql);
                
                $statement->execute([
                    "note" => $note,
                    "idetd" => $idEtd,
                    "eval" => $eval
                ]);
                
                return $this->db->lastInsertId();
                
            } catch (PDOException $e) {
                error_log("erreur lors de l'ajout de la note " . $e);
            }
        }
    }


?>