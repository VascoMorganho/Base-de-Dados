<html>
    <body>
<?php
    $moradalocal = $_REQUEST['moradalocal'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist181920";
        $password = "metalica10";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM Local WHERE moradalocal = :moradalocal;";
        echo("<p>$sql</p>");
                            echo("<a href=\"index.php\">Voltar o index</a>");

        $result = $db->prepare($sql);
        $result->execute([':moradalocal' => $moradalocal]);
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>