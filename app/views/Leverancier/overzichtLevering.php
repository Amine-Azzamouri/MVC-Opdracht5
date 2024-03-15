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
  
    <button><a href="<?= URLROOT; ?>/Homepage/index.php/">Home</a></button>
    <button><a href="<?= URLROOT; ?>/Leverancier/overzichtLeverancier/">Terug</a></button>

    <h3><u><?= $data['title']; ?></u></h3>
    <?php if (isset($data['LeverancierNaam'])) : ?>
        <p>Naam Leverancier: [ <?= $data['LeverancierNaam'] ?> ]</p>
    <?php endif; ?>
    <?php if (isset($data['ContactPersoon'])) : ?>
        <p>ContactPersoon: [ <?= $data['ContactPersoon'] ?> ]</p>
    <?php endif; ?>
    <?php if (isset($data['Mobiel'])) : ?>
        <p>Mobiel: [ <?= $data['Mobiel'] ?> ]</p>
    <?php endif; ?>

    <form action="<?= URLROOT ?>/leverancier/updateLevering" method="post" onsubmit="return validateDate()">
        <table>
            <tr>
                <td>AantalProductheden:</td>
                <td><input type="text" name="aantal_Productheden" id="aantal_Productheden" min="1" max="50" required></td>
            </tr>
            <tr>
                <td>Datum eerstvolgende levering:</td>
                <td><input type="date" name="datum_Levering" id="datum_Levering"></td>
                <input type="hidden" value="<?= $data['Id']; ?>" name="leverancierId">
                <input type="hidden" value="<?= $data['ProductId']; ?>" name="productId">
            </tr>
        </table>
        <button type="submit">Submit</button>
    </form>

    <script>
        function validateDate() {
            var inputDate = new Date(document.getElementById("datum_Levering").value);
            var currentDate = new Date();

            if (inputDate < currentDate) {
                alert("Deze datum ligt in het verleden, voer alstublieft een nieuwe datum in.");
                return false;
            }
            return true;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
