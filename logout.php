<!-- File to clear and close any open session --> 
    
    <?php

        // Access session
        session_start();
        
        // Check whether session variable is already set or not, redirect if not
        if (!isset($_SESSION['user_id'])){
            require('login_tools.php');
            load();
        }

        // Set page title and display header section
        include('includes/nav.php');

        // Clear any existing variables
        $_SESSION = array();

        // End and close the session, leaving a message to the user
        session_destroy();

        // Display body section
        echo '
            <h1>Goodbye!</h1>
            <p>You are now logged out</p>
            <a href="img/bye.jpg">';
        
        // Display footer section
        include('includes/footer.html');

    ?>
