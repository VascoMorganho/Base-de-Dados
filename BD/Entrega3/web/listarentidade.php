
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
 <h3>EntidadeMeio</h3>
<?php
    try
    {
        $sql = "SELECT nomeEntidade FROM EntidadeMeio;";
    
        $result = $db->prepare($sql);
        $result->execute();
        echo("<a href=\"inserirentidade.php\">Inserir nova Entidade Meio</a>\n");
        echo("<p><a href=\"index.php\">Voltar ao Index</a></p>");
        echo("<table border=\"1\">\n");
        echo("<tr><td>nomeEntidade</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['nomeentidade']);
            echo("</td><td>");
            $nom = urlencode($row['nomeentidade']);
            echo("<a href=\"removeentidade.php?nomeentidade={$nom}\">Remover</a>");
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