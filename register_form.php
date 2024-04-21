<form method="POST" action="register_service.php">

    <div class="mb-2">
         <label for="salutation" class="left-align-label">Anrede:</label>
        <select class="form-select auth-select mb-2" name="salutation" required>
            <option value="Keine Angabe" disabled selected hidden>Keine Angabe</option>
            <option value="Herr">Herr</option>
            <option value="Frau">Frau</option>
        </select>
    </div>

    <div class="mb-2">
        <label for="firstName" class="left-align-label">Vorname:</label>
        <input type="text" class="form-control auth-input" name="firstName" required>
    </div>

    <div class="mb-2">
        <label for="middleName" class="left-align-label">Mittlerer Name:</label>
        <input type="text" class="form-control auth-input" name="middleName">
    </div>
    
    <div class="mb-2">
        <label for="lastName" class="left-align-label">Nachname:</label>
        <input type="text" class="form-control auth-input" name="lastName" required>
    </div>

    <div class="mb-2">
        <label for="birthDate" class="left-align-label">Geburtsdatum:</label>
        <input type="date" class="form-control auth-input" name="birthDate" required>
    </div>

    <div class="mb-2">
        <label for="mail" class="left-align-label">E-Mail Adresse:</label>
        <input type="email" class="form-control auth-input" name="email" required>
    </div>

    <div class="mb-2">
        <label for="userName" class="left-align-label">Benutzername:</label>
        <input type="text" class="form-control auth-input" name="userName" required>
    </div>

    <div class="mb-2">
        <label for="password" class="left-align-label">Passwort:</label>
        <input type="password" class="form-control auth-input" name="password" required>
    </div>

    <div class="mb-2">
        <label for="password" class="left-align-label">Passwort wiederholen:</label>
        <input type="password" class="form-control auth-input" name="passwordControl" required>
    </div>

    <div class="mb-2">
        <button type="submit" class="btn auth-btn mt-3 mb-3" name="submit">Registrieren</button>
    </div>
        
    <hr>
        
    <p class="text mb-1 mt-3">Bereits einen Account? <a href="login.php" class="text-link">Zum Login</a></p>
    <p class="text mb-5">Zur&uuml;ck zur <a href="index.php" class="text-link">Startseite</a></p>

</form>