<div class="row justify-content-center">
        
    <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
        
        <h4 class="untertitle mb-1 mt-5">Register</h4>
        
        <hr>
                        
            <form method="POST" action="services/register_service.php">

                <div class="mb-2">
                    <label for="salutation" class="left-align-label">Salutation:</label>
                    <select class="form-select auth-input" name="salutation" required>
                        <option value="Keine Angabe" disabled selected hidden>No Selection</option>
                        <option value="Herr">Mr.</option>
                        <option value="Frau">Ms.</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label for="firstName" class="left-align-label">First Name:</label>
                    <input type="text" class="form-control auth-input" name="firstName" required>
                </div>

                <div class="mb-2">
                    <label for="middleName" class="left-align-label">Middle Name:</label>
                    <input type="text" class="form-control auth-input" name="middleName">
                </div>
                
                <div class="mb-2">
                    <label for="lastName" class="left-align-label">Last Name:</label>
                    <input type="text" class="form-control auth-input" name="lastName" required>
                </div>

                <div class="mb-2">
                    <label for="birthDate" class="left-align-label">Birth Date:</label>
                    <input type="date" class="form-control auth-input" name="birthDate" required>
                </div>

                <div class="mb-2">
                    <label for="mail" class="left-align-label">Email Address:</label>
                    <input type="email" class="form-control auth-input" name="email" required>
                </div>

                <div class="mb-2">
                    <label for="userName" class="left-align-label">Username:</label>
                    <input type="text" class="form-control auth-input" name="userName" required>
                </div>

                <div class="mb-2">
                    <label for="password" class="left-align-label">Password:</label>
                    <input type="password" class="form-control auth-input" name="password" required>
                </div>

                <div class="mb-2">
                    <label for="password" class="left-align-label">Repeat Password:</label>
                    <input type="password" class="form-control auth-input" name="passwordControl" required>
                </div>

                <div class="mb-2">
                    <button type="submit" class="btn auth-btn mt-3 mb-3" name="submit">Register</button>
                </div>
                    
                <hr>
                    
                <p class="text mb-1 mt-3">Already have an account? <a href="login.php" class="text-link">Login</a></p>
                <p class="text mb-5">Back to <a href="index.php" class="text-link">Home Page</a></p>

            </form>
        
    </div>
        
</div>
