<?php

if( isset($_POST['name'], $_POST['age'], $_POST['average']) )
{
    $name = $_POST['name'];
    $age = $_POST['age'];
    $average = $_POST['average'];
    $bowler = "$name, $age, $average\n";
    $bowlersFile = fopen("bowlers.txt", "ab");

    if(fwrite($bowlersFile, $bowler) > 0)
    {
        echo "Successfully Registered!";
    }
    else
        {
            echo "Registration Error!";
        }
    fclose($bowlersFile);
}
?>