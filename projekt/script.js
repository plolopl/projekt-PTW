$(document).ready(function() {
    // Use event delegation in case elements are dynamically added
    $(document).on("click", ".fav", function() {
        const akapit = $(this);
        console.log("Fav clicked");
        $.post("changeFav.php", { idRajdu: akapit.data("rajd") }, function(data) {
            console.log("Response from changeFav.php: ", data); // Debug response
            if (data == "sukces") {
                const img = akapit.find("img");
                const newSrc = (img.attr("src") == "add.jpg") ? "out.jpg" : "add.jpg";
                img.attr("src", newSrc);
            }
        });
    });

    $(document).on("click", ".add", function() {
        const akapit = $(this);
        console.log("Add clicked");
        $.post("addtoparty.php", { idRajdu: akapit.data("rajd") }, function(data) {
            console.log("Response from addtoparty.php: ", data); // Debug response
            if (data == "sukces") {
                const img = akapit.find("img");
                const newSrc = (img.attr("src") == "dodaj.jpg") ? "usun.png" : "dodaj.jpg";
                img.attr("src", newSrc);
            }
        });
    });
});
$(document).ready(function() {
    $("#reportForm").on("submit", function(event) {
        event.preventDefault();
        $.post("submitReport.php", $(this).serialize(), function(data) {
            $("#reportMessage").text(data == "sukces" ? "Zgłoszenie wysłane pomyślnie" : "Błąd podczas wysyłania zgłoszenia");
        });
    });
});