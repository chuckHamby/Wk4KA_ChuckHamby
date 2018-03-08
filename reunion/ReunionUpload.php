<?php

function saveImage() {
    if (!isset($_FILES["guestImage"]))
    {
        print "no Image";
        return;
    }
    $fileErrorCode = $_FILES["guestImage"]["error"];
    if ($fileErrorCode > 0)
    {
        print "ERROR";
        return;
    }
    $rawFileName = $_FILES["guestImage"]["name"];
    $fileTmpName = $_FILES["guestImage"]["tmp_name"];
    $fileName = strtolower($rawFileName);
    if (!file_exists("reunion/images"))
    {
        mkdir("reunion/images");
    }
    move_uploaded_file($fileTmpName, "reunion/images" . "/{$fileName}");
    return $fileName;
}

function save($name, $description, $file)
{
    try
    {
        $line = htmlspecialchars($name, ENT_QUOTES) .
            " | " . htmlspecialchars($description, ENT_QUOTES) .
            " | ";
        if ($file != null)
        {
            $line.= $file;
        }
        $line .= PHP_EOL;
        $result = file_put_contents("images/images.txt", $line, FILE_APPEND);
        if($result == false)
            return $result;
        return true;
    }
    catch (Error $e)
    {
        return false;
    }
}

$name = $_POST["name"];
$description = $_POST["description"];


$msgs = array();
$response = "";

if (!empty($msgs))
{
    $response .= "Invalid data <br/>";
    foreach($msgs as $msg)
    {
        $response .= " {$msg} <br/>";
    }
}
else
{
    $fileName = saveImage();
    $result = save($name, $description, $fileName);

    if ($result == false)
    {
        $response .= "Failed to persist data.";
    }
    else
    {
        $response .= "Successfully Added Image: <br/>";
        $response .= "<label>Name:</label> {$name}";
        $response .= "<label>Description:</label> {$description}";
        print "Successfully Added Image: <br />";
        print "<label>Name:</label> {$name} <br />";
        print "<label>Description:</label> {$description} <br />";
    }

}