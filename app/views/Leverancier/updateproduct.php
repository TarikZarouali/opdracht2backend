<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Levering product</title>
</head>

<body>
    <h1>Levering product</h1>
    <h2>Naam leverancier: <?=$data['Naam'];?></h2>
    <h2>Contactpersoon: <?=$data['ContactPersoon'];?></h2>
    <h2>Mobiel: <?=$data['Mobiel'];?></h2>

    <form action="<?= URLROOT ?>/Leverancier/updateproduct/<?= $data['id'] ?>" method="post"> 
        <table>
            <tbody>
                <tr>
                    <td>
                        <h2>Aantal producteenheden</h2>
                        <input type="text" name="aantal_eenheden">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Datum eerstvolgende levering</h2>
                        <input type="date" name="datum">
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="submit">Sla Op</button>
    </form>

    <button><a href="<?=URLROOT;?>/Leverancier/index">Terug</a></button>
    <button><a href="<?=URLROOT;?>/homepages/index">Home</a></button>
</body>

</html>