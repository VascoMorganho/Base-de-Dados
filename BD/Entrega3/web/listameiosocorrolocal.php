<html>
    <body>
<?php
    $moradalocal = $_REQUEST['moradalocal'];
        echo("Meios de Socorro acionados em Processos de Socorro originados em $moradalocal");
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist181920";
        $password = "metalica10";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT numMeio, nomeEntidade FROM MeioSocorro NATURAL JOIN Acciona NATURAL JOIN EventoEmergencia WHERE EventoEmergencia.moradaLocal = :moradalocal";
        echo("<p>$sql</p>");
        echo("<a href=\"index.php\">Voltar ao index</a>");

        $result = $db->prepare($sql);
        $result->execute([':moradalocal' => $moradalocal]);

        echo("<table border=\"1\">\n");
        echo("<tr><td>numMeio</td><td>nomeEntidade</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nummeio']);
            echo("</td><td>");
            echo($row['nomeentidade']);
            echo("</td></tr>\n");
        }
        echo("</table>\n");
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>    </body>
</html>