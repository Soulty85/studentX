<?php
if(!$_SESSION["email"]){
    header(
        "Location:login?error=1&message=" 
        . urlencode($message) . 
        "&title=" . urlencode($title) 
    );
}
    require_once("EvaluationController.php");
    $evaluationController = new EvaluationController();
    
    //
    if (isset($_POST['addEval'])) {
        $evaluationController->addEvaluation();
    }

    //
    if (isset($_POST['updateEval'])) {
        $evaluationController->updateEvaluation();
    }

    //
    if (isset($_POST['deleteEval'])) {
        $evaluationController->deleteEvaluation();
    }

    //
    if (isset($_GET['page'])) {
        $evaluationController->getAllEvalAndRedirect();
    }

?>
