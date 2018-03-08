<?php

function connect(){
    return @new PDO(
        "mysql:host=localhost;dbname=software",
        "root",
        "mysql",
        array(PDO::ATTR_ERRMODE=>pdo::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8",
            PDO::ATTR_EMULATE_PREPARES=>false )
    );
}

function query($query,$params=array())
{
    try {
        $result=connect()->prepare($query);
        $result->execute($params);
        return $result->rowCount();
    }
    catch (Exception $ex)
    {
        throw new Exception($ex);
    }
}

function save(&$pName,&$pVer,&$opEnv,&$OS, &$bFreq, &$sol)
{
    try{
        $cleanPName=htmlspecialchars($pName,ENT_QUOTES);
        $cleanPVer=htmlspecialchars($pVer,ENT_QUOTES);
        $cleanOpEnv=htmlspecialchars($opEnv,ENT_QUOTES);
        $cleanOS=htmlspecialchars($OS,ENT_QUOTES);
        $cleanBFreq=htmlspecialchars($bFreq,ENT_QUOTES);
        $cleanSol=htmlspecialchars($sol,ENT_QUOTES);

        $sql="INSERT INTO software.bugs (ProductName, ProductVersion, OperatingEnvironment, 
              OperatingSystem, BugFrequency, Solutions) values(?, ?, ?, ?, ?, ?)";

        $count=query($sql,array($cleanPName, $cleanPVer, $cleanOpEnv, $cleanOS, $cleanBFreq, $cleanSol));
        return $count=1;


    }
    catch(error $e){
        echo ($e);
        return false;
    }
}

$pName = $_POST["pName"];
$pVer = $_POST["pVer"];
$opEnv = $_POST["opEnv"];
$OS = $_POST["OS"];
$bFreq = $_POST["bFreq"];
$sol = $_POST["sol"];

$msgs= array();

if(empty($pName))
{
    array_push($msgs, "Invalid Product Name");
}

if(empty($pVer))
{
    array_push($msgs, "Invalid Product Version");

}

if(empty($opEnv))
{
    array_push($msgs, "Invalid Operating Environment");

}

if(empty($OS))
{
    array_push($msgs, "Invalid Operating System");

}

if(empty($bFreq))
{
    array_push($msgs, "Invalid Bug Frequency");

}

if(empty($sol))
{
    array_push($msgs, "Invalid Solution");

}

$response="";
if(!empty($msgs))
{
    $response.="Invalid Data <br/>";
    foreach($msg as $msg )
    {
        $response.= "{$msg} <br/>";
    }
}
else
{

    $result = save($pName, $pVer, $opEnv, $OS, $bFreq, $sol);

    if($result == false)
    {
        $response .= "Failed to Persist data";
    }
    else
    {
        $response .= "Successfully Added Bug Report:<br>";
        $response .= "<label>Product Name:</label> {$pName}";
        $response .= "<label>Product Version:</label> {$pVer}";
        $response .= "<label>Operating Environment:</label> {$opEnv}";
        $response .= "<label>Operating System:</label> {$OS}";
        $response .= "<label>Bug Frequency:</label> {$bFreq}";
        $response .= "<label>Proposed Solutions:</label> {$sol}";
    }
}

?>

<html>
<head>
    <title>Bug Report</title>
</head>
<body>
<div id="container">
    <div id="content">
        <?=$response?>
    </div>
</div>
</body>
</html>