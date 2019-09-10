<html>
    <body>
<?php
    $nummeio = $_REQUEST['nummeio'];
    $nomeentidade = $_REQUEST['nomeentidade'];
    $numprocessosocorro = $_REQUEST['numprocessosocorro'];
    echo("$nummeio");
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist181920";
        $password = "metalica10";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO Acciona VALUES (:nummeio, :nomeentidade,:numprocessosocorro);";
        echo("<p>$sql</p>");
        echo("<a href=\"associapm.php?numprocessosocorro={$numprocessosocorro}\">Voltar</a>");
        echo("<p><a href=\"index.php\">Voltar ao index</a></p>");

        $result = $db->prepare($sql);
        $result->execute([':nummeio' => $nummeio,':nomeentidade' => $nomeentidade,':numprocessosocorro' => $numprocessosocorro]);
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>    </body>
</html>