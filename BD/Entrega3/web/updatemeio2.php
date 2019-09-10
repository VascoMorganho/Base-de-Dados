<html>
    <body>
<?php
    $nummeio = $_REQUEST['nummeio'];
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
        $sql = "UPDATE Meio SET nomeEntidade = :nomeentidade WHERE nummeio = :nummeio;";
        $sql2 = "UPDATE $tipo SET nomeEntidade = :nomeentidade WHERE nummeio = :nummeio;";
        echo("<p>$sql</p>");

        $result = $db->prepare($sql);
        $result->execute([':nummeio' => $nummeio,':nomeentidade' => $nomeentidade]);
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