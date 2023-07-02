<!-- File with the Navbar visible once you've logged in
with the options home, cart my order and signt/log out -->

    <!-- PHP script to access session starts --> 
        <?php

            // Access session
            session_start();

            // Redirect to login.php if not logged in (script in login_tools.php)
            if(!isset($_SESSION['user_id'])){
                require('login_tools.php');
                load();
            }

        ?>
    <!-- PHP script to start session ends --> 

<!doctype html>
<html lang="en">
    
    <head>
        <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <title>WT Shop</title>

        <!-- CSS Style-->
        <style>
                .container {
                    margin-top: 40px;
                    margin-bottom: 40px;
                }

                h2 {
                    border-left: solid 10px 	#6C757D;
                    padding: 10px;
                }
                
                form {
                    margin-bottom: 40px;
                }

                .card {
                    margin: auto;
                    margin-top: 15%;
    	        }
   
            </style>
    </head>

    <body>

        <!-- Navbar starts --> 
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Hello {$_SESSION['first_name']} {$_SESSION['last_name']}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </nav>
        <!-- Navbar ends --> 