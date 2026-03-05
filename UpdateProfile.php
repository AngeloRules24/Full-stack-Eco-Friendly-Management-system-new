<?php

include "conn.php";
$base_path = '/rwdd/RWDD group assignment/'; 
include "header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: " . $base_path . "signinsignup/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Load user's current data
$stmt = mysqli_prepare($dbConn, "SELECT * FROM user WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user_data = mysqli_fetch_assoc($result);

if (!$user_data) {
    die("User not found - Tried to load user ID: " . $user_id);
}

// Initialize error variables
$phone_exists_error = false;
$email_invalid_error = false;
$email_domain_error = false;
$username_taken_error = false;

// Handle profile updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['firstName'])) {
        $userName = mysqli_real_escape_string($dbConn, $_POST['userName']);
        $firstName = mysqli_real_escape_string($dbConn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($dbConn, $_POST['lastName']);
        $email = mysqli_real_escape_string($dbConn, $_POST['email']);
        $phone = mysqli_real_escape_string($dbConn, $_POST['phone']);
        
        // Check if username already exists for OTHER users
        $check_username_stmt = mysqli_prepare($dbConn, "SELECT user_id FROM user WHERE user_name = ? AND user_id != ?");
        mysqli_stmt_bind_param($check_username_stmt, "si", $userName, $user_id);
        mysqli_stmt_execute($check_username_stmt);
        $username_result = mysqli_stmt_get_result($check_username_stmt);
        
        if (mysqli_num_rows($username_result) > 0) {
            // Username already exists for another user
            $username_taken_error = true;
        } else {
            // Validate email format and domain
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_invalid_error = true;
            } else {
                // Check email domain
                $email_domain = strtolower(explode('@', $email)[1]);
                $allowed_domains = ['gmail.com', 'yahoo.com', 'outlook.com'];
                
                if (!in_array($email_domain, $allowed_domains)) {
                    $email_domain_error = true;
                } else {
                    // Check if phone already exists for OTHER users
                    $check_phone_stmt = mysqli_prepare($dbConn, "SELECT user_id FROM user WHERE user_phone = ? AND user_id != ?");
                    mysqli_stmt_bind_param($check_phone_stmt, "si", $phone, $user_id);
                    mysqli_stmt_execute($check_phone_stmt);
                    $phone_result = mysqli_stmt_get_result($check_phone_stmt);
                    
                    if (mysqli_num_rows($phone_result) > 0) {
                        // Phone number already exists for another user
                        $phone_exists_error = true;
                    } else {
                        // No conflicts, proceed with update
                        $stmt = mysqli_prepare($dbConn, "UPDATE user SET user_name = ?, user_firstname = ?, user_lastname = ?, user_email = ?, user_phone = ? WHERE user_id = ?");
                        mysqli_stmt_bind_param($stmt, "sssssi", $userName, $firstName, $lastName, $email, $phone, $user_id);
                        
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<script>alert('✅ Profile updated!');</script>";
                            // Update session username
                            $_SESSION['user_name'] = $userName;
                            // Reload data
                            $stmt = mysqli_prepare($dbConn, "SELECT * FROM user WHERE user_id = ?");
                            mysqli_stmt_bind_param($stmt, "i", $user_id);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $user_data = mysqli_fetch_assoc($result);
                        } else {
                            echo "<script>alert('❌ Error updating profile: " . mysqli_error($dbConn) . "');</script>";
                        }
                    }
                }
            }
        }
    }
}

