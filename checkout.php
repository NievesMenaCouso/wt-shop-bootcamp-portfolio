<!-- File to process the order and place the details 
into orders and order_content tables in the database -->
    <?php

        // Include the file to begin the session
        include('includes/nav.php');

        // Ensure that the total has been passed, 
        // it is larger than 0 and the cart is not empty
        if (isset
        ($_GET['total']) && 
        ($_GET['total'] > 0) && 
        (!empty($_SESSION['cart']))){

            // Connect to the database 
            require('connect_db.php');

            // Initialise a variable to hold a query to insert 
            // user id, order total and order date into the database
            $q = "INSERT INTO orders (user_id, total, order_date) 
                VALUES (".$_SESSION['user_id'].",".$_GET['total'].",NOW())";
            $r = mysqli_query($link, $q);

            // Create a variable to hold the current order number
            $order_id = mysqli_insert_id($link);

            // Create a variable to hold a query to select all products
            // where item_id can be found in the session
            $q = "SELECT * FROM products WHERE item_id IN (";
            foreach($_SESSION['cart'] as $id => $value){
                $q .= $id .',';
            }
            $q = substr($q, 0, -1).') ORDER BY item_id ASC';
            $r = mysqli_query($link, $q);

            while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)){
                $query = "INSERT INTO order_contents (order_id, item_id, quantity, price)
                VALUES ($order_id, ".$row['item_id'].",
                    ".$_SESSION['cart'][$row['item_id']]['quantity'].",
                    ".$_SESSION['cart'][$row['item_id']]['price'].")";
                $result = mysqli_query($link, $query);
            }

            // Close the connection to the database
            mysqli_close($link);

            // Display a thank you message when order is done, including order_id
            echo "<p>Thanks for your order. Your Order Number is #".$order_id."</p>";
            
            // Empty cart
            $_SESSION['cart'] = NULL;

        // If there is no total, the total is 0 or less or the cart is empty
        } else {

            // Tell the user the cart is empty
            echo '<p>There are no items in your cart.</p>';
        }

    ?>
