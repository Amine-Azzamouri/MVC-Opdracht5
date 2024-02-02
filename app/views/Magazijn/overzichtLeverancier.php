<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jamin Overzicht Magazijn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= URLROOT; ?>/css/style.css">
    <link rel="shortcut icon" href="../public/img/jamin-logo2.png" type="image/x-icon">
</head>
  <body>
    
    <h3><u><?= $data['title']; ?></u></h3>

    <?php if (isset($data['NaamLeverancier'])) : ?>
        <p>Naam Leverancier: [ <?= $data['NaamLeverancier'] ?> ]</p>
    <?php endif; ?>

    <?php if (isset($data['ContactPersoon leverancier'])) : ?>
        <p>Contactpersoon Leverancier: [ <?= $data['ContactPersoon leverancier'] ?> ]</p>
    <?php endif; ?>

    <?php if (isset($data['LeverancierNummer'])) : ?>
        <p>Leveranciernummer: [ <?= $data['LeverancierNummer'] ?> ]</p>
    <?php endif; ?>

    <?php if (isset($data['Mobiel'])) : ?>
        <p>Mobiel: [ <?= $data['Mobiel'] ?> ]</p>
    <?php endif; ?>

    <table>
        <thead>
            <th>Naam Product</th>
            <th>Datum Laatste Levering</th>
            <th>Aantal</th>
            <th>Eerstvolgende Levering</th>
        </thead>
        <tbody>
            <?= $data['rows']; ?>
        </tbody>
    </table>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>