// Handle account deletion
if (isset($_POST['delete_account'])) {
    $stmt = mysqli_prepare($dbConn, "DELETE FROM user WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        // Destroy session and redirect
        session_destroy();
        echo "<script>alert('✅ Account deleted successfully!'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        echo "<script>alert('❌ Error deleting account: " . mysqli_error($dbConn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="UpdateProfile.css">
    <script src="UpdateProfile.js" defer></script>
    <style>
        body, h1, h2, h3, h4, h5, h6, p, div, section, article {
            margin: 0;
            padding: 0;
        }

        header {
            position: static !important;
        }

        .errormessage {
            color: red;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        input.error {
            border-color: red;
            background-color: #ffe6e6;
        }
    </style>
</head>
<body>
    <div class="pageheader">
        <h1>Profile Settings</h1>
        <h2>Manage Profile - Editing: <?php echo $user_data['user_name']; ?> (ID: <?php echo $user_id; ?>)</h2>
    </div>
    
    <section class="edit">
        <h3>Edit Profile</h3>
        <form method="POST" action="" id="profileForm">
            <article>
                <label for="userName">Username</label>
                <input type="text" name="userName" id="userName" value="<?php echo htmlspecialchars($user_data['user_name']); ?>" required>
                <div class="errormessage" id="usernameerror">Username must be 3-20 characters (letters, numbers, underscores only)</div>
                <div class="errormessage" id="usernametaken">Username already taken!</div>

                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars($user_data['user_firstname']); ?>">
                
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($user_data['user_lastname']); ?>">

                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user_data['user_email']); ?>" required>
                <div class="errormessage" id="emailerror">Please enter a valid email address</div>
                <div class="errormessage" id="emaildomainerror">Only Gmail, Yahoo, and Outlook emails are allowed</div>
                
                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" id="phone" value="<?php echo htmlspecialchars($user_data['user_phone']); ?>" required>
                <div class="errormessage" id="phoneerror">Please enter a valid phone number (01 followed by 8-9 digits)</div>
                <div class="errormessage" id="accountexistserror">Phone number already exists!</div>
                
                <button type="submit" class="savebutton">Update Profile</button>
            </article>
        </form>
    </section>

    <section class="delete">
        <h3>Delete Account</h3>
        <article>
            <p>Deleting your account will remove all of your information from our database. This cannot be undone.</p>
            <form method="POST" action="" onsubmit="return confirmDelete()">
                <input type="hidden" name="delete_account" value="1">
                <button type="submit" class="deletebutton">Delete Account</button>
            </form>
        </article>
    </section>
    
    <?php include "footer.php"?>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete your account? This action cannot be undone!");
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('profileForm');
            const userNameInput = document.getElementById('userName');
            const firstNameInput = document.getElementById('firstName');
            const lastNameInput = document.getElementById('lastName');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const usernameError = document.getElementById('usernameerror');
            const usernameTaken = document.getElementById('usernametaken');
            const emailError = document.getElementById('emailerror');
            const emailDomainError = document.getElementById('emaildomainerror');
            const phoneError = document.getElementById('phoneerror');
            const accountExistsError = document.getElementById('accountexistserror');
            
            // Set initial error states from PHP
            <?php if ($username_taken_error): ?>
                userNameInput.classList.add('error');
                usernameTaken.style.display = 'block';
            <?php endif; ?>
            
            <?php if ($email_invalid_error): ?>
                emailInput.classList.add('error');
                emailError.style.display = 'block';
            <?php endif; ?>
            
            <?php if ($email_domain_error): ?>
                emailInput.classList.add('error');
                emailDomainError.style.display = 'block';
            <?php endif; ?>
            
            <?php if ($phone_exists_error): ?>
                phoneInput.classList.add('error');
                accountExistsError.style.display = 'block';
            <?php endif; ?>

            function validateUsername() {
                const username = userNameInput.value.trim();
                
                // Basic validation
                if (username.length < 3 || username.length > 20) {
                    userNameInput.classList.add('error');
                    usernameError.style.display = 'block';
                    usernameTaken.style.display = 'none';
                    return false;
                }
                
                // Username format validation (alphanumeric and underscores)
                const usernameRegex = /^[a-zA-Z0-9_]+$/;
                if (!usernameRegex.test(username)) {
                    userNameInput.classList.add('error');
                    usernameError.style.display = 'block';
                    usernameTaken.style.display = 'none';
                    return false;
                }
                
                userNameInput.classList.remove('error');
                usernameError.style.display = 'none';
                usernameTaken.style.display = 'none';
                return true;
            }

            function validateName(name) {
                const trimmed = name.trim();
                return trimmed.length >= 2;
            }

            function validateEmail() {
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function validateEmailDomain() {
                const email = emailInput.value.trim();
                if (!validateEmail()) return false;
                
                const domain = email.split('@')[1].toLowerCase();
                const allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com'];
                
                return allowedDomains.includes(domain);
            }

            function validatePhone() {
                const phone = phoneInput.value.trim();
                const phoneRegex = /^01\d{8,9}$/;
                return phoneRegex.test(phone);
            }

            function showError(element, errorElement) {
                element.classList.add('error');
                errorElement.style.display = 'block';
            }

            function hideError(element, errorElement) {
                element.classList.remove('error');
                errorElement.style.display = 'none';
            }

            function hideAllEmailErrors() {
                hideError(emailInput, emailError);
                hideError(emailInput, emailDomainError);
            }

            function hideAllUsernameErrors() {
                hideError(userNameInput, usernameError);
                hideError(userNameInput, usernameTaken);
            }

            function validateForm() {
                let isValid = true;

                // Validate username
                if (!validateUsername()) {
                    isValid = false;
                }

                // Validate first name
                if (firstNameInput.value.trim() !== '' && !validateName(firstNameInput.value)) {
                    isValid = false;
                    showError(firstNameInput, document.getElementById('nameerror'));
                } else {
                    hideError(firstNameInput, document.getElementById('nameerror'));
                }

                // Validate last name
                if (lastNameInput.value.trim() !== '' && !validateName(lastNameInput.value)) {
                    isValid = false;
                    showError(lastNameInput, document.getElementById('nameerror'));
                } else {
                    hideError(lastNameInput, document.getElementById('nameerror'));
                }

                // Validate email format and domain
                if (!validateEmail()) {
                    isValid = false;
                    showError(emailInput, emailError);
                    hideError(emailInput, emailDomainError);
                } else if (!validateEmailDomain()) {
                    isValid = false;
                    showError(emailInput, emailDomainError);
                    hideError(emailInput, emailError);
                } else {
                    hideAllEmailErrors();
                }

                // Validate phone format
                if (!validatePhone()) {
                    isValid = false;
                    showError(phoneInput, phoneError);
                    // Hide account exists error if phone format is invalid
                    hideError(phoneInput, accountExistsError);
                } else {
                    hideError(phoneInput, phoneError);
                    // Account exists error will be handled by PHP
                }

                return isValid;
            }

            // Real-time validation
            userNameInput.addEventListener('input', function() {
                hideAllUsernameErrors();
                
                if (this.value.trim() !== '') {
                    if (!validateUsername()) {
                        // Error will be shown by validateUsername function
                    }
                }
            });

            firstNameInput.addEventListener('input', function() {
                if (validateName(this.value)) {
                    hideError(this, document.getElementById('nameerror'));
                }
            });

            lastNameInput.addEventListener('input', function() {
                if (validateName(this.value)) {
                    hideError(this, document.getElementById('nameerror'));
                }
            });

            emailInput.addEventListener('input', function() {
                hideAllEmailErrors();
                
                if (this.value.trim() !== '') {
                    if (!validateEmail()) {
                        showError(this, emailError);
                    } else if (!validateEmailDomain()) {
                        showError(this, emailDomainError);
                    }
                }
            });

            phoneInput.addEventListener('input', function() {
                // Hide both phone errors when user starts typing
                hideError(this, phoneError);
                hideError(this, accountExistsError);
                
                // Show format error if phone is invalid (real-time)
                if (this.value.trim() !== '' && !validatePhone()) {
                    showError(this, phoneError);
                }
            });

            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    
                    // Focus on first error field
                    const firstError = form.querySelector('.error');
                    if (firstError) {
                        firstError.focus();
                    }
                }
            });
        });
    </script>
</body>
</html>