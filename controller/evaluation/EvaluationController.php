<?php 
    session_start();
    require_once('../../model/EvaluationRepository.php');
    
    class EvaluationController
    {
        private $evaluationRepository;

        public function __construct() {
            $this->evaluationRepository = new EvaluationRepository();
        } 

        public function addEvaluation() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nomEval = $_POST['nom'];
                $semestreEval = $_POST['semestre'];
                $typeEval = $_POST['type'];

                
                $this->evaluationRepository->addEvaluation($nomEval, $semestreEval, $typeEval);
                $this->getAllEval();
            }
        }

        public function getAllEval() {
            $evaluations = $this->evaluationRepository->getAllEval();
            require_once("../../view/pages/admin/evaluation/liste.php");
        }
        
        public function updateEvaluation() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nomEval = $_POST['nom'];
                $semestreEval = $_POST['semestre'];
                $typeEval = $_POST['type'];
                $idEval = $_POST['id'];
                
                $this->evaluationRepository->updateEvaluation($idEval, $nomEval, $semestreEval, $typeEval);
                $this->getAllEval();
            }
        }

        public function deleteEvaluation() {
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                $id = $_POST['id'];

                $this->evaluationRepository->deleteEval($id);
                $this->getAllEval();
            }
        }
    }
?>