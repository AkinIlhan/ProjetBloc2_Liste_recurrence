<?php
require_once(__DIR__ . '/../modele/ModeleDB.php'); // à adapter à ton arborescence

// Vérifie si le formulaire est soumis

function login($username) {
    $password = "password"; // Pour l'instant en dur
    
    if (empty($username) || empty($password)) {
        echo "Nom d'utilisateur ou mot de passe manquant.";
        exit;
    }
    
    $db = new Database();
    $pdo = $db->getConnection();
    
    $stmt = $pdo->prepare("SELECT id_utilisateur, nom_utilisateur, mdp_utilisateur, id_role FROM utilisateur WHERE nom_utilisateur = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        echo "Aucun utilisateur trouvé.";
        exit();
    }
    
    // Vérification du mot de passe
    /*
    if (!password_verify($password, $user['mdp_utilisateur'])) {
        echo "Mot de passe invalide.";
        exit();
    }
    */
    
    // Vérifie que l'utilisateur correspond bien
    if ($user['nom_utilisateur'] !== $username) {
        echo "Nom d'utilisateur inconnu.";
        exit();
    }
    
    // Crée la session
    $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
    $_SESSION['id_role'] = $user['id_role'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
     return true;
}

?>
