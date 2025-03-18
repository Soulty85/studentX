<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    session_start();
    require_once("../../model/NoteRepository.php");
    require_once('../user/UserController.php');
    require_once("../evaluation/EvaluationController.php");
    
    class NoteController
    {
        private $noteRepository;
        
        public function __construct() {
            $this->noteRepository = new NoteRepository();   
        }

        public function getNote() {
            $user_id = isset($_GET['id']) ? $_GET['id'] : (isset($_SESSION["etdId"]) ? $_SESSION["etdId"] : null);

            $_SESSION["etdId"] = $user_id; 
            
            $userController = new UserController();
            $evaluationController = new EvaluationController();

            $etudiant = $userController->getById($user_id);
            $evaluations = $evaluationController->getAllEval();
            $notes = $this->noteRepository->getNote($user_id); 

            require_once("../../view/pages/admin/note/liste.php");
        }

        public function addNote() {            
            $idUser = intval($_SESSION['etdId']);
            $note = intval($_POST['note']);
            $idEval = intval($_POST['evaluation']);

            $userController = new UserController();
            $etudiant = $userController->getById($idUser);
            
            $idEtd = $etudiant['etudiant_id'];

            
            $last = $this->noteRepository->addNote($idEtd, $idEval, $note); 
            header("Location: NoteMainController?getNote=1&id=" . $idUser);
            exit();
        }
    }

?>
