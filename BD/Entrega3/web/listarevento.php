
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
<h3>Eventos de Emergencia</h3>
<?php
    try
    {
        $sql = "SELECT moradalocal, instanteChamada, nomePessoa, numTelefone, numProcessoSocorro FROM EventoEmergencia;";
    
        $result = $db->prepare($sql);
        $result->execute();
        echo("<a href=\"inserireventoemergencia.php\">Inserir novo Evento de Emergencia</a>\n");
        echo("<p><a href=\"index.php\">Voltar ao Index</a></p>");
        echo("<table border=\"1\">\n");
        echo("<tr><td>moradalocal</td><td>instanteChamada</td><td>nomePessoa</td><td>numTelefone</td><td>numProcessoSocorro</td></tr>\n");
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
            echo($row['numprocessosocorro']);
            echo("</td><td>");
            $inst = urlencode($row['instantechamada']);
            echo("<a href=\"removeevento.php?numtelefone={$row['numtelefone']}?instantechamada={$inst}\">Remover</a>");
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