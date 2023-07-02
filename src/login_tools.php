<!-- File to handle the login form, validating the login input 
and loading a new page if successful--> 

    <?php 

        // Load the page login.php
        function load($page = 'login.php'){

            // Build a URL, string of protocol, current domain and directory
            $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

            // Remove any trailing slashes from the URL
            $url = rtrim($url, '/\\');

            // Append page name to URL
            $url .= '/'.$page;

            // Insert the statement load, redirecting
            header("Location: $url");

            // Quit
            exit();
        }
        
        // Validate form fields (ensure they are not empty and seek input values in 'users' table)
        function validate($link, $email ='', $pwd =''){

            // Initialise an array for error messages
            $errors = array();

            // If email field empty
            if (empty($email)){

                // ask for input
                $errors[] = 'Enter your email address.';

            // If email field not empty
            } else {

                // store input in a variable
                $e = mysqli_real_escape_string($link, trim($email));
            }

            // If password field empty 
            if (empty($pwd)){

                // ask for input
                $errors[] = 'Enter your password.';
            
            // If password field not empty
            } else {

                // store input in a variable
                $p = mysqli_real_escape_string($link, trim($pwd));
            }

            // If there were no errors 
            if (empty($errors)){
                
                // return assiciated user_id, first_name and last_name to the caller
                $q = "SELECT user_id, first_name, last_name FROM users WHERE email=$e AND pass=$p";
                $r = mysqli_query ($link, $q);
                print($r->fetch_row()[0]);
                //if (mysqli_num_rows($r) == 1){
                //    $row = mysqli_fetch_array($r, MYSQLI_NUM);
                //    return array(true, $row);

                // If email and password NOT found in 'users'
                //} else 
                {

                    // Display error message
                    $errors[] = 'Email address and password not found.';
                }
            }

            // Statement to return list of errors
            return array(false, $errors);
        }

    //IT IS IMPORTANT NOT TO CLOSE THIS PHP SCRIPT