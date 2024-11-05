<form id="reportForm">
    <input type="text" name="tresc" placeholder="Zgłoś problem">
    <button type="submit">Wyślij</button>
</form>
<div id="reportMessage"></div>

<script>
    $(document).ready(function() {
        $("#reportForm").on("submit", function(event) {
            event.preventDefault();
            $.post("submitReport.php", $(this).serialize(), function(data) {
                $("#reportMessage").text(data == "sukces" ? "Zgłoszenie wysłane pomyślnie" : "Błąd podczas wysyłania zgłoszenia");
            });
        });
    });
</script>
