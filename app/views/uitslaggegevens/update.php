<?php require APPROOT . '/views/includes/head.php'; ?>
<?= $data['title']; ?>

<form action="<?= URLROOT; ?>/uitslaggegevens/update" method="post">
  <table>
    <tbody>
      <tr>
        <td>
            <label for="name">Aantalpunten: </label>
            <input type="number" name="Aantalpunten" id="Aantalpunten" value="<?= $data["row"]->Aantalpunten; ?>">
        </td>
      </tr>
      <tr>
        <td>
          <input type="hidden" name="id" value="<?= $data["row"]->PersoonId; ?>">
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" value="Wijzigen">
        </td>
      </tr>
    </tbody>
  </table>

</form>

<a href="<?= URLROOT;?>/homepages/index">home</a>
<?php require APPROOT . '/views/includes/footer.php'; ?>