function wywolajFunkcje(handlowiecId, obrazId, wynikId) {
    var obraz = document.getElementById(obrazId);
    obraz.src = handlowiecId + ".png";
    $.ajax({
        type: "POST",
        url: "wyniki2.php",
        data: { handlowiec_id: handlowiecId },
        success: function (response) {
            document.getElementById(wynikId).innerHTML = response;
        }
    });
}