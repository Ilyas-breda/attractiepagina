<?php
// Start de sessie om inloggegevens te kunnen controleren
session_start();
// Laad het configuratiebestand
require_once '../backend/config.php';
// Command: Controleer of de gebruiker NIET is ingelogd
if(!isset($_SESSION['user_id']))
{
    $msg = "Je moet eerst inloggen!";
    // Stuur de niet-ingelogde bezoeker terug naar de loginpagina
    header("Location: $base_url/admin/login.php?msg=$msg");
    exit;
}

// Kijk welke actie er uitgevoerd moet worden (create, update of delete)
$action = $_POST['action'];
// Command: Als de actie 'create' is (nieuwe attractie aanmaken)
if($action == 'create')
{
    //Validatie
    $title = $_POST['title'];
    if(empty($title))
    {
        $errors[] = "Vul een titel in!";
    }

    $themeland = $_POST['themeland'];
    if(empty($themeland))
    {
        $errors[] = "Vul een themagebied in!";
    }

    // OPDRACHT: Data opvangen van de nieuwe velden
    $description = $_POST['description'];
    $min_length = !empty($_POST['min_length']) ? intval($_POST['min_length']) : null;

    if(isset($_POST['fast_pass']))
    {
        $fast_pass = true;
    }
    else
    {
        $fast_pass = false;
    }

    // Command: Bepaal de map en bestandsnaam voor de afbeelding
    $target_dir = "../../img/attracties/";
    $target_file = $_FILES['img_file']['name'];
    // Controleer of de afbeelding per ongeluk al bestaat in de map
    if(!empty($target_file) && file_exists($target_dir . $target_file))
    {
        $errors[] = "Bestand bestaat al!";
    }

    //Evt. errors dumpen
    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    //Plaats geuploade bestand in map (alleen als er een bestand is gekozen)
    if(!empty($target_file)) {
        move_uploaded_file($_FILES['img_file']['tmp_name'], $target_dir . $target_file);
    }

    //Query - OPDRACHT: Uitgebreid met description en min_length
    // Command: Maak verbinding met de database en voeg de nieuwe rij toe
    require_once 'conn.php';
    $query = "INSERT INTO rides (title, description, themeland, min_length, fast_pass, img_file) VALUES(:title, :description, :themeland, :min_length, :fast_pass, :img_file)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":description" => $description,
        ":themeland" => $themeland,
        ":min_length" => $min_length,
        ":fast_pass" => $fast_pass,
        ":img_file" => $target_file,
    ]);

    // Stuur de gebruiker terug naar het overzicht
    header("Location: ../admin/attracties/index.php");
    exit;
}

// Command: Als de actie 'update' is (bestaande attractie aanpassen)
if($action == "update")
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $themeland = $_POST['themeland'];
    
    // OPDRACHT: Validatie toegevoegd bij het aanpassen van een attractie
    if(empty($title))
    {
        $errors[] = "Vul een titel in!";
    }
    if(empty($themeland))
    {
        $errors[] = "Vul een themagebied in!";
    }

    // OPDRACHT: Data opvangen van de nieuwe velden
    $description = $_POST['description'];
    $min_length = !empty($_POST['min_length']) ? intval($_POST['min_length']) : null;

    if(isset($_POST['fast_pass']))
    {
        $fast_pass = true;
    }
    else
    {
        $fast_pass = false;
    }

    // Command: Controleer of er GEEN nieuwe afbeelding is gekozen
    if(empty($_FILES['img_file']['name']))
    {
        // Behoud de oude afbeelding die al in de database stond
        $target_file = $_POST['old_img'];
    }
    else
    {
        // Er is wel een nieuwe afbeelding gekozen, sla deze op
        $target_dir = "../../img/attracties/";
        $target_file = $_FILES['img_file']['name'];
        if(file_exists($target_dir . $target_file))
        {
            $errors[] = "Bestand bestaat al!";
        }

        //Plaats geuploade bestand in map
        move_uploaded_file($_FILES['img_file']['tmp_name'], $target_dir . $target_file);
    }

    // FIX: Zorgt ervoor dat de validatiefouten bij het aanpassen ook echt getoond worden en het script stopt
    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    //Query - OPDRACHT: Uitgebreid met description en min_length
    // Command: Werk de gegevens van de attractie bij in de database
    require_once 'conn.php';
    $query = "UPDATE rides SET title = :title, description = :description, themeland = :themeland, min_length = :min_length, fast_pass = :fast_pass, img_file = :img_file WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":title" => $title,
        ":description" => $description,
        ":themeland" => $themeland,
        ":min_length" => $min_length,
        ":fast_pass" => $fast_pass,
        ":img_file" => $target_file,
        ":id" => $id
    ]);

    // Stuur de gebruiker terug naar het overzicht
    header("Location: ../admin/attracties/index.php");
    exit;
}

// Command: Als de actie 'delete' is (attractie verwijderen)
if($action == "delete")
{
    $id = $_POST['id'];
    // Command: Verwijder de geselecteerde attractie op basis van het ID
    require_once 'conn.php';
    $query = "DELETE FROM rides WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":id" => $id
    ]);
    // Stuur de gebruiker terug naar het overzicht
    header("Location: ../admin/attracties/index.php");
    exit;
}
