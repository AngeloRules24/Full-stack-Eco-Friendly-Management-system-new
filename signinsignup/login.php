<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="login.css">
</head>


<body>
    <?php include "../header.php"?>
    <div class="logincontainer">
        <h1>Login</h1>
        <div class="form">
            <form id="loginform" action="userexistence.php" method="post">
                <div class="formgroup">
                    <label for="phone">Phone number:</label>
                    <input type="text" name="phone" id="phone" placeholder="e.g. 0123456789" value="<?php echo isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : ''; ?>">
                    <div class="errormessage" id="phoneerror">Please enter a valid phone number</div>
                    <div class="errormessage" id="accountdoesnotexisterror">Account does not exist!</div>
                </div>

                <div class="formgroup">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                    <div class="errormessage" id="passworderror">Incorrect password</div>
                </div>

                <div class="loginbutton">
                    <input type="submit" value="Login">
                </div>
            </form>
            <div class="additionaloptions">
                <a href="register.php">Don't have an account? Register</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginform');
            const phoneInput = document.getElementById('phone');
            const passwordInput = document.getElementById('password');
            const phoneError = document.getElementById('phoneerror');
            const passwordError = document.getElementById('passworderror');
            const accountdoesnotexistError = document.getElementById('accountdoesnotexisterror');

            const urlParams = new URLSearchParams(window.location.search);
            const errorType = urlParams.get('error');
            
            if (errorType === 'wrong_password') {
                passwordInput.classList.add('error');
                passwordError.style.display = 'block';
                passwordInput.focus();
            } else if (errorType === 'account_not_exist') {
                phoneInput.classList.add('error');
                accountdoesnotexistError.style.display = 'block';
                phoneInput.focus();
            } else if (errorType === 'invalid_phone') {
                phoneInput.classList.add('error');
                phoneError.style.display = 'block';
                phoneInput.focus();
            }

            function validatePhone() {
                const phone = phoneInput.value.trim();
                const phoneRegex = /^01\d{8,9}$/;
                
                if (!phoneRegex.test(phone)) {
                    phoneInput.classList.add('error');
                    phoneError.style.display = 'block';
                    return false;
                } else {
                    phoneInput.classList.remove('error');
                    phoneError.style.display = 'none';
                    accountdoesnotexistError.style.display = 'none';
                    return true;
                }
            }

            function validatePassword() {
                const password = passwordInput.value.trim();
                
                if (password === '') {
                    passwordInput.classList.add('error');
                    passwordError.style.display = 'block';
                    return false;
                } else {
                    passwordInput.classList.remove('error');
                    passwordError.style.display = 'none';
                    return true;
                }
            }

            function validateForm() {
                const isPhoneValid = validatePhone();
                const isPasswordValid = validatePassword();
                
                return isPhoneValid && isPasswordValid;
            }

            phoneInput.addEventListener('input', function() {
                if (phoneInput.classList.contains('error')) {
                    phoneInput.classList.remove('error');
                    phoneError.style.display = 'none';
                    accountdoesnotexistError.style.display = 'none';
                }
            });

            passwordInput.addEventListener('input', function() {
                if (passwordInput.classList.contains('error')) {
                    passwordInput.classList.remove('error');
                    passwordError.style.display = 'none';
                }
            });

            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    
                    if (!validatePhone()) {
                        phoneInput.focus();
                    } else if (!validatePassword()) {
                        passwordInput.focus();
                    }
                }
            });
        });
    </script>

    <?php include "../footer.php"?>
</body>
</html>