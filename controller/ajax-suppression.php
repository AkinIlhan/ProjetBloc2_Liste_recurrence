<?php
require(__DIR__ . '/../modele/demande.php');
require_once(__DIR__ .'/../securite/session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    
    // Vérifie le token CSRF
    if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
        echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
        exit;
    }

    try{
        $db = new Database();  // mets true si tu veux utiliser la base de test
        $recurrenceModel = new RecurrenceModel($db->getConnection());
    
        $result = $recurrenceModel->delete($id);
    
        echo json_encode([
            'success' => $result["success"],
            'message' => $result["message"]
        ]);
    }catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur serveur : ' . $e->getMessage()]);
    }
}