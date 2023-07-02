<!-- File to log in or access other pages of the website --> 
    
    <!-- PHP script if login fails starts --> 
        <?php

            // Include the navigation for the page
            include('includes/nav.html');

            // If there are errors
            if (isset($errors) && !empty($errors)){

                // display the error message
                echo '<p id="err_msg">Oops! There was a problem:<br>';
                foreach($errors as $msg){
                    echo " - $msg<br>";
                }

                // and ask to try again with a link back to teh register page
                echo 'Please try again or <a href="register.php">Register</a></p>';
            }

        ?>
    <!-- PHP script if log in fails ends --> 

    <!-- HTML Log In Form starts --> 
        <div class="row">
            <div class="col-sm">
                <h2>Login</h2>
                <div class="card bg-light mb-3" style="margin-top: 3%; width: 50%">
                    <div class="card-body">
                        <form action="login_action.php" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input 
                                    type="text" 
                                    name="email" 
                                    class="form-control" 
                                    placeholder="*Enter Email"
                                >
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input 
                                    type="password" 
                                    name="pass" 
                                    class="form-control" 
                                    placeholder="*Enter Password"
                                >
                            </div>
                            <input 
                                type="submit" 
                                class="brb btn-dark btn-lg btn-block"
                                value="Login" 
                            >
                        </form>
                    </div> <!-- Closing "card-body" -->
                </div> <!-- Closing "card bg-light mb-3" -->
            </div> <!-- Closing "col-sm" -->
        </div> <!-- Closing "row" -->
    <!-- HTML Log In Form ends --> 