<?php
session_start();
require_once 'admin/backend/config.php';
?>

<!doctype html>
<html lang="nl">

<head>
    <title>Attractiepagina</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/main.css">
    <link rel="icon" href="<?php echo $base_url; ?>/favicon.ico" type="image/x-icon" />
</head>

<body>

    <?php require_once 'header.php'; ?>
    <div class="container content">
        <aside>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia modi dolore magnam! Iste libero voluptatum autem, sapiente ullam earum nostrum sed magnam vel laboriosam quibusdam, officia, esse vitae dignissimos nulla?
        </aside>
        <main>
            <div class="attracties">
                <?php
                require_once 'admin/backend/conn.php';
                $query = "SELECT * FROM rides ORDER BY title";
                $statement = $conn->prepare($query);
                $statement->execute();
                $rides = $statement->fetchAll(PDO::FETCH_ASSOC);
                
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
