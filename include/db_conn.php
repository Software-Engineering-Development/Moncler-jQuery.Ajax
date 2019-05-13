
<?php

    //Web Site
    $mysqli = mysqli_connect("127.0.0.1", "administrator", "1001010110001011101001", "moncler")
                      or die("Impossibile connettersi al server MySQL su localhost.");

    /* check connection */
    if (mysqli_connect_errno())
    {
       printf("Connect failed: %s\n", mysqli_connect_error());
       exit();
    }
    if (!$mysqli)
    {
        echo "Error: Unable to connect to MySQL."         . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

?>
