<?php
    # Inizializzazione della sessione
    session_start();

    # Inclusione del file per la connessione al database
    include("include/db_conn.php");
?>


<?php
    //Test
    /*
    if (isset($_POST["id"])         &&
        isset($_POST["first_name"]) &&
        isset($_POST["last_name"]))
    {
        $id         = $_POST["id"];
        $first_name = $_POST["first_name"];
        $last_name  = $_POST["last_name"];

        echo "Reply REST API (jQuery.Ajax):";
        echo "<br>";
        echo "Id: "         .$id;
        echo "<br>";
        echo "First name: " .$first_name;
        echo "<br>";
        echo "Last name:  " .$last_name;
    }
    else
    {
        echo "Nessun valore inviato";
        return;
    }
    */
?>

<?php
    if (isset($_POST["id"])  &&
        isset($_POST["first_name"]) &&
        isset($_POST["last_name"]))
    {

        $id         = $_POST["id"];
        $first_name = $_POST["first_name"];
        $last_name  = $_POST["last_name"];

        $sql = "SELECT * FROM `user_report`
                WHERE            id ='".$id."'
                AND      first_name ='".$first_name."'
                AND       last_name ='".$last_name."'";

        //Test
        echo "<br>";
        echo "Sql: ".$sql;
        echo "<br>";

        $query_verify = mysqli_query($mysqli,$sql);

        if (!$query_verify)
        {
            $msg = "Record non presente (Table: user_report).";
            ///return;
            //die;
        }
        else
        {
            $msg = "Record presente (Table: user_report).";
        }

        //Test
        echo "<br>";
        echo "Message: ".$msg;
        echo "<br>";

        $query_num_rows = mysqli_num_rows($query_verify);

        //Se è presente
        if ($query_num_rows > 0)
        {
            $sql = "DELETE FROM `user_report`
                    WHERE    id         ='".$id."'
                    AND      first_name ='".$first_name."'
                    AND      last_name  ='".$last_name."'";

            $query_verify = mysqli_query($mysqli,$sql);

            //Test
            echo "<br>";
            echo "Sql: ".$sql;
            echo "<br>";

            if (!$query_verify)
            {
                //
                $msg = "Cancellazione non riuscita (Table: user_report)";
            }
            else
            {
                $msg = "Cancellazione riuscita (Table: user_report)";
            }
        }

        //Test
        echo "<br>";
        echo "Message: ".$msg;
        echo "<br>";

?>
<?php
        return $msg;
    }
    else
    {
        $msg = "I campi obbligatori necessari per la cancellazione dell'annuncio non sono presenti.";
    }
?>