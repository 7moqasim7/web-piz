<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Besteloverzicht</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Besteloverzicht</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $naam = $_POST["naam"];
            $adres = $_POST["adres"];
            $postcode = $_POST["postcode"];
            $plaats = $_POST["plaats"];
            $besteldatum = $_POST["besteldatum"];
            $bezorgmethode = $_POST["bezorgmethode"];
            $gekozenPizzas = $_POST["pizza"];

            
            $pizzaPrices = [
                "Margherita" => 12.50,
                "Funghi" => 12.50,
                "Marina" => 13.95,
                "Hawai" => 11.50,
                "QuattroFormaggi" => 14.50
            ];

            
            function getDayOfWeek($date) {
                return date('l', strtotime($date));
            }

            function calculateDiscount($dayOfWeek, $totalPrice) {
                if ($dayOfWeek === 'Monday') {
                    return $totalPrice - 7.50;
                } elseif ($dayOfWeek === 'Friday' && $totalPrice > 20) {
                    return $totalPrice * 0.85;
                }
                return $totalPrice;
            }

          
            $totalPrice = 0;
            foreach ($gekozenPizzas as $pizza) {
                $totalPrice += $pizzaPrices[$pizza];
            }

          
            $bezorgkosten = ($bezorgmethode === "bezorgen") ? 5.00 : 0;

            
            $dayOfWeek = getDayOfWeek($besteldatum);

            
            $discountedPrice = calculateDiscount($dayOfWeek, $totalPrice);

          
            echo "<p><strong>Naam:</strong> $naam</p>";
            echo "<p><strong>Adres:</strong> $adres</p>";
            echo "<p><strong>Postcode:</strong> $postcode</p>";
            echo "<p><strong>Plaats:</strong> $plaats</p>";
            echo "<p><strong>Besteldatum:</strong> $besteldatum ($dayOfWeek)</p>";
            echo "<p><strong>Bezorgmethode:</strong> $bezorgmethode</p>";
            echo "<p><strong>Bestelde pizza's:</strong></p>";
            echo "<ul>";
            foreach ($gekozenPizzas as $pizza) {
                echo "<li>$pizza - €" . $pizzaPrices[$pizza] . "</li>";
            }
            echo "</ul>";
            echo "<p><strong>Totaalprijs:</strong> €$discountedPrice (Inclusief bezorgkosten: €$bezorgkosten)</p>";
        }
        ?>
    </div>
</body>
</html>
