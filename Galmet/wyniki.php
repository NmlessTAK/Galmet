<html>
<head>
    <title>Title</title>
    <style type="text/css">
      body{
        background-color: black;
        color: white;
        font-family: Arial;
      }
      h1{
        text-align:center;
      }
    </style>
</head>
<body>
<?php
  $conn = new mysqli("localhost", "root", "", "dystrybucja");
  if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
  }
  $wyszukiwarka = $_POST['wyszukiwarka'];
  $sql = "SELECT kody_pocztowe.kody_pocztowe, kody_pocztowe.id, handlowcy.imię, handlowcy.nazwisko, handlowcy.telefon, handlowcy.email, handlowcy.oze
          FROM kody_pocztowe
          INNER JOIN handlowcy
          ON kody_pocztowe.handlowiec_id = handlowcy.id
          WHERE '$wyszukiwarka' LIKE CONCAT(kody_pocztowe.kody_pocztowe, '%') OR kody_pocztowe.kody_pocztowe LIKE CONCAT('$wyszukiwarka', '%')";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    echo "<h1>Wyniki wyszukiwania</h1>";
    echo "<hr>";
    while ($row = $result->fetch_assoc()) {
      echo "<h2>" . $row['kody_pocztowe'] . "</h2>";
      echo "<p> " . $row['imię'] . " " . $row['nazwisko'] ."</p>";
      echo "<p> " . $row['telefon'] . "</p>";
      echo "<p> " . $row['email'] . "</p>";
      echo "<p>OZE: " . $row['oze'] . "</p>"; 
      echo "<p> ID w bazie danych: " . $row['id'] . "</p>";
      echo "<hr>";
    }
  } else {
    echo "Nie znaleziono wyników";
  }
  $conn->close();
?>
</body>