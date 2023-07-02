<!-- File to articulate the display page --> 

  <?php

    // Include the markup for the navigation
    include('includes/nav.html');

    // Connect to database
    require('connect_db.php');

    // DISPLAY 2/3 Display an HTML row (see includes/nav.html) and a title
    echo '
      <h2>My shop</h2>
      <div class="row">';

    // Retrieve items from products database table to fill that row
    $q = "SELECT * FROM products";
    $r = mysqli_query($link,$q);

    // If there is any product in the database
    if(mysqli_num_rows($r) > 0) {

      // DISPLAY 3/3 Loop to display the items in HTML cards (see includes/nav.html)
      while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
            <div class="col-sm-4">
              <div class="card">
                <img src="'.$row['item_img'].'" class="card-img-top" alt="t-shirt">
                <div class="card-body text-center">
                  <h5 class="card-title">'.$row['item_name'].'</h5>
                  <p class="card-text">'.$row['item_desc'].'</p>
                  <p class="card-text">&pound '.$row['item_price'].'</p>
                  <a href="added.php?id='.$row['item_id'].'" class="btn btn-dark">Add to Cart</a>
                </div>
              </div> 
            </div>';
      }

      // and then close the connection
      mysqli_close($link);

    // If there is no items in the database
    } else { 

      // Message if no itmes found
      echo '<p>There are no items found.</p>';
    }

    // Add the footer to close the html document
    include('includes/footer.html');

  ?>

