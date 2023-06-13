<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Levering product</h1>
    <h4>Naam leverancier: <?=$data['Naam'];?></h4>
    <h4>Contactpersoon: <?=$data['ContactPersoon'];?></h4>
    <h4>Mobiel: <?=$data['Mobiel'];?></h4>


    <form action="<?=URLROOT;?>/Leverancier/updateproduct" method="post">
        <table>
            <tbody>
                <tr>
                    <td>
                        <input type="text">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>

</html>