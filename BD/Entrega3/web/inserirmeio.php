<html>
    <body>
        <h3>Insira informacao do novo Meio <?=$_REQUEST['nummeio']?></h3>
        <form action="updatemeio.php" method="post">
            <p><input type="hidden" name="nummeio" value="<?=$_REQUEST['nummeio']?>"/></p>
            <p>Nome Meio: <input type="text" name="nomemeio"/></p>
            <p>Nome Entidade: <input type="text" name="nomeentidade"/></p>
            <p><input type="submit" value="Inserir"/></p>
        </form>
    </body>
</html>