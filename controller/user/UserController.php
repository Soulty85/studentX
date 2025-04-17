<?php 
    session_start();
    require_once("../../model/UserRepository.php");

    class UserController
    {
        private $userRepository;
        
        public function __construct()
        {
            $this->userRepository = new UserRepository();
        }
        
        // Permet de valider le formulaire de connexion
        private function validateLoginField($email, $password)
        {
            if (empty($email) || empty($password)) {
                return "Tous les champs sont requis.";
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Email invalide.";
            }
            
            if (strlen($password) < 8) {
                return "Le mot de passe doit conteneir au moins 8 caractères.";
            }
        }
        
        // Permet de retourner un message d'erreur
        private function setErrorAndRedirect($message, $title, $redirectUrl = 'login')
        {
            $_SESSION["error"] = $message;
            header(
                "Location:$redirectUrl?error=1&message=" 
                . urlencode($message) . 
                "&title=" . urlencode($title) 
            );
            exit;
        }
        
        // Permet de retourner un message de success
        private function setSuccessAndRedirect($message, $title, $redirectUrl = 'admin')
        {
            $_SESSION["success"] = $message;
            header(
                "Location:$redirectUrl?success=1&message=" 
                . urlencode($message) . 
                "&title=" . urlencode($title) 
            );
            exit;
        }
        
        // Permet de connecter un super admin
        private function authSuperAdmin($email, $password)
        {
            if ($email == "admin@gmail.com" && $password == "Passer123") {
                $_SESSION["id"] = 1;
                $_SESSION["nom"] = "User Random";
                $_SESSION["email"] = $email;
                $_SESSION["etat"] = 1;
                $_SESSION["photo"] = "default.png";
                
                $this->setSuccessAndRedirect(
                    "Bienvenue sur le dashboard", 
                    "Connexion Réussie"
                );
            }
            return false;
        }
        
        // Permet d'authentifier un admin
        private function authAdmin($email, $password, $userRepository)
        {
            $user = $userRepository->login($email, $password);
            
            if ($user && $user["etat"] == 1) { //si user existe et activé
                $_SESSION["id"] = $user["id"];
                $_SESSION["nom"] = $user["nom"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["etat"] = $user["etat"];
                
                $this->setSuccessAndRedirect(
                    "Bienvenue sur le dashboard admin", 
                    "Connexion Réussie"
                );
            }
            else if(!$user) //si user n'existe pas
            {
                $this->setErrorAndRedirect(
                    "Email ou mot de passe incorrecte.", 
                    "Accès non autorisé."
                );
            }
            else
            {
                $this->setErrorAndRedirect(
                    "Votre compte à été désactivé par le super admin.", 
                    "Accès interdit."
                );
            }
        }
        
        public function auth()
        {
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $email=$_POST["email"];
                $password=$_POST["password"];
                
                //Validation des champs du formulaire de connexion
                $messageError=$this->validateLoginField($email,$password);
                
                if($messageError){
                    $this->setErrorAndRedirect($messageError,"Erreur de validation");
                }
                
                //Authentifie le super administrateur 
                if($this->authSuperAdmin($email,$password)){
                    return;
                }
                
                //Authentifie un admin
                $this->authAdmin($email,$password,$this->userRepository);
            }
        }
        
        //Permet de deconnecter un utilisateur
        public function logout(){
            session_unset();
            session_destroy();
            
            $this->setErrorAndRedirect(
                "Vous avez ete deconnecte avec succes",
                "Deconnexion reussi",
                "home"
            );
        }

        public function register(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $password = 'Etudiant123';
                $role = $_POST['role'];
                $createdBy = $_SESSION["id"];
                $userId = $this->userRepository->register($prenom, $nom, $email, $password, $role);
                if ($role === "Etudiant") {
                    $matricule = $_POST['matricule'];
                    $telephone = $_POST['telephone'];
                    $adresse = $_POST['adresse'];
                    
                    $this->userRepository->registerStudent($userId, $matricule, $telephone, $adresse, $createdBy);
                    $this->getAllStudent();
                }
                
            }
        }

        public function getAllStudent() {
            $etudiants = $this->userRepository->getAllStudent(1);
            require_once('../../view/pages/admin/user/liste.php');
        }

        public function getById($id) {
            $etudiants = $this->userRepository->getById($id);
            return $etudiants;
        }
        
        public function updateStudent() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = (int) $_POST['id'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $updatedBy = $_SESSION["id"];
                $matricule = $_POST['matricule'];
                $telephone = $_POST['tel'];
                $adresse = $_POST['adresse'];
                
                $this->userRepository->updateStudent($id, $prenom, $nom, $email,$matricule, $telephone, $adresse, $updatedBy);
                $this->getAllStudent();
            }
        }

        public function deleteStudent() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST["id"];
                
                $this->userRepository->desactivate($id);
                $this->getAllStudent();
            }
        }
    }
?>