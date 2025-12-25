<?php 
require_once '../classes/Admin.php';
$data = new Admin;
$coachs = $data->getallcoachs();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
</head>
<body>
    <?php foreach($coachs as $c): ?>
         <p><?= $c["nom"] ?></p>
    <?php endforeach ?>
</body>
</html>