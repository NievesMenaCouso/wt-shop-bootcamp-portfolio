<!-- File display and edit the CART PAGE --> 

    <?php 

        // Set the title
        $page_title = 'Cart';

        // Display the header section
        include('includes/nav.php');

        // Check if the form has been submited for update
        if ($_SERVER['REQUEAST_METHOD'] == 'POST'){
            
            // Loop to update changed quantity field values
            foreach ($_POST['qty'] as $item_id => $item_qty){

                // Ensure values are integers
                $id = (int) $item_id;
                $qty = (int) $item_qty;

                // If the quantity in the cart is 0
                if ($qty == 0){

                    // delete the cart
                    unset($_SESSION['cart'][$id]);

                // If the quantity in the cart is > 0
                } elseif ($qty > 0){

                    // change the quantity of the item in the cart
                    $_SESSION['cart'][$id]['quantity'] = $qty;
                }
            }
        }

        // Initialise a variable to store the total value
        $total = 0;

        // If cart contains anything
        if (!empty($_SESSION['cart'])){

            // connect to the database using the connect_db.php file
            require('connect_db.php');
            
            // Intialise a variable to hold the SQL statement 
            // to retrieve items in the database based on the item id stored from the session
            $q = "SELECT * FROM products WHERE item_id IN ("; 
            foreach($_SESSION['cart'] as $id => $value){
                $q .= $id .',';
            }

            // and set them in ascending order by item_id
            $q = substr($q, 0, -1).') ORDER BY item_id ASC';
            $r = mysqli_query ($link, $q);

            // FORM 1/3 Display each item in an HTML table 
            echo '
                <form action="cart.php" method="post">
                    <table class = "table">
                        <thead>
                            <tr>
                                <th>Items in your cart</th>
                            </tr>
                        </thead>
                        </tbody>
                            <tr>';
            
            // Fetch the array
            while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)){

                // Create two variables to hold the sub-total and total
                $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] *
                            $_SESSION['cart'][$row['item_id']]['price'];
                $total += $subtotal;

                // FORM 2/3 Display the rows of the table
                echo "
                    <tr>
                        <td>{$row['item_name']}</td>
                        <td>
                            <input 
                                type=\"text\" 
                                size=\"3\" 
                                name=\"qty[{$row['item_id']}]\" 
                                value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"
                            >
                        </td>
                        <td>@{$row['item_price']} = </td>
                        <td>&pound ".number_format($subtotal, 2)."</td>
                    </tr>";
            }

            // Close the connection to the database
            mysqli_close($link);

            // FORM 3/3 Display the total by connecting to checkout.php page 
            // and appending the total due in the URL
            echo '
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total=&pound '.number_format($total,2).'</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <input
                                    type="submit"
                                    name="submit"
                                    class="btn btn-light btn-lg btn-block"
                                    value="Update My Cart"
                                >
                            </td>
                        </tr>
                        <td>
                            <a 
                                herf="checkout.php?total='.$total.'" 
                                class="btn btn-light btn-lg btn-block"
                            >Checkout Now</a>
                        </td>
                    </table>
                </form>';
        
        // If cart is empty
        } else {

            // display a message saying so
            echo '
                    <div class="alert alert-secondary" role="alert>
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>Your cart is currently empty.</p>
                    </div>
                </div>';
        }

    ?>