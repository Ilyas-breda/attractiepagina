<?php
// Start de sessie voor het controleren van de inlogstatus
session_start();
// Laad het configuratiebestand
require_once '../backend/config.php';
// Command: Controleer of de gebruiker NIET is ingelogd
if(!isset($_SESSION['user_id']))
{
    $msg = "Je moet eerst inloggen!";
    // Stuur de bezoeker direct terug naar het loginscherm
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

        <h2>Nieuwe attractie</h2>

        <!-- Command: Formulier voor het aanmaken van een nieuwe attractie inclusief afbeeldingen via multipart/form-data -->
        <form action="../backend/ridesController.php" method="POST" enctype="multipart/form-data">
            <!-- Onzichtbaar veld om aan de controller te vertellen dat we een nieuwe rij willen maken -->
            <input type="hidden" name="action" value="create">
        
            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" name="title" id="title" class="form-input">
            </div>

            <!-- OPDRACHT: Beschrijving (description) toegevoegd -->
            <div class="form-group">
                <label for="description">Beschrijving:</label>
                <textarea name="description" id="description" class="form-input" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="themeland">Themagebied:</label>
                <select name="themeland" id="themeland" class="form-input">
                    <option value=""> - kies een optie - </option>
                    <option value="familyland">Familyland</option>
                    <option value="waterland">Waterland</option>
                    <option value="adventureland">Adventureland</option>
                </select>
            </div>

            <!-- OPDRACHT: Minimale lengte (min_length) toegevoegd -->
            <div class="form-group">
                <label for="min_length">Minimale lengte (in cm):</label>
                <input type="number" name="min_length" id="min_length" class="form-input" min="0">
            </div>

            <div class="form-group">
                <label for="img_file">Afbeelding:</label>
                <!-- Input voor het uploaden van een fotobestand -->
                <input type="file" name="img_file" id="img_file" class="form-input">
            </div>
            <div class="form-group">
                <label for="fast_pass">FAST PASS:</label>
                <!-- Selectievakje voor de Fast Pass status -->
                <input type="checkbox" name="fast_pass" id="fast_pass" value="1">
                <label for="fast_pass">Voor deze attractie is een FAST PASS nodig.</label>
            </div>

            <!-- Knop om het formulier definitief te verzenden -->
            <input type="submit" value="Attractie aanmaken">
        </form>

    </div>

</body>

</html>
