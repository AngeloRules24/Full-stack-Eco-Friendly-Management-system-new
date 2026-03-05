<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <?php include "../header.php"?>
    <div class="registercontainer">
        <h1>Create an Account</h1>
        <div class="form">
            <form id="registrationform" action="insertnewuser.php" method="post">
                <div class="formgroup">
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" placeholder="e.g. johnsmith" value="<?php echo isset($_GET['username']) ? htmlspecialchars($_GET['username']) : ''; ?>">
                    <div class="errormessage" id="usernameerror">Username must be 3-20 characters (letters, numbers, underscores only)</div>
                    <div class="errormessage" id="usernametaken">Username already taken!</div>
                </div>

                <div class="formgroup">
                    <label for="email">Email address:</label>
                    <input type="text" name="email" id="email" placeholder="e.g. johnsmith@gmail.com" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
                    <div class="errormessage" id="emailerror">Please enter a valid email address</div>
                </div>

                <div class="formgroup">
                    <label for="phone">Phone number:</label>
                    <input type="text" name="phone" id="phone" placeholder="e.g. 0123456789" value="<?php echo isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : ''; ?>">
                    <div class="errormessage" id="phoneerror">Please enter a valid phone number</div>
                    <div class="errormessage" id="accountexistserror">Account already exists!</div>
                </div>

                <div class="formgroup">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="registerbutton">
                    <input type="submit" value="Register">
                </div>
            </form>
            <div class="additionaloptions">
                <a href="login.php">Already have an account? Sign In</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationform');
            const usernameInput = document.getElementById('username');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const passwordInput = document.getElementById('password');
            
            const usernameError = document.getElementById('usernameerror');
            const usernameTaken = document.getElementById('usernametaken');
            const emailError = document.getElementById('emailerror');
            const phoneError = document.getElementById('phoneerror');
            const accountExistsError = document.getElementById('accountexistserror');
            
            const urlParams = new URLSearchParams(window.location.search);
            const errorType = urlParams.get('error');
            
            if (errorType === 'username_taken') {
                usernameInput.classList.add('error');
                usernameTaken.style.display = 'block';
                usernameInput.focus();
            }
            
            if (errorType === 'account_exists') {
                phoneInput.classList.add('error');
                accountExistsError.style.display = 'block';
                phoneInput.focus();
            }

            function validateUsername() {
                const username = usernameInput.value.trim();
                
                if (username.length < 3 || username.length > 20) {
                    usernameInput.classList.add('error');
                    usernameError.style.display = 'block';
                    usernameTaken.style.display = 'none';
                    return false;
                }
                
                const usernameRegex = /^[a-zA-Z0-9_]+$/;
                if (!usernameRegex.test(username)) {
                    usernameInput.classList.add('error');
                    usernameError.style.display = 'block';
                    usernameTaken.style.display = 'none';
                    return false;
                }
                
                usernameInput.classList.remove('error');
                usernameError.style.display = 'none';
                usernameTaken.style.display = 'none';
                return true;
            }
            
            function validateEmail() {
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                const validDomains = ['gmail.com', 'yahoo.com', 'outlook.com'];
                
                if (!emailRegex.test(email)) {
                    emailInput.classList.add('error');
                    emailError.style.display = 'block';
                    return false;
                }
                
                const domain = email.split('@')[1].toLowerCase();
                
                if (!validDomains.includes(domain)) {
                    emailInput.classList.add('error');
                    emailError.style.display = 'block';
                    return false;
                }
                
                emailInput.classList.remove('error');
                emailError.style.display = 'none';
                return true;
            }
            
            function validatePhone() {
                const phone = phoneInput.value.trim();
                const phoneRegex = /^01\d{8,9}$/;
                
                if (!phoneRegex.test(phone)) {
                    phoneInput.classList.add('error');
                    phoneError.style.display = 'block';
                    accountExistsError.style.display = 'none';
                    return false;
                } else {
                    phoneInput.classList.remove('error');
                    phoneError.style.display = 'none';
                    accountExistsError.style.display = 'none';
                    return true;
                }
            }
            
            function validateForm() {
                const isUsernameValid = validateUsername();
                const isEmailValid = validateEmail();
                const isPhoneValid = validatePhone();
                
                return isUsernameValid && isEmailValid && isPhoneValid;
            }
            
            usernameInput.addEventListener('input', function() {
                if (usernameInput.classList.contains('error')) {
                    usernameInput.classList.remove('error');
                    usernameError.style.display = 'none';
                    usernameTaken.style.display = 'none';
                }
            });

            phoneInput.addEventListener('input', function() {
                if (phoneInput.classList.contains('error')) {
                    phoneInput.classList.remove('error');
                    phoneError.style.display = 'none';
                    accountExistsError.style.display = 'none';
                }
            });

            emailInput.addEventListener('input', function() {
                if (emailInput.classList.contains('error')) {
                    emailInput.classList.remove('error');
                    emailError.style.display = 'none';
                }
            });
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (validateForm()) {
                    form.submit();
                } else {
                    if (!validateUsername()) {
                        usernameInput.focus();
                    } else if (!validateEmail()) {
                        emailInput.focus();
                    } else if (!validatePhone()) {
                        phoneInput.focus();
                    }
                }
            });
        });
    </script>
    <?php include "../footer.php"?>
</body>
</html>