<?php
// Start de sessie
session_start();

// Vernietig de sessie en alle sessievariabelen
session_unset(); // Verwijdert alle sessievariabelen
session_destroy(); // Vernietigt de sessie

// Stuur de gebruiker terug naar de inlogpagina
header('Location: login.php');
exit;
