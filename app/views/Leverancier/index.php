<?php require APPROOT . '/views/includes/head.php';?>
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
            <th>Naam</th>
            <th>Contactpersoon</th>
            <th>LeverancierNummer</th>
            <th>Mobiel</th>
            <th>Aantal verschillende producten</th>
            <th>Toon producten</th>
        </thead>
        <tbody>
            <?=$data['rows']?>
        </tbody>
    </table>
    <a href="<?=URLROOT;?>/homepages/index">Home</a>
</body>

</html>