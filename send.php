<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $to = "mr.r.rantanen@gmail.com";
    $subject = "Uusi yhteydenotto verkkosivuilta";

    $body = "Nimi: $name\n";
    $body .= "Sähköposti: $email\n\n";
    $body .= "Viesti:\n$message";

    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "<h2>Viesti lähetetty onnistuneesti!</h2>";
        echo "<p><a href='index.html'>Palaa takaisin</a></p>";
    } else {
        echo "<h2>Viestin lähetys epäonnistui.</h2>";
    }
}
?>
