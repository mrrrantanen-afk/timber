<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html#yhteys");
    exit;
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $message === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "<h2>Viestin lähetys epäonnistui.</h2>";
    echo "<p>Tarkista lomakkeen tiedot ja yritä uudelleen.</p>";
    echo "<p><a href='index.html#yhteys'>Palaa takaisin</a></p>";
    exit;
}

$to = "mr.r.rantanen@gmail.com";
$subject = "Uusi yhteydenotto verkkosivuilta";

$safeName = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
$safeEmail = htmlspecialchars($email, ENT_QUOTES, "UTF-8");
$safeMessage = htmlspecialchars($message, ENT_QUOTES, "UTF-8");
$headerName = str_replace(["\r", "\n"], "", $name);
$headerEmail = str_replace(["\r", "\n"], "", $email);

$body = "Nimi: {$safeName}\n";
$body .= "Sähköposti: {$safeEmail}\n\n";
$body .= "Viesti:\n{$safeMessage}\n";

$headers = [
    "From: Timber Oy <no-reply@timber.fi>",
    "Reply-To: {$headerName} <{$headerEmail}>",
    "Content-Type: text/plain; charset=UTF-8",
];

if (mail($to, $subject, $body, implode("\r\n", $headers))) {
    echo "<h2>Viesti lähetetty onnistuneesti!</h2>";
    echo "<p><a href='index.html'>Palaa takaisin</a></p>";
} else {
    http_response_code(500);
    echo "<h2>Viestin lähetys epäonnistui.</h2>";
    echo "<p><a href='index.html#yhteys'>Palaa takaisin</a></p>";
}
?>
