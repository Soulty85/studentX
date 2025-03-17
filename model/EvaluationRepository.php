<?php
    require_once("DBRepository.php");
    
    class EvaluationRepository extends DBRepository
    {
        public function addEvaluation($nom, $semestre, $type) {
            $sql =  "INSERT INTO evaluations  (nom, semestre, type)
                    VALUES (:nom, :semestre, :type)";
            
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'nom' => $nom,
                    'semestre' => $semestre,
                    'type' => $type
                ]);
                
                $lastInsertId = $this->db->lastInsertId();
                return $lastInsertId;
            
            } catch(PDOException $e) {
                error_log("Erreur lors de la creation de l'évaluation " . $e->getMessage());
            }
        }
        
        public function getAllEval() {
            $sql = "SELECT * FROM evaluations";
            
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC) ?: Null;
                
            } catch (PDOException $e) {
                error_log("Erreur lors de la recuperation des évaluation " . $e->getMessage());
            }
        }
        
        public function updateEvaluation($id, $nom, $semestre, $type) {
            $sql = "UPDATE evaluations SET nom = :nom, semestre = :semestre, evaluations.type = :type_eval
                    WHERE  evaluation_id = :id";

            
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    "nom" => $nom,
                    "semestre" => $semestre,
                    "type_eval" => $type,
                    "id" => $id
                ]);
                
                return $statement->rowCount() > 0;
                
            } catch (PDOException $e) {
                error_log("Erreur lors de la mise a jour de l'évaluation " . $e->getMessage());
            }
        }

        public function deleteEval($id) {
            $sql = "DELETE FROM evaluations WHERE evaluation_id = :id";
            
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute(["id" => $id]);

                return $statement->rowCount() > 0;

            } catch(PDOExeption $e) {
                error_log("Erreur lors de la suppression de l'evaluation " . $e);
            }

        }
    }
?>