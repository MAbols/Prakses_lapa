<?php
// controllers/AuthController.php

class AuthController
{
    public function login($f3)
    {
        
        // Code to display the login page
        $f3->set('pageTitle', 'Login'); // Set page title for the template

        // Render the login.html template directly
        echo View::instance()->render('views/login.html');
        
    }

    public function processLogin($f3)
    {
        // Code to handle the login form submission
        $username = $f3->get('POST.username');
        $password = $f3->get('POST.password');

        // Replace this with the hardcoded password you want to use for testing
        // $validUsername = 'admin';
        // $validPassword = 'password';

        $db = $f3->get('DB');
        $user = $db->exec('SELECT * FROM users WHERE username = ?', $username);


        if ($user) {
            // Verify the password using password_verify() function (assuming passwords are hashed in the database)
            if (password_verify($password, $user[0]['password'])) {
                // Authentication successful, store user data in session
                $_SESSION['username'] = $username;
                $_SESSION['doctor_id']=$user[0]['id'];

                // Redirect to the home page after successful login
                $f3->reroute('/');
            } else {
                // Authentication failed, redirect back to the login page with an error message
                $f3->reroute('/login?error=InvalidCredentials');
                echo "Nepareiza parole";
            }
        } else {
            // Authentication failed, redirect back to the login page with an error message
            $f3->reroute('/login?error=InvalidCredentials');
            echo "Nav atrasts šāds lietotājs";
        }
    }

    public function registration($f3)
    {
        // Code to display the registration page
        $f3->set('pageTitle', 'Registration'); // Set page title for the template
        echo View::instance()->render('views/registration.html');
    }

    public function processRegistration($f3)
    {
        // Code to handle the registration form submission
        $username = $f3->get('POST.username');
        $password = $f3->get('POST.password');

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Save the user to the database (assuming you have already established the DB connection)
        $db = $f3->get('DB');
        $db->exec('INSERT INTO users (username, password) VALUES (?, ?)', array($username, $hashedPassword));


        // Optionally, you can redirect the user to a success page or log them in after registration
        $f3->reroute('/');
    }
}
