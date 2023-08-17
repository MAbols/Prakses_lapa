<?php
// index.php
session_start();

require 'vendor/autoload.php'; // Include the Fat-Free Framework autoload file
$f3 = Base::instance();

//$f3->set('BASE', $f3->get('SCHEME') . '://' . $f3->get('HOST') . $f3->get('BASE'));
//$f3->set('BASE', '/');


$f3->set('DB', new DB\SQL(
    'mysql:host=127.0.0.1;dbname=my_patient_db',
    'root',
    ''
));

// Check if the user is logged in
if (!isset($_SESSION['username']) && $f3->get('PATH') !== '/login') {
    // Redirect to the login page if not logged in and not already on the login page
    $f3->reroute('/login');
}

// Define the routes in the routes.ini file
$f3->config('controllers/config/routes.cfg');
// Configure error reporting and display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
$f3->set('LOGS', 'logs/');
$f3->set('DEBUG', 3);

$f3->run();
