
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

        <h3>Locais</h3>
<?php
    try
    {
        $sql = "SELECT moradaLocal FROM Local;";
    
        $result = $db->prepare($sql);
        $result->execute();
                echo("<a href=\"inserirlocal.php\">Inserir novo Local</a>\n");
        echo("<p><a href=\"index.php\">Voltar ao Index</a></p>");
        echo("<table border=\"1\">\n");
        echo("<tr><td>moradaLocal</td></tr>\n");
        foreach($result as $row)
        {
            echo("<tr><td>");
            echo($row['moradalocal']);
            echo("</td><td>");
            $mor1 = urlencode($row['moradalocal']);
            echo("<a href=\"listameiosocorrolocal.php?moradalocal={$mor1}\">Listar Meios de Socorro</a>");
            echo("</td><td>");
            $mor = urlencode($row['moradalocal']);
            echo("<a href=\"removelocal.php?moradalocal={$mor}\">Remover</a>");
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