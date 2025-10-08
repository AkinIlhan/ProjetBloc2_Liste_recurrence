<?php
require_once(__DIR__ .'/../securite/session.php'); // Pour que la session soit démarrée et que le token soit généré
$token = generateCsrfToken();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_maintenance.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <title>Liste de maintenance</title>
</head>
<script src="JavaScript/script.js" defer></script>
<body>
    <h1 class="titre">Liste des maintenances</h1>

    <form method="post" action="index.php">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
        <div class="container-recurr">
            <table class="tbl-qa-recurr">
                <thead>
                    <tr class="table-row">
                        <th class="table-header" width="20%">Maintenance à planifier</th>
                        <th class="table-header" width="20%">Date d'anniversaire</th>

                        <!-- Filtre Site -->
                        <th class="table-header" width="20%">Site
                            <div class="dropdown"  id="dropdownFilter">
                                <button type="button" class="filter-btn" id="filterBtn">Filtrer</button>
                                <div class="dropdown-content" id="siteFilterMenu">
                                    <label>
                                        Tous
                                        <input type="checkbox" id="select_all_sites" class="site-filter" value="Tous" checked>
                                    </label>
                                    <?php
                                        $uniqueSites = [];
                                        foreach ($result as $row) {
                                            if (!isset($uniqueSites[$row['id_site']])) {
                                                $uniqueSites[$row['id_site']] = $row['nom_site'];
                                            }
                                        }
                                        foreach ($uniqueSites as $id => $nom):
                                    ?>
                                        <label>
                                            <?= htmlspecialchars($nom) ?>
                                            <input type="checkbox"
                                                class="site-filter"
                                                value="<?= htmlspecialchars($id) ?>"
                                                checked>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </th>
                        <th class="table-header" width="20%">Bâtiment
                        </th>
                        <th class="table-header" width="20%"></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    if (!empty($result)) {
                        foreach ($result as $row): ?>
                            <tr class="table-row" data-site="<?= htmlspecialchars($row['id_site'])?>">
                                <td><?= htmlspecialchars($row["sujet_reccurrence"]) ?></td>
                                <td><?= date('d/m/Y', strtotime($row["date_anniv_recurrence"])) ?></td>
                                <td><?= htmlspecialchars($row["nom_site"]) ?></td>
                                <td><?= htmlspecialchars($row["nom_batiment"]) ?></td>
                                <td>
                                    <a class="modif_recurr" href="index.php?update_recurr=1&id=<?= $row['id_recurrence'] ?>">Modifier</a>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container">
            <a href="index.php?action=create_recurr" class="add_recurr">Ajouter</a>
        </div>
    </form>
</body>
</html>
