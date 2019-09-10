
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
	 <h3>All Meios</h3>
<?php
    try
    {
        $sql = "SELECT numMeio, nomeMeio, nomeEntidade FROM Meio;";
    
        $result = $db->prepare($sql);
        $result->execute();
        foreach($result as $row)
        {
            $last = ($row['nummeio']);
        }
        $last += 1;
        echo("<a href=\"inserirmeio.php?nummeio={$last}\">Inserir novo Meio</a>\n");
        $result = $db->prepare($sql);
        $result->execute();
        echo("<p><a href=\"index.php\">Voltar ao Index</a></p>");
        echo("<table border=\"1\">\n");
        echo("<tr><td>numMeio</td><td>nomeMeio</td><td>nomeEntidade</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nummeio']);
            echo("</td><td>");
            echo($row['nomemeio']);
            echo("</td><td>");
            echo($row['nomeentidade']);
            echo("</td><td>");
            echo("<a href=\"removemeio.php?nummeio={$row['nummeio']}\">Remover</a>");
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