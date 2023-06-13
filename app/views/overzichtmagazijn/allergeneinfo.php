<?php require APPROOT . '/views/includes/head.php';
echo $data["title"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h4> Naam: <?= $data['productnaam']; ?></h4>
    <h4> Barcode: <?= $data['barcode']; ?></h4>
    <table border=1>
  <thead>
    <th>Naam</th>
    <th>Omschrijving</th>
  </thead>
    <tbody>
    <?=$data['rows']?>
  </tbody>
</table>
<a href="<?=URLROOT;?>/overzichtmagazijn/index">terug</a>
</body>
</html>