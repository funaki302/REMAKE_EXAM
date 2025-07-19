<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <main>
        <div class="container">
            <p><h1 class="text-center">Login</h1></p>
            <form action="traitement.php" method="post">
                <p><input type="email" name="email" placeholder="Email@gmail.com" id=""></p>
                <p><input type="text" name="nom" placeholder="Votre Pseudo" id=""></p>
                <p><input type="date" name="dtn"  id=""></p>
                <p><input type="text" name="ville" placeholder="Votre ville" id=""></p>
                <p><select name="genre" id="">
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select></p>
                <p><input type="password" name="mdp" placeholder="Mot de passe ..." id=""></p>
                <p><input type="submit" value="Login"></p>
            </form>
            <p>Vous etes deja encore inscrit ? <a href="login.php">Connectez vous</a></p>
        </div>
    </main>
</body>
</html>