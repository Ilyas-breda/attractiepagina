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
    
    <!-- De hoofdcontainer die de zijbalk en het grid scheidt -->
    <div class="container content flex-layout">
        
        <!-- De linkerzijbalk met de filteropties en het formulier (Visueel behouden) -->
        <aside class="sidebar-filters">
            <form action="" method="GET">
                
                <!-- Filter 1: Themagebied selectie -->
                <div class="filter-group">
                    <select name="themagebied">
                        <option value="">Themagebied...</option>
                        <option value="familyland">Familyland</option>
                        <option value="adventureland">Adventureland</option>
                        <option value="waterland">Waterland</option>
                    </select>
                </div>

                <!-- Filter 2: Fast Pass selectie -->
                <div class="filter-group">
                    <select name="fastpass">
                        <option value="">Fast Pass...</option>
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </div>

                <!-- Filter 3: Zoekbalk met vergrootglas icoon -->
                <div class="filter-group search-box">
                    <input type="text" name="search" placeholder="Zoeken...">
                    <button type="submit" class="search-btn">🔍</button>
                </div>
                
                <div class="filter-group">
                    <a href="index.php" class="clear-filters-btn">Filters wissen</a>
                </div>

            </form>
        </aside>

        <!-- De rechterkant waar de 6 attracties statisch getoond worden -->
        <main class="main-content">
            <div class="attracties">

                <!-- ATTRACTIE 1: CAROUSSEL -->
                <div class="attractie-card">
                    <div class="card-image">
                        <!-- Command: Gebruik normale slashes (/) en de meegegeven alex-kalinin foto -->
                        <img src="img/attracties/alex-kalinin-6gYjwD4s9xk-unsplash.jpg" alt="Caroussel">
                    </div>
                    <div class="card-body">
                        <p class="ride-area">FAMILYLAND</p>
                        <h2 class="ride-title">Caroussel</h2>
                        <p class="ride-description">Voor de allerkleinsten: maak een rondje in de antieke draaimolen.</p>
                        <p class="length">minimale lengte</p>
                    </div>
                </div>

                <!-- ATTRACTIE 2: GOUDVISSEN -->
                <div class="attractie-card">
                    <div class="card-image">
                        <!-- Command: Gekoppeld aan de adger-kang foto uit jouw lijst -->
                        <img src="img/attracties/adger-kang-oiyzr-SgjBY-unsplash.jpg" alt="Goudvissen">
                    </div>
                    <div class="card-body">
                        <p class="ride-area">WATERLAND</p>
                        <h2 class="ride-title">Goudvissen</h2>
                        <p class="ride-description">Alleen open bij mooi weer. U kunt nat worden (of gebeten door een goudvis).</p>
                        <p class="length">90cm minimale lengte</p>
                    </div>
                </div>

                <!-- ATTRACTIE 3: HOUTEN ACHTBAAN -->
                <div class="attractie-card">
                    <div class="card-image">
                        <!-- Command: Gekoppeld aan de brandon-hoogenboom foto -->
                        <img src="img/attracties/brandon-hoogenboom-P0MX2XCqbFc-unsplash.jpg" alt="Houten achtbaan">
                    </div>
                    <div class="card-body">
                        <p class="ride-area">ADVENTURELAND</p>
                        <h2 class="ride-title">Houten achtbaan</h2>
                        <p class="ride-description">De houten achtbaan is gesloten voor renovatie.</p>
                        <p class="length">90cm minimale lengte</p>
                    </div>
                </div>

                <!-- ATTRACTIE 4: IRVIN'S PRESENT -->
                <div class="attractie-card">
                    <div class="card-image">
                        <!-- Command: Gekoppeld aan de david-murcia foto -->
                        <img src="img/attracties/david-murcia-HbYniDwjbVE-unsplash.jpg" alt="Irvin's Present">
                    </div>
                    <div class="card-body">
                        <p class="ride-area">FAMILYLAND</p>
                        <h2 class="ride-title">Irvin's Present</h2>
                        <p class="ride-description">Win de mooiste prizes bij Irvin (en betaal direct 85% administratiekosten).</p>
                        <p class="length">minimale lengte</p>
                    </div>
                </div>

                <!-- ATTRACTIE 5: KINDERACHTBAAN -->
                <div class="attractie-card">
                    <div class="card-image">
                        <!-- Command: Gekoppeld aan de chris-slupski achtbaanfoto -->
                        <img src="img/attracties/chris-slupski-QLqIqIhMiNs-unsplash.jpg" alt="Kinderachtbaan">
                    </div>
                    <div class="card-body">
                        <p class="ride-area">FAMILYLAND</p>
                        <h2 class="ride-title">Kinderachtbaan</h2>
                        <p class="ride-description">Spanning en sensatie speciaal voor de kleintjes.</p>
                        <p class="length">90cm minimale lengte</p>
                    </div>
                </div>

                <!-- ATTRACTIE 6: NITRO -->
                <div class="attractie-card">
                    <div class="card-image">
                        <!-- Command: Gekoppeld aan de frenjamin-benklin foto -->
                        <img src="img/attracties/frenjamin-benklin-fiDVCWI9IUI-unsplash.jpg" alt="Nitro">
                    </div>
                    <div class="card-body">
                        <p class="ride-area">ADVENTURELAND</p>
                        <h2 class="ride-title">Nitro</h2>
                        <p class="ride-description">Nitro is tijdelijk gesloten op last van de politie wegens een ongeval.</p>
                        <p class="length">90cm minimale lengte</p>
                        <!-- Command: Nitro krijgt visueel de groene Fast Pass badge mee -->
                        <div class="badge fast-pass">🎟️ FAST PASS</div>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>

</html>
