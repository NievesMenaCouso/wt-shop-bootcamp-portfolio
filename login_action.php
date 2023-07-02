<!-- File to process login attempt, 
setting information retrieved from database if login succeeds
and allowing the user to be recognised as they navigate from page to page -->

<?php

    // If the login form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Open database connection
        require('connect_db.php');

        // Make login tools available (get connection, load and validate functions)
        require('login_tools.php');
        
        // Ensure login succeeded and retrieve the associated user details
        list($check, $data) = validate($link, $_POST['email'], $_POST['pass']);
    
        // On success, set the user details as session data and load the home page
        if ($check){
            session_start();
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['first_name'] = $data['first_name'];
            $_SESSION['last_name'] = $data['last_name'];
            load('home.php');
            print("hello5");
        // Or on failure set errors
        } else { 
            $errors = $data;
            print($errors);
        }
        
        // Close the database connection and continue to display login page if login attempt fails
        mysqli_close($link);
        print("hello7");
    }
    
    // Continue to display login page on failure
    include('login.php');
    
?>
