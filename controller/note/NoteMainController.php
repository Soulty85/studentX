<?php 
    session_start();
    require_once("NoteController.php");

    $noteController = new NoteController();
    
    if (isset($_POST['addNote'])) {
        $noteController->addNote();
        exit(); 
    }

    if (isset($_POST['updateNote'])) {
        $noteController->updateNote();
        exit(); 
    }

    
    if (isset($_GET['getNote'])) {
        $user_id = $_GET['id'] ?? $_SESSION['etdId'] ?? null; 
        
        if (!$user_id) {
            die("Erreur : Aucun étudiant sélectionné.");
        }

        $_SESSION['etdId'] = $user_id; 

        
        $noteController->getNote();
    }
?>
