<?php require APPROOT . '/views/includes/head.php';?>
<?php echo $data["title"]; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h4>Naam leverancier: <?=$data['leveranciernaam'];?></h4>
    <h4>Contactpersoon: <?=$data['ContactPersoon'];?></h4>
    <h4>Leverancier nr: <?=$data['LeverancierNummer'];?></h4>
    <h4>Mobiel: <?=$data['Mobiel'];?></h4>

    <?php if (empty($data['rows'])): ?>
    <p>Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin</p>
    <?php header("Refresh:3; url=" . URLROOT . "/Leverancier/index");?>
    <?php else: ?>
    <table border=1>
        <thead>
            <th>Naam</th>
            <th>AantalAanwezig</th>
            <th>VerpakkingsEenheid</th>
            <th>DatumLevering</th>
            <th>Nieuwe levering</th>
        </thead>
        <tbody>
            <?=$data['rows']?>
        </tbody>
    </table>
    <?php endif;?>

    <a href="<?=URLROOT;?>/Leverancier/index">Terug</a>
    <a href="<?=URLROOT;?>/homepages/index">Home</a>
</body>

</html>