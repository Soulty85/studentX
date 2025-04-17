<?php 
if(!$_SESSION["email"]){
    header(
        "Location:login?error=1&message=" 
        . urlencode($message) . 
        "&title=" . urlencode($title) 
    );
}
    require_once("UserController.php");
    
    // creation d'un objet UserController
    $userController = new UserController();
    
    // Authetification
    if (isset($_POST['formLogin'])) {
        // appel de la methode auth
        $userController->auth(); 
    }
    
    // Deconnexion
    if (isset($_GET['logout'])) {
        // appel de la methode logout
        $userController->logout(); 
    }
    
    // Enregistrement
    if (isset($_POST['formUser'])) {
        // appel de la methode register
        $userController->register(); 
    }

    // Modification
    if (isset($_POST['updateStudent'])) {
        // appel de la methode update
        $userController->updateStudent(); 
    }

    // Suppression
    if (isset($_POST['deleteStudent'])) {
        // appel de la methode delete
        $userController->deleteStudent(); 
    }
    
    // Affichage
    if (isset($_GET['page']) ) {
        // appel de la methode getAllStudent
        $userController->getAllStudent();
    }

?>