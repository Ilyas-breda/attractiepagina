<?php
// Start de sessie voor het inloggen
session_start();
// Laad het configuratiebestand
require_once 'backend/config.php';
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

    <?php // Laad de header in uit de map erboven 
    require_once '../header.php'; ?>
    <div class="container">

        <?php
        // Command: Controleer of er een melding (zoals een foutmelding) in de URL staat
        if(isset($_GET['msg']))
        {
            // Command: Toon de melding op het scherm in een div-blok
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
        ?>

        <!-- Command: Formulier stuurt de logingegevens veilig via POST naar de loginController -->
        <form action="backend/loginController.php" method="POST">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" id="username" placeholder="user1 t/m 3">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password" placeholder="pass1 t/m 3">
            </div>
            <!-- Inlogknop om het formulier te verzenden -->
            <input type="submit" value="Login">
        </form>
    </div>

</body>

</html>
