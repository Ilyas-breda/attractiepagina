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

        <!-- Link naar de pagina om een nieuwe attractie toe te voegen -->
        <a href="create.php">Nieuwe attractie maken &gt;</a>

        <?php
        // Maak verbinding met de database
        require_once '../backend/conn.php';
        
        // OPDRACHT: Sorteren op titel toegevoegd (ORDER BY title ASC)
        // Command: Haal alle attracties op uit de database en sorteer ze alfabetisch op titel
        $query = "SELECT * FROM rides ORDER BY title ASC";
        $statement = $conn->prepare($query);
        $statement->execute();
        $rides = $statement->fetchAll(PDO::FETCH_ASSOC);

        // OPDRACHT: Tel het aantal attracties voor de teller
        // Command: Tel hoeveel rijen (attracties) er in de array zitten
        $aantal_attracties = count($rides);
        ?>

        <!-- OPDRACHT: Teller bovenaan de tabel geplaatst -->
        <!-- Command: Toon het totale aantal getelde attracties op het scherm -->
        <p><strong>De lijst bevat <?php echo $aantal_attracties; ?> attracties.</strong></p>

        <table>
            <tr>
                <th>Titel</th>
                <th>Themagebied</th>
                <th>Min. lengte</th>
                <th>Fastpass</th>
                <th>Acties</th>
            </tr>
            <?php // Command: Start een loop om elke attractie als een rij in de tabel te tonen ?>
            <?php foreach($rides as $ride): ?>
                <tr>
                    <td><?php echo htmlentities($ride['title']); ?></td>
                    
                    <!-- AANPASSING: Eerste letter een hoofdletter via ucfirst() -->
                    <td class="themagebied"><?php echo htmlentities(ucfirst($ride['themeland'])); ?></td>
                    
                    <!-- AANPASSING: Eenheid cm erachter geplakt (als er een lengte is ingevuld) -->
                    <td class="lengte">
                        <?php 
                        // Command: Controleer of er een minimale lengte is ingevuld
                        if(!empty($ride['min_length'])) {
                            echo htmlentities($ride['min_length']) . " cm"; 
                        } else {
                            echo "-";
                        }
                        ?>
                    </td>
                    
                    <!-- AANPASSING: 1 of 0 omzetten naar Ja of Nee -->
                    <!-- Command: Als fast_pass gelijk is aan 1 toon 'Ja', anders toon 'Nee' -->
                    <td><?php echo ($ride['fast_pass'] == 1) ? 'Ja' : 'Nee'; ?></td>
                    
                    <!-- Link om de specifieke attractie aan te passen op basis van het ID -->
                    <td><a href="edit.php?id=<?php echo $ride['id']; ?>">aanpassen</a></td>
                </tr>
            <?php endforeach; ?>
        </table>


    </div>

</body>

</html>
