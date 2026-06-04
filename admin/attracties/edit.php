<?php
// Start de sessie voor het controleren van de inlogstatus
session_start();
// Laad het configuratiebestand
require_once '../backend/config.php';
// Command: Controleer of de gebruiker NIET is ingelogd
if(!isset($_SESSION['user_id']))
{
    $msg = "Je moet eerst inloggen!";
    // Stuur de gebruiker direct terug naar het loginscherm
    header("Location: $base_url/admin/login.php?msg=$msg");
    exit;
}
?>

<!doctype html>
<html lang="nl">

<head>
    <title>Attractiepagina / Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/main.css">
    <link rel="icon" href="<?php echo $base_url; ?>/favicon.ico" type="image/x-icon" />
</head>

<body>

    <?php // Laad de header in uit de mappenstructuur hierboven 
    require_once '../../header.php'; ?>
    <div class="container">

        <h2>Attractie aanpassen</h2>

        <?php 
        // Command: Haal het ID van de attractie op uit de URL (bijv. edit.php?id=5)
        $id = $_GET['id'];
        // Maak verbinding met de database
        require_once '../backend/conn.php';
        // Command: Zoek de specifieke attractie op basis van het ID
        $query = "SELECT * FROM rides WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->execute([":id" => $id]);
        $ride = $statement->fetch(PDO::FETCH_ASSOC);
        ?>

        <!-- FIX: enctype="multipart/form-data" toegevoegd zodat de file-upload (afbeelding) werkt -->
        <!-- Command: Formulier voor het bijwerken van de attractiegegevens -->
        <form action="../backend/ridesController.php" method="POST" enctype="multipart/form-data">
            <!-- Onzichtbare invoervelden om de actie, het ID en de oude afbeelding mee te sturen -->
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="old_img" value="<?php echo $ride['img_file']; ?>">

            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" name="title" id="title" class="form-input" value="<?php echo htmlentities($ride['title']); ?>">
            </div>
            
            <!-- OPDRACHT: Beschrijving (description) toegevoegd -->
            <div class="form-group">
                <label for="description">Beschrijving:</label>
                <textarea name="description" id="description" class="form-input" rows="5"><?php echo htmlentities($ride['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="themeland">Themagebied:</label>
                <!-- Command: Selecteer automatisch de juiste optie die in de database staat via een if-check -->
                <select name="themeland" id="themeland" class="form-input">
                    <option value=""> - kies een optie - </option>
                    <option value="familyland" <?php if($ride['themeland'] == 'familyland') echo 'selected'; ?>>Familyland</option>
                    <option value="waterland" <?php if($ride['themeland'] == 'waterland') echo 'selected'; ?>>Waterland</option>
                    <option value="adventureland" <?php if($ride['themeland'] == 'adventureland') echo 'selected'; ?>>Adventureland</option>
                </select>
            </div>

            <!-- OPDRACHT: Minimale lengte (min_length) toegevoegd -->
            <div class="form-group">
                <label for="min_length">Minimale lengte (in cm):</label>
                <input type="number" name="min_length" id="min_length" class="form-input" min="0" value="<?php echo htmlentities($ride['min_length']); ?>">
            </div>

            <div class="form-group">
                <label for="img_file">Afbeelding:</label>
                <!-- Command: Toon een kleine voorvertoning van de huidige afbeelding -->
                <img src="<?php echo $base_url . "/img/attracties/" . $ride['img_file']; ?>" alt="attractiefoto" style="max-width: 120px; display: block; margin-bottom: 10px;">
                <input type="file" name="img_file" id="img_file" class="form-input">
            </div>
            <div class="form-group">
                <label for="fast_pass">FAST PASS:</label>
                <!-- Command: Vink het selectievakje aan als fast_pass in de database de waarde 1 (true) heeft -->
                <input type="checkbox" name="fast_pass" id="fast_pass" value="1" <?php if($ride['fast_pass']) echo 'checked'; ?>>
                <label for="fast_pass">Voor deze attractie is een FAST PASS nodig.</label>
            </div>

            <!-- Knop om de wijzigingen op te slaan -->
            <input type="submit" value="Attracties aanpassen">
        </form>
        <hr>
        <!-- Command: Apart formulier om deze specifieke attractie volledig te verwijderen -->
        <form action="../backend/ridesController.php" method="POST">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Verwijderen">
        </form>

    </div>

</body>

</html>
