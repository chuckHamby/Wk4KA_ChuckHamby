<?php

function load()
{
    try
    {
        $lines = file("images/images.txt", FILE_SKIP_EMPTY_LINES);
        return $lines;
    }
    catch (Error $e)
    {
        return null;
    }
}

function display(array &$data)
{
    ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
        </tr>
        <?php
        foreach($data as $image)
        {
            ?>
            <tr>
                <td><?=$image[0]?></td>
                <td><?=$image[1]?></td>
                <td><?=$image[2]?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>
<html>
<head>
    <title>Guest Listing</title>
</head>
<body>
    <div id="container">
        <div id="content">
            <?php
            $data = load();
            if($data == null || empty($data))
            {
                ?>
                <label>No data exists</label>
                <?php
            }
            else
            {
                $multiArray = array();
                foreach($data as $line)
                {
                    $course = explode(" | ", $line);
                    array_push($multiArray, $course);
                }
                display($multiArray);
            }
            ?>
        </div>
    </div>
</body>
</html>