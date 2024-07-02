<?php
include('services/user_service.php');
?>

<div class="row justify-content-center">
    <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
        <h4 class="untertitle mb-1 mt-5">User Information</h4>
        <hr>
        <form>
            <div class="mb-2 mt-3">
                <label for="salutation" class="left-align-label">Salutation:</label>
                <input type="text" class="form-control auth-input" name="salutation" value="<?php echo htmlspecialchars($user['salutation']); ?>" readonly>
            </div>
            <div class="mb-2">
                <label for="firstName" class="left-align-label">First Name:</label>
                <input type="text" class="form-control auth-input" name="firstName" value="<?php echo htmlspecialchars($user['firstName']); ?>" readonly>
            </div>
            <div class="mb-2">
                <label for="middleName" class="left-align-label">Middle Name:</label>
                <input type="text" class="form-control auth-input" name="middleName" value="<?php echo htmlspecialchars($user['middleName']); ?>" readonly>
            </div>
            <div class="mb-2">
                <label for="lastName" class="left-align-label">Last Name:</label>
                <input type="text" class="form-control auth-input" name="lastName" value="<?php echo htmlspecialchars($user['lastName']); ?>" readonly>
            </div>
            <div class="mb-2">
                <label for="birthDate" class="left-align-label">Date of Birth:</label>
                <input type="date" class="form-control auth-input" name="birthDate" value="<?php echo htmlspecialchars($user['birthDate']); ?>" readonly>
            </div>
            <div class="mb-2">
                <label for="email" class="left-align-label">Email Address:</label>
                <input type="email" class="form-control auth-input" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            </div>
            <div class="mb-2">
                <label for="userName" class="left-align-label">Username:</label>
                <input type="text" class="form-control auth-input" name="userName" value="<?php echo htmlspecialchars($user['userName']); ?>" readonly>
            </div>
            <hr class="seperator">
            <p class="text mb-1 mt-3"><a href="index.php" class="text-link">Back to Homepage</a></p>
        </form>
    </div>
</div>
