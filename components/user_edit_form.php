<?php
include('services/user_edit_service.php');
?>

<div class="row justify-content-center">
    <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
        <h4 class="untertitle mb-1 mt-5">Edit User Information</h4>
        <hr>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-2 mt-3">
                <!-- have to change this to be a dropdown menu -->
                <label for="salutation" class="left-align-label">Anrede:</label>
                <input type="text" class="form-control auth-input" name="salutation" value="<?php echo htmlspecialchars($user['salutation']); ?>">
            </div>
            <div class="mb-2">
                <label for="firstName" class="left-align-label">Vorname:</label>
                <input type="text" class="form-control auth-input" name="firstName" value="<?php echo htmlspecialchars($user['firstName']); ?>">
            </div>
            <div class="mb-2">
                <label for="middleName" class="left-align-label">Mittlerer Name:</label>
                <input type="text" class="form-control auth-input" name="middleName" value="<?php echo htmlspecialchars($user['middleName']); ?>">
            </div>
            <div class="mb-2">
                <label for="lastName" class="left-align-label">Nachname:</label>
                <input type="text" class="form-control auth-input" name="lastName" value="<?php echo htmlspecialchars($user['lastName']); ?>">
            </div>
            <div class="mb-2">
                <label for="birthDate" class="left-align-label">Geburtsdatum:</label>
                <input type="date" class="form-control auth-input" name="birthDate" value="<?php echo htmlspecialchars($user['birthDate']); ?>">
            </div>
            <div class="mb-2">
                <label for="email" class="left-align-label">E-Mail Adresse:</label>
                <input type="email" class="form-control auth-input" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>
            <div class="mb-2">
                <label for="userName" class="left-align-label">Benutzername:</label>
                <input type="text" class="form-control auth-input" name="userName" value="<?php echo htmlspecialchars($user['userName']); ?>">
            </div>
            <!-- separate password change into a standalone form -->
            <div class="mb-2">
                <label for="password" class="left-align-label">Passwort:</label>
                <input type="password" class="form-control auth-input" name="password">
            </div>
            <div class="mb-2">
                <label for="confirmPassword" class="left-align-label">Passwort Bestätigen:</label>
                <input type="password" class="form-control auth-input" name="confirmPassword">
            </div>
            <hr class="seperator">
            <button type="submit" class="btn btn-primary" name="edit">Save Changes</button>
        </form>
    </div>
</div>
