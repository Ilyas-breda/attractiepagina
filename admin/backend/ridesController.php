<?php
session_start();
require_once '../backend/config.php';
if(!isset($_SESSION['user_id']))
{
    $msg = "Je moet eerst inloggen!";
    header("Location: $base_url/admin/login.php?msg=$msg");
    exit;
}

$action = $_POST['action'];
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

    $target_dir = "../../img/attracties/";
    $target_file = $_FILES['img_file']['name'];
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

    header("Location: ../admin/attracties/index.php");
    exit;
}

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

    if(empty($_FILES['img_file']['name']))
    {
        $target_file = $_POST['old_img'];
    }
    else
    {
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

    header("Location: ../admin/attracties/index.php");
    exit;
}

if($action == "delete")
{
    $id = $_POST['id'];
    require_once 'conn.php';
    $query = "DELETE FROM rides WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":id" => $id
    ]);
    header("Location: ../admin/attracties/index.php");
    exit;
}
