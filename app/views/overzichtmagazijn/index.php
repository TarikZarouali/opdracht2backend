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
    <table border=1>
  <thead>
    <th>Barcode</th>
    <th>naam</th>
    <th>Verpakkingseenheid</th>
    <th>Aantalaanwezig</th>
    <th>AllergeneInfo</th>
    <th>leverantieInfo</th>
  </thead>
    <tbody>
    <?=$data['rows']?>
  </tbody>
</table>
<a href="<?=URLROOT;?>/homepages/index">terug</a>
</body>
</html>