
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
 <h3>Meios de Apoio</h3>
<?php
    try
    {
        $sql = "SELECT numMeio, nomeEntidade FROM MeioApoio;";
        
        $sql1 = "SELECT max(numMeio) as maxM FROM Meio;";     

        $result1 = $db->prepare($sql1);
        $result1->execute();
        foreach($result1 as $row)
        {
            $last = ($row['maxm']);
        } 

        $last += 1;
        echo("<a href=\"updatemeioint2.php?nummeio={$last}&amp;tipo=MeioApoio\">Inserir novo Meio de Apoio</a>\n");
        $result = $db->prepare($sql);
        $result->execute();
        echo("<p><a href=\"index.php\">Voltar ao Index</a></p>");
        echo("<table border=\"1\">\n");
        echo("<tr><td>numMeio</td><td>nomeEntidade</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nummeio']);
            echo("</td><td>");
            echo($row['nomeentidade']);
            echo("</td><td>");
            echo("<a href=\"updatemeioint.php?nummeio={$row['nummeio']}&amp;tipo=MeioApoio\">Editar</a>");
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