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
    <h3>Processos de Socorro</h3>
<?php
    try
    {
    
        $sql = "SELECT numProcessoSocorro FROM ProcessoSocorro;";
    
        $result = $db->prepare($sql);
        $result->execute();
         foreach($result as $row)
        {
            $last = ($row['numprocessosocorro']);
        }
        $last += 1;
        $result = $db->prepare($sql);
        $result->execute();
        echo("<td><a href=\"inserirprocessosocorro.php?numprocessosocorro={$last}\">Inserir novo Processo de Socorro</a></td>");
        echo("<p><a href=\"index.php\">Voltar ao Index</a></p>");
        echo("<table border=\"1\">\n");
        echo("<tr><td>numProcessoSocorro</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['numprocessosocorro']);
            echo("<td><a href=\"listameios.php?numprocessosocorro={$row['numprocessosocorro']}\">Listar meios</a></td>");
            echo("<td><a href=\"associapm.php?numprocessosocorro={$row['numprocessosocorro']}\">Associar a um meio</a></td>");
            echo("<td><a href=\"associape.php?numprocessosocorro={$row['numprocessosocorro']}\">Associar a um evento</a></td>");
            echo("<td><a href=\"removeprocessosocorro.php?numprocessosocorro={$row['numprocessosocorro']}\">Remover</a></td>");
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
