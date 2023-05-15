<?php require APPROOT . '/views/includes/head.php';
  echo $data["title"];
?>
<table>
  <thead>
    <th>voornaam</th>
    <th>tussenvoegsel</th>
    <th>Achternaam</th>
    <th>Aantalpunten</th>
    <th>Wijzigen</th>
  </thead>
  <tbody>
    <?=$data['rows']?>
  </tbody>
</table>
<a href="<?=URLROOT;?>/homepages/index">terug</a>