<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <form id="updateForm" method="post" autocomplete="off">
                <div class="mb-3 mt-3">
                    <label for="salutation" class="form-label">Salutation</label>
                    <input type="text" required class="form-control" id="salutation" name="salutation" placeholder="Salutation">
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="text" required class="form-control" id="firstName" name="firstName" placeholder="First name">
                </div>
                <div class="mb-3">
                    <label for="middleName" class="form-label">Middle name</label>
                    <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middle name">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last name</label>
                    <input type="text" required class="form-control" id="lastName" name="lastName" placeholder="Last name">
                </div>
                <div class="mb-3">
                    <label for="userName" class="form-label">User name</label>
                    <input type="text" required class="form-control" id="userName" name="userName" placeholder="User name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" required class="form-control" id="email" name="email" placeholder="Email address">
                </div>
                <div class="mb-3">
                    <label for="birthDate" class="form-label">Birth date</label>
                    <input type="date" class="form-control" id="birthDate" name="birthDate">
                </div>
                <button name="edit" type="button" class="btn btn-primary" onclick="updateAccount()">Edit account</button>
            </form>
        </div>
        <a class="btn btn-danger mt-4" href="logout_service.php">Logout</a>
    </div>

    <script>
        // JavaScript-Funktion zum Aktualisieren des Benutzerkontos
        function updateAccount() {
            // Formulardaten sammeln
            var formData = new FormData(document.getElementById("updateForm"));
            // AJAX-Anfrage senden, um Benutzerdaten zu aktualisieren
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_profile.php", true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Erfolgsfall: Aktualisierte Daten anzeigen
                    var userData = JSON.parse(xhr.responseText);
                    document.getElementById("salutation").value = userData.salutation;
                    document.getElementById("firstName").value = userData.firstName;
                    document.getElementById("middleName").value = userData.middleName;
                    document.getElementById("lastName").value = userData.lastName;
                    document.getElementById("userName").value = userData.userName;
                    document.getElementById("email").value = userData.email;
                    document.getElementById("birthDate").value = userData.birthDate;
                    // Erfolgsmeldung anzeigen
                    alert("Update erfolgreich");
                } else {
                    // Fehlerfall: Fehlermeldung anzeigen
                    alert("Fehler: " + xhr.responseText);
                }
            };
            xhr.onerror = function() {
                // Fehlerfall: Fehlermeldung anzeigen
                alert("Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.");
            };
            xhr.send(formData);
        }
    </script>
</body>

</html>
