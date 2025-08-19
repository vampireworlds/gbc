<?php
header("Content-Type: application/json");

// Zieladresse für Buchungsbestätigung
$to = "vampires1337@gmail.com";

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $subject = "Neue Buchung - Gasal Beauty Center";
    $message = "
Neue Buchung:

Name: {$data['firstName']} {$data['lastName']}
E-Mail: {$data['email']}
Telefon: {$data['phone']}
Service: {$data['service']}
Datum: {$data['date']}
Uhrzeit: {$data['time']}
Notizen: {$data['notes']}
Buchungs-ID: {$data['id']}
";

    $headers = "From: noreply@gasal-beauty.de\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Mailfunktion fehlgeschlagen"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Keine Daten empfangen"]);
}
?>
