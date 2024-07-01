<div class="row justify-content-center">
        
    <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
        
        <h4 class="untertitle mb-1 mt-5">Login</h4>
        
        <hr>
                
        <form action="services/login_service.php" method="post">
                    
            <div class="mb-2 mt-3">
                <label for="userName" class="left-align-label">Username:</label>
                <input type="text" class="form-control auth-input" name="userName" required>
            </div>
                        
            <div class="mb-3 mt-2">
                <label for="password" class="left-align-label">Password:</label>
                <div class="mb-3 mt-2">
                    <input type="password" class="form-control auth-input" name="password" id="password" required>
                </div>
            </div>
                        
            <button class="btn auth-btn mt-2 mb-3">Sign in</button>
                        
            <hr class="seperator">
    
            <p class="text mb-1 mt-3">No account yet? <a href="register.php" class="text-link">Create an account</a></p>
            <p class="mb-5">Back to <a href="index.php" class="text-link">Home Page</a></p>
                    
        </form>

    </div>
        
</div>
