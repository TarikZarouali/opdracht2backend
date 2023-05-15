<?php require APPROOT . '/views/includes/head.php';
  echo $data["title"];
?>
    <!-- <form action="/klanten/klantenoverzicht" method="post">
    <input type="date" name="datum">
    <input type="submit" value="Tonen">
    </form> -->

<table>
  <thead>
    <th>voornaam</th>
    <th>tussenvoegsel</th>
    <th>Achternaam</th>
    <th>Aantalpunten</th>
    <th>Datum</th>
  </thead>
  <tbody>
    <?=$data['rows']?>
  </tbody>
</table>
<a href="<?=URLROOT;?>/homepages/index">terug</a>