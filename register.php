<!-- PHP script for registration starts-->
    <?php
    
        // Include the navigation for the page
        include('includes/nav.html');
        
        // If the form has been submitted...
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            
            // Connect to the database
            require('connect_db.php');
            
            // Initialise an array for error messages
            $errors = array();
                
                // Has the user filled up every imput field?

                    // If first name not found
                    if (empty($_POST['first_name'])){
                        
                        // ask for first name
                        $errors[] = 'Enter your first name.';
                        
                    // If last name found
                    } else {
                        
                        // store its value in a variable
                        $fn = mysqli_real_escape_string($link, trim($_POST['first_name']));
                    }

                    // If last name not found
                    if (empty($_POST['last_name'])){

                        // ask for it
                        $errors[] = 'Enter your last name.';

                    // If last name found
                    } else {

                        // store its value in a variable
                        $ln = mysqli_real_escape_string($link, trim($_POST['last_name']));
                    }

                    // If email not found
                    if (empty($_POST['email'])){

                        // ask for it
                        $errors[] = 'Enter your email address.';

                    // If email found 
                    } else {

                        // store its value in a variable
                        $e = mysqli_real_escape_string($link, trim($_POST['email']));
                    }

                // Do pass 1 and 2 match?

                    // If pass1 has been submitted 
                    if (!empty($_POST['pass'])){ 

                        // and it doesn't match with pass2
                        if ($_POST['pass'] != $_POST['pass2']){

                            // display error message
                            $errors[] = 'Passwords do not match.';

                        } else {
                            // If they do match, store their value in a variable
                            $p = mysqli_real_escape_string($link,trim($_POST['pass']));
                        }
                    }
                
                // Is the email entered already registered?

                    // If email address already registered
                    if (empty($errors)){
                        $q = "SELECT user_id FROM user WHERE email = $e";
                        $r = mysqli_query($link, $q);
                        print($r);
                        // Error message asking to sign in
                        if (mysqli_num_rows($r) != 0) $errors[] = '
                        Email address already registered. 
                        <a class="alert-link" href="login.php">Sign In Now</a>';
                    }

        // Report errors if any
        
            // If there were no errors registering
            if (empty($errors)){
                
                // store the data in the database 'users'
                $q = "INSERT INTO user (first_name, last_name, email, pass, reg_date) VALUES ($fn, $ln, $e, $p, NOW())";
                $r = mysqli_query($link, $q);

                if ($r){
                    print('hello3');
                    // display a confirmation 
                    echo '
                        <div class="container">
                            <div class="alert alert-secondary" role="alert>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="alert-heading">Registered!</h4>
                                <p>You are now registered. Please, login.</p>
                            <a class="alert-link" href="login.php">Login</a>';
                }

                // and close the database connection
                mysqli_close($link);
                exit();

            // If there were errors registering
            } else { 
                print('hello4');

                // display the errors stored with some HTML
                echo '
                    <div class="container">
                        <div class="alert alert-secondary" role="alert>
                            <button type="button" class="close" data-dismiss="alert" >
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">The following errors occurred:</h4>';
                foreach($errors as $msg){
                    echo " - $msg<br>";
                }

                // ask to try again
                echo '<p>Please try again.</p></div>';

                // and close the connection
                mysqli_close($link);
            }
        }
        
    ?>
<!-- PHP script for registration ends--> 


<!-- HTML Register Form starts--> 
    <div class="row">
        <div class="col-sm">
            <h2>Register</h2>
            <div class="card bg-light mb-3" style="margin-top: 3%; width:50%">
                <div class="card-body">
                    <form action="register.php" method="post">
                    <!-- First Name input field starts --> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input 
                                        type="text" 
                                        name="first_name" 
                                        class="form-control"
                                        placeholder="*First Name" 
                                        required
                                        value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"
                                    >
                                </div>
                            </div>
                        </div> 
                    <!-- First Name input field ends --> 
                    <!-- Last Name input field starts --> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input 
                                        type="text" 
                                        name="last_name" 
                                        class="form-control"
                                        placeholder="*Last Name" 
                                        required
                                        value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"
                                    >
                                </div>
                            </div>
                        </div> 
                    <!-- Last Name input field ends -->
                    <!-- Email input field starts -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Email</label>            
                                    <input 
                                        type="email" 
                                        name="email" 
                                        class="form-control"
                                        placeholder="*Email"
                                        required
                                        value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"
                                    >
                                </div>
                            </div>
                        </div> 
                    <!-- Email input field ends -->
                    <!-- Pass1 input field starts -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="pass">Create a password</label>             
                                    <input 
                                        type="password" 
                                        name="pass" 
                                        class="form-control"
                                        placeholder="*Create Password" 
                                        required
                                        value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"
                                    >
                                </div>
                            </div>
                        </div> 
                    <!-- Pass1 input field ends -->
                    <!-- Pass2 input field starts -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="pass2">Repeat your password</label> 
                                    <input 
                                        type="password" 
                                        name="pass2" 
                                        class="form-control"
                                        placeholder="*Confirm Password" 
                                        required
                                        value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"
                                    >
                                </div>
                            </div>
                        </div> 
                    <!-- Pass2 input field ends -->
                        <input 
                            type="submit" 
                            class="btn btn-dark btn-large btn-block"
                            value="Register"
                        >
                    </form>
                </div> <!-- Closing "card-body" -->
            </div> <!-- Closing class="card bg-light mb-3" -->
        </div> <!-- Closing "col-sm" -->
    </div> <!-- Closing "row" -->
<!-- HTML Register Form ends--> 

<!-- PHP for Footer starts -->
    <?php

        // Include the footer script to close the HTML document
        include('includes/footer.html'); 

    ?>
<!-- PHP for Footer ends -->