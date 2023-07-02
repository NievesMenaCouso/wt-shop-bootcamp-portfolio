<!-- File to be used by the 'Buy Now' button from the Home (nav.php) page --> 
    
    <?php

        // Add header section
        include('includes/nav.php');

        // Assign the passed product ID to a variable
        if (isset($_GET['id'])) $id = $_GET['id'];

        // Open the database connection
        require ('connect_db.php');

        // Retrieve the data of the selected products from the database
        $q = "SELECT * FROM products WHERE item_id = $id";
        $r = mysqli_query($link, $q);
        if (mysqli_num_rows($r) == 1){
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

            // If user has already placed the same product in the cart
            if (isset($_SESSION['cart'][$id])){

                // increment the quantity of the product by one
                $_SESSION['cart'][$id]['quantity']++;

                // and send a notification
                echo '
                    <div class="container">
                        <div class="alert alert-secondary" role="alert>
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p>Another '.$row["item_name"].' has been added to your cart.</p>
                        </div> <!-- Close alert alert-secondary -->
                    </div> <!-- Close container -->';
            
            // If the user has not placed that product in the cart yet
            } else {

                // initiate the array of the cart
                $_SESSION['cart'][$id] = array ('quantity' => 1, 'price' => $row['item_price']);

                // and send a notification
                echo '
                    <div class="container">
                        <div class="alert alert-secondary" role="alert>
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p>A '.$row["item_name"].' has been added to your cart</p>
                        </div> <!-- Close alert alert-secondary -->
                    </div> <!-- Close container -->';
            }
        }

        // Close the link to the database 
        mysqli_close($link); 
        
    ?>
