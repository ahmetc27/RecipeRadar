<?php
require "services/userdetails_service.php";
?>

<head>
    <?php require "components/head.php" ?>
</head>

<header>
    <?php include('components/navigation.php'); ?>
</header>

<body>
    <main>
    <div class="container" style="max-width: 700px; margin-top: 140px; overflow-y: auto;">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                <h4 class="untertitle mb-1 mt-5">User Details</h4>
                <hr>
                <form method="post" action="">
                    <div class="mb-2">
                        <label for="userType" class="left-align-label">User Type:</label>
                        <select class="form-control auth-input" name="userType">
                            <option value="admin" <?php if ($user['type'] == 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="user" <?php if ($user['type'] == 'user') echo 'selected'; ?>>User</option>
                        </select>
                    </div>
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
                        <label for="userName" class="left-align-label">Username:</label>
                        <input type="text" class="form-control auth-input" name="userName" value="<?php echo htmlspecialchars($user['userName']); ?>" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="birthDate" class="left-align-label">Birth Date:</label>
                        <input type="date" class="form-control auth-input" name="birthDate" value="<?php echo htmlspecialchars($user['birthDate']); ?>" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="left-align-label">Email Address:</label>
                        <input type="email" class="form-control auth-input" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5 mt-2">Update User Type</button>
                </form>
            </div>
        </div>
    </div>
    </main>
    <?php include('components/footer.php'); ?>
</body>
