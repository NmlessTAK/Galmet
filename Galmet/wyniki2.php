<html>
<head>
    <title>Title</title>
</head>
<body>
<?php
$handlowiecId = $_POST['handlowiec_id'];
$conn = new mysqli("localhost", "root", "", "dystrybucja");
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}
$sql = "SELECT kody_pocztowe.kody_pocztowe, kody_pocztowe.id AS kod_id, handlowcy.imię AS handlowcy_imię, handlowcy.nazwisko, handlowcy.telefon, handlowcy.email, handlowcy.oze
        FROM kody_pocztowe
        INNER JOIN handlowcy
        ON kody_pocztowe.handlowiec_id = handlowcy.id
        WHERE handlowcy.id = '$handlowiecId'";
$result = $conn->query($sql);
$handlowiecWyswietlony = false;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (!$handlowiecWyswietlony) {
            echo "<p>" . $row['handlowcy_imię'] . " " . $row['nazwisko'] ."</p>";
            echo "<p>Telefon: " . $row['telefon'] . "</p>";
            echo "<p>Email: " . $row['email'] . "</p>";
            $handlowiecWyswietlony = true;
        }
        $kodyPocztowe = array();
        do {
            $kodyPocztowe[] = $row['kody_pocztowe'];
        } while ($row = $result->fetch_assoc());
        echo "<p>Kody pocztowe: " . implode(", ", $kodyPocztowe) . "</p>";
    }
} else {
    echo "Nie znaleziono wyników";
}
$conn->close();
?>
</body>