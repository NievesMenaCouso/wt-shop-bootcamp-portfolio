<!-- File to connect to MySQL Database --> 

    <?php 

        # Connect  on 'localhost' 'wt' .
        $link = mysqli_connect("localhost","root","lunatica2","wt"); 
        
        # Otherwise fail gracefully and explain the error.
        if (!$link) { 
            die('Could not connect to MySQL'); 
        }  

    ?>