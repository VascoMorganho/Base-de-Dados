<html>
    <body>
        <h3>Meios accionados pelo Processo De Socorro <?=$_REQUEST['numprocessosocorro']?></h3>
            <?php
                $numProcessoSocorro = $_REQUEST['numprocessosocorro'];
                try
                {
                    $host = "db.ist.utl.pt";
                    $user ="ist181920";
                    $password = "metalica10";
                    $dbname = $user;
                    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT numMeio, nomeMeio, nomeEntidade FROM Acciona NATURAL JOIN Meio WHERE numProcessoSocorro = :numProcessoSocorro";

                    $result = $db->prepare($sql);
                    $result->execute([':numProcessoSocorro' => $numProcessoSocorro]);
                     echo("<a href=\"index.php\">Voltar o index</a>");
                
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
                        echo("</td></tr>\n");
                    }
                    echo("</table>\n");
                    
                    $db = null;
                }
                catch (PDOException $e)
                {
                    echo("<p>ERROR: {$e->getMessage()}</p>");
                }
            ?>
    </body>
</html>