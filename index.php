<?php
// Start de gebruikerssessie
session_start();
// Haal de configuratiebestanden op
require_once 'admin/backend/config.php';
?>

<!doctype html>
<html lang="nl">

<head>
    <title>Attractiepagina</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://gstatic.com">
    <link href="https://googleapis.com" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/main.css">
    <link rel="icon" href="<?php echo $base_url; ?>/favicon.ico" type="image/x-icon" />
</head>

<body>

    <?php // Laad de menubalk/header in 
    require_once 'header.php'; ?>
    <div class="container content">
        <aside>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia modi dolore magnam! Iste libero voluptatum autem, sapiente ullam earum nostrum sed magnam vel laboriosam quibusdam, officia, esse vitae dignissimos nulla?
        </aside>
        <main>
            <div class="attracties">
                <?php
                // Maak verbinding met de database
                require_once 'admin/backend/conn.php';
                // SQL-opdracht: Selecteer alle attracties gesorteerd op titel
                $query = "SELECT * FROM rides ORDER BY title";
                // Bereid de SQL-opdracht voor veiligheid voor
                $statement = $conn->prepare($query);
                // Voer de SQL-opdracht uit
                $statement->execute();
                // Haal alle resultaten op als een lijst/array
                $rides = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                // Loop door elke attractie heen en toon deze op het scherm
                foreach($rides as $ride){
                ?>
                <div class="attractie">
                    <img src="img\attracties\laurie-byrne-EtKSaG-PRbY-unsplash.jpg" alt="Achtbaan met looping">
                    <h3> Rustige Attractie </h3>
                    <h2> Looping </h2>
                    <p> Hier staat tekst over de attractie.</p>
                    <p class="length">1cm</p>
                </div>   
                <?php  
                }  
                ?>     
            </div>
        </main>
    </div>

</body>

</html>
