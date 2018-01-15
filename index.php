<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <title>To Do List</title>
        <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="main.css" />

    </head>
    <body>

        <form action="index.php" method="post">       

        <h1 class="header">To-Do List</h1>
            <div id="headerBar">

                <div id="headerRow">
                    <div class="list">
                <input id="add_item_box" name="add_item_box" type="text" placeholder="Add a To-Do Item">
                    </div>    
                </div>
                    <button class="add_button" type="submit" name="add_button" >
                    Add
                    </button>

                <button class="remove_button" type="submit" name="remove_button">
                    Mark Complete
                </button>
                
            </div>
            <?php
            
            require 'init.php';
            
            $dbName = "to_do";
            $tableName = "to_do_list";

            $mysqlConnection = new mysqli("localhost", "root");

            init($mysqlConnection, $dbName, $tableName);
            if ($mysqlConnection->connect_error) {
                echo("MYSQL connection refused: " . $mysqlConnection->connect_error);
            }

            if (isset($_POST["add_button"])) {
                $task = $_POST["add_item_box"];
                
                if ( $task != "" ) {
                    $mysqlConnection->query("INSERT INTO $tableName (task) VALUES ('$task')");
                }
            } else if( isset( $_POST["remove_button"] ) ) {
                
                foreach ($_POST['listItemArray'] AS $item) {
                    $mysqlConnection->query( "DELETE FROM $tableName WHERE ID = $item" );
                }
            }

            $result = $mysqlConnection->query("SELECT ID, task FROM $tableName");
            
            $i = 0;
            echo("<h2 class='header'>Task List</h2>");
            while ($result->num_rows != 0 && $row = ( $result->fetch_assoc() )) {
                echo( "<div class='list_item'>"
                . "<input type='checkbox' class='itemCheckBox' name='listItemArray[]' value=$row[ID]>"
                . "$row[task]"
                . "</input>"
                . "</div>" );
                ++$i;
            }

            $mysqlConnection->commit();

            $mysqlConnection->close();
            ?>

        </form>

    </body>
</html>
