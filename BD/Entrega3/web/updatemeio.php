<html>

    <body>

        <?php
            $nomeMeio = $_REQUEST['nomemeio'];
            $nomeEntidade = $_REQUEST['nomeentidade'];
            $numMeio = $_REQUEST['nummeio'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist181920";
                $password = "metalica10";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO Meio VALUES (:numMeio, :nomeMeio, :nomeEntidade)";
                echo("<p>$sql</p>");

                $result = $db->prepare($sql);
                $result->execute([':numMeio' => $numMeio, ':nomeMeio' => $nomeMeio, ':nomeEntidade' => $nomeEntidade]);
                    echo("<a href=\"index.php\">Voltar o index</a>");
                
                $db = null;
            }
            catch (PDOException $e)
            {
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }
        ?>

    </body>
</html>
