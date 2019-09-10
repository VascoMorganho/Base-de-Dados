
<html>

<body>
    <?php
            $host = "db.ist.utl.pt";
            $user ="ist181920";
            $password = "metalica10";
            $dbname = $user;
    
            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        ?>
<?php
    try
    {
        $numprocessosocorro = $_REQUEST['numprocessosocorro'];

        echo("<h3>Associe o Processo de Socorro $numprocessosocorro a um Evento de Emergencia</h3>");

        $sql = "SELECT moradalocal, instanteChamada, nomePessoa, numTelefone, numProcessoSocorro FROM EventoEmergencia WHERE numProcessoSocorro IS NULL;";

    
        $result = $db->prepare($sql);
        $result->execute();
        echo("<table border=\"1\">\n");
        echo("<tr><td>moradalocal</td><td>instanteChamada</td><td>nomePessoa</td><td>numTelefone</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['moradalocal']);
            echo("</td><td>");
            echo($row['instantechamada']);
            echo("</td><td>");
            echo($row['nomepessoa']);
            echo("</td><td>");
            echo($row['numtelefone']);
            echo("</td><td>");
            $inst = urlencode($row['instantechamada']);
            echo("<a href=\"associape3.php?numprocessosocorro={$numprocessosocorro}&amp;numtelefone={$row['numtelefone']}&amp;instantechamada={$inst}\">Associar</a>");
            echo("</td><td>");
            echo("</td></tr>\n");
        }
        echo("</table>\n");
    
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
</body>
</html>