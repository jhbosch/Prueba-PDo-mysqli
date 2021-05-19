

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
 <div>
     <h1>Bienvenido:</h1>
     <h3>usuario:<?php echo isset($_SESSION['user']) ? $_SESSION['user']['user'] : 'Anonymus' ?></h3>
     <p><a href="index.php?logout=true">logout</a></p>
 </div>
</body>
</html>