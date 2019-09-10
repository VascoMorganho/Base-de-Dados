<html>
    <body>
<?php
    $nummeio = $_REQUEST['nummeio'];
    $nomemeio = $_REQUEST['nomemeio'];
    $nomeentidade = $_REQUEST['nomeentidade'];
    $tipo = $_REQUEST['tipo'];
    echo("$tipo");
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist181920";
        $password = "metalica10";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO Meio VALUES(:nummeio, :nomemeio, :nomeentidade)";
        $result = $db->prepare($sql);
        $result->execute([':nummeio' => $nummeio, ':nomemeio' => $nomemeio, ':nomeentidade' => $nomeentidade]);

        $sql2 = "INSERT INTO $tipo VALUES(:nummeio, :nomeentidade)";
        echo("<p>$sql</p>");
        echo("<p>$sql2</p>");

        $result2 = $db->prepare($sql2);
        $result2->execute([':nummeio' => $nummeio,':nomeentidade' => $nomeentidade]);
                    echo("<a href=\"index.php\">Voltar o index</a>");
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>