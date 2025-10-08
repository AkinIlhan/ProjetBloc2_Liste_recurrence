<?php
    require_once(__DIR__ . "/securite/session.php"); // ← Protéger la page par les vérifs de session
    require_once("controller/controller.php");

    if (isset($_GET['action']) && $_GET['action'] == 'create_recurr') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
                echo json_encode(['success' => false, 'message' => 'Jeton CSRF invalide.']);
                exit;
            }
        }
        // Créer une maintenance
        ajouterMaintenance();
    }
    else if (!empty($_GET['update_recurr']) && !empty($_GET['id'])) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
                echo json_encode(['success' => false, 'message' => 'Jeton CSRF invalide.']);
                exit;
            }
        }
        modifierMaintenance();
    }
    else
    {
        accueil();
    }
?>