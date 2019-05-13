<?php
    # Inizializzazione della sessione
    session_start();

    # Inclusione del file per la connessione al database
    include("include/db_conn.php");

    //include("function_pagination_data.php");
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>User Report</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- CSS -->
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- JAVASCRIPT -->
        <!-- JQUERY | AJAX (Start) -->
        <!-- <script src="http://code.jquery.com/jquery-latest.js"></script> -->
        <!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->
        <script src="js/jquery-latest.js"></script>
        <script src="js/jquery-latest.min.js"></script>

        <script type="text/javascript">

        $(document).ready(function()
        {

            $("#tableUserReport tr").click(function()
            {
                var celle = $("td",this);
                var dati =
                {
                     id         : celle.eq(0).html()
                    ,avatar     : celle.eq(1).html()
                    ,first_name : celle.eq(2).html()
                    ,last_name  : celle.eq(3).html()
                }
                for (var key in dati)
                {
                    $("#"+key).val(dati[key]);
                }
            })

            $("form#tableUserReport").submit(function()
            {

                var id         = $("#id").val();
                var first_name = $("#first_name").val();
                var last_name  = $("#last_name").val();

                //jQuery.ajax(...)
                $.ajax
                ({
                    // definisco il tipo della chiamata
                    type: "POST",
                    // specifico la URL della risorsa da contattare
                    url:  "Moncler (cancel_user_report).php",
                    // passo dei dati alla risorsa remota
                    data: "id=" + id + "&first_name=" + first_name + "&last_name=" + last_name,
                    //data: "nome=" + $('input#nome').val() + "&cognome=" + $('input#cognome').val()
                    //data: { nome: $('input#nome').val(), cognome: $('input#cognome').val() }
                    // definisco il formato della risposta
                    dataType: "html",
                    // imposto un'azione per il caso di successo
                    success: function(answer)
                    {
                        $("div#answer").html(answer);
                        //alert(answer);
                    },
                    // ed una per il caso di fallimento
                    error: function()
                    {
                        alert("Chiamata fallita!!!");
                    }
                    // ed una che verrà eseguita indipendentemente che abbia dato successo o errore; è eseguita dopo success o error
                    /*
                    complete: function()
                    {
                        //...
                    }
                    */
                });
                return false;
            });
        });
        </script>
        <!-- JQUERY | AJAX (End) -->

        <style type="text/css">
            table
            {
                width: 300px;
                border-collapse: collapse;
            }
            table tr td
            {
                border: 1px solid Grey;
            }
            table tr:hover
            {
                color: White;
                background: DarkGreen;
                cursor: pointer;
            }
            label
            {
                width: 100px;
                display: block;
                float: left;
                text-align: right;
                padding-right: 5px;
            }
        </style>
    </head>

    <body onload="">

        <h1><center>User Report</center></h1>

            <table class="table" name="tableUserReport" id="tableUserReport">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Action</th>
                    </tr>
                <?php

                    $rs_user_report = mysqli_query($mysqli, "SELECT * FROM `user_report`");

                    // Numero righe selezionate dalla query nelle tabelle
                    $numRows = mysqli_num_rows($rs_user_report);

                    for ($i=1;$i<=$numRows;$i++)
                    {
                        if (mysqli_num_rows($rs_user_report)>0)
                        {
                            $user_report= mysqli_fetch_array($rs_user_report, MYSQLI_BOTH);

                            $id           = $user_report['id'];
                            $avatar       = $user_report['avatar'];
                            $first_name   = $user_report['first_name'];
                            $last_name    = $user_report['last_name'];

                            //Test
                            /*
                            echo "id: "          .$user_report['id'];
                            echo "<br>";
                            echo "avatar: "      .$user_report['avatar'];
                            echo "<br>";
                            echo "first_name: "  .$user_report['first_name'];
                            echo "<br>";
                            echo "last_name: "   .$user_report['last_name'];
                            echo "<br>";
                            echo "i: "           .$i;
                            */

                ?>
                    <tbody>
                        <tr>
                            <form  action="#" method="post" name="tableUserReport" id="tableUserReport">
                                <tr>
                                    <!-- Id -->
                                    <!-- <td><input type="hidden" name="id"         id="id"         value="<?php  {  echo $id; } ?>"></td> -->
                                    <!-- First Name -->
                                    <!-- <td><input type="text"   name="first_name" id="first_name" value="<?php  {  echo $first_name; } ?>"></td> -->
                                    <!-- Last Name -->
                                    <!-- <td><input type="text"   name="last_name"  id="last_name"  value="<?php  {  echo $last_name; } ?>"></td> -->
                                    <!-- Id -->
                                    <td><?php  {  echo $id; } ?></td>
                                    <!-- Image -->
                                    <td><img name="avatar"id="avatar" class="" src="image/<?php echo $avatar; ?>"></td>
                                    <!-- First Name -->
                                    <td><?php  {  echo $first_name; } ?></td>
                                    <!-- Last Name -->
                                    <td><?php  {  echo $last_name; } ?></td>

                                    <td>
                                        <div id="box-button-delete" class="box-button-delete">
                                            <!-- Cancella ^ jQuery.ajax(...) -->
                                            <input type="submit" id="delete" value="Delete">
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        </tr>
                    </tbody>
                </thead>
    <?php
                       }
                    }

        ?>

            <table class="table" name="" id="">
                <h1><center>Reply REST API (jQuery.Ajax)</center></h1>
                <thead class="thead-dark">
                    <tr>
                    <form action="#" id="modulo">
                        <td><label>ID:</label>        <input id="id"         type="text"></td>
                        <td><label>First name:</label><input id="first_name" type="text"></td>
                        <td><label>Last name:</label> <input id="last_name"  type="text"></td>
                        <!-- Dati restituiti -->
                        <td><div id="answer">Reply REST API (jQuery.Ajax)</div></td>
                    </form>
                    </tr>
                </thead>

            </table>
        </table>
        <center>Pagina 1 | 2 | 3</center>
    </body>

</html>
