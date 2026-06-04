<?php
// Start de sessie zodat PHP weet welke sessie vernietigd moet worden
session_start();

// Maak alle sessievariabelen leeg
session_unset();

// Vernietig de sessie volledig
session_destroy();

// Stuur de gebruiker door naar de loginpagina (of verander dit naar index.php als dat moet van je docent)
header("Location: login.php");
exit;
