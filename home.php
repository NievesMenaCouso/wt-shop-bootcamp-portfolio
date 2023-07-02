<!-- File with SESSION DATA On all pages that the user can navigate, 
visible after logging in -->

    <?php 

        // Include the navigation for the page
        include('includes/nav.php');

        // Open the database connection
        require('connect_db.php');

        // DISPLAY 2/3 Display an HTML row (see includes/nav.html)
        echo '<div class="row">';

        // Retrieve all items from the products table in your database
        $q = "SELECT * FROM products";
        $r = mysqli_query($link, $q);
        if (mysqli_num_rows($r) > 0) {

            // Display items retrieved
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
                echo '
                <div class="col-sm">
                    <div class="card" style="width: 18rem;">
                        <img src="'.$row['item_img'].'" alt="'.$row['item_name'].'">
                        <div class="card-body" text-center">
                            <h5 class="card-title">'.$row['item_name'].'</h5>
                            <p class="card-text">'.$row['item_desc'].'</p>
                            <p class="card-text">&pound '.$row['item_price'].'</p>
                            <a href="added.php?id='.$row['item_id'].'" class="btn btn-dark">Buy Now</a>.
                        </div> <!-- Close "card-body" -->
                    </div> <!-- Close "card" -->
                </div> <!-- Close "col-sm" -->';
            }

            // Then close database connection
            mysqli_close($link);
        
        // If no items have been found in the database
        } else { 

            // Display message 
            echo '<p>There are currently no items in the table to display.</p>';
        }
        
        // Include the footer
        include('includes/footer.html');
        
    ?>