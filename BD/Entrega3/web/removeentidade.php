<html>
    <body>
<?php
    $nomeentidade = $_REQUEST['nomeentidade'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist181920";
        $password = "metalica10";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM EntidadeMeio WHERE nomeEntidade = :nomeentidade;";
        echo("<p>$sql</p>");
                            echo("<a href=\"index.php\">Voltar o index</a>");

        $result = $db->prepare($sql);
        $result->execute([':nomeentidade' => $nomeentidade]);
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>