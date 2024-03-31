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

    <form action="<?= URLROOT ?>/leverancier/updateLeverancierDetails" method="post" onsubmit="return validateDate()">
        <table>
            <tr>
                <td>Naam:</td>
                <td><input type="text" name="naam" id="naam" min="1" max="50" required></td>
            </tr>
            <tr>
                <td>ContactPersoon:</td>
                <td><input type="text" name="contact_persoon" id="contact_persoon" min="1" max="50" required></td>
            </tr>            
            <tr>
                <td>LeverancierNummer:</td>
                <td><input type="text" name="leverancier_nummer" id="leverancier_nummer" min="1" max="50" required></td>
            </tr>            
            <tr>
                <td>Mobiel:</td>
                <td><input type="text" name="mobiel" id="mobiel" min="1" max="13" required oninput="checkMobileLength()"></td>
            </tr>            
            <tr>
                <td>Straatnaam:</td>
                <td><input type="text" name="straatnaam" id="straatnaam" min="1" max="50" required></td>
            </tr>            
            <tr>
                <td>Huisnummer:</td>
                <td><input type="text" name="huisnummer" id="huisnummer" min="1" max="50" required></td>
            </tr>        
            <tr>
                <td>Postcode:</td>
                <td><input type="text" name="postcode" id="postcode" min="1" max="50" required></td>
            </tr>
            <tr>         
                <td>Stad:</td>
                <td><input type="text" name="stad" id="stad" min="1" max="50" required></td>    
            </tr>
        </table>
        <button type="submit">Sla Op</button>
    </form>

    <button><a href="<?= URLROOT; ?>/Homepage/index.php/">Home</a></button>
    <button><a href="<?= URLROOT; ?>/Leverancier/index/">Terug</a></button>

    <script>
        function checkMobileLength() {
            var mobileInput = document.getElementById("mobiel");
            if (mobileInput.value.length > 13) {
                alert("Het telefoon nummer is te lang.");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
