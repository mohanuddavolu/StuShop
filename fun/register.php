<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

    </style>
</head>

<body>
    <section class="bg-gray-100 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto  lg:py-0">
            <div class="w-full my-8 bg-white rounded-lg drop-shadow-2xl dark:shadow-2xl dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Register an Account
                    </h1>
                    <form id="registerForm" class="space-y-4 md:space-y-6" action="register.php" method="post">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                            <input type="text" id="name" name="name" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600" placeholder="Enter Your Name" required />
                            <div id="nameError" class="text-red-600 text-sm mt-1"></div>
                        </div>

                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" id="username" name="username" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600" placeholder="Name@123" required />
                            <div id="usernameError" class="text-red-600 text-sm mt-1"></div>
                        </div>

                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" name="password" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600" placeholder="••••••••" required />
                            <div id="passwordError" class="text-red-600 text-sm mt-1"></div>
                        </div>

                        <div>
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600" placeholder="••••••••" required />
                            <div id="confirmPasswordError" class="text-red-600 text-sm mt-1"></div>
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" id="email" name="email" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600" placeholder="name@example.com" required />
                            <div id="emailError" class="text-red-600 text-sm mt-1"></div>
                        </div>

                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600" placeholder="9876543210" required />
                            <div id="phoneError" class="text-red-600 text-sm mt-1"></div>
                        </div>

                        <div>
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                            <input type="text" id="location" name="location" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600" placeholder="City" required />
                            <div id="locationError" class="text-red-600 text-sm mt-1"></div>
                        </div>

                        <div class="flex items-center justify-center">
                            <button type="submit" class="w-full px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">Register</button>
                        </div>
                        <div id="RegisterError" class="text-red-600 text-sm mt-1"></div>
                    </form>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account?
                            <a href="login.php" class="font-medium text-sky-600 hover:underline dark:text-sky-500">
                                Sign in
                            </a>
                        </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm_password');
            const phoneInput = document.getElementById('phone');

            nameInput.addEventListener('input', validateName);
            usernameInput.addEventListener('input', validateuserName);
            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validateConfirmPassword);
            phoneInput.addEventListener('input', validatePhone);


            function validateName() {
                let name = nameInput.value;
                if (name.length <= 3 || /[^a-zA-Z\s]/.test(name)) {
                    document.getElementById('nameError').innerText = 'Name must be more than 3 letters and should not include special characters \n';
                    return false;
                } else {
                    document.getElementById('nameError').innerText = '';
                    return true;
                }
            }

            function validateuserName() {
                let name = usernameInput.value;
                if (name.length <= 3 || /[\s]/.test(name)) {
                    document.getElementById('usernameError').innerText = 'Username must be more than 3 letters and should not contain spaces';
                    return false;
                } else {
                    document.getElementById('usernameError').innerText = '';
                    return true;
                }
            }

            function validatePassword() {
                let password = passwordInput.value;
                let passwordErrors = [];
                if (password.length < 8) passwordErrors.push('more than 8 characters');
                if (!/[A-Z]/.test(password)) passwordErrors.push('at least one uppercase letter');
                if (!/[0-9]/.test(password)) passwordErrors.push('at least one number');
                if (!/[^a-zA-Z0-9]/.test(password)) passwordErrors.push('at least one special character');

                document.getElementById('passwordError').innerText = passwordErrors.length > 0 ? 'Password must include ' + passwordErrors.join('\n ') + '.' : '';
                return passwordErrors.length === 0;
            }

            function validateConfirmPassword() {
                let confirmPassword = confirmPasswordInput.value;
                if (passwordInput.value !== confirmPassword) {
                    document.getElementById('confirmPasswordError').innerText = 'Passwords do not match.';
                    return false;
                } else {
                    document.getElementById('confirmPasswordError').innerText = '';
                    return true;
                }
            }

            function validatePhone() {
                let phone = phoneInput.value;
                if (!/^[6789]\d{9}$/.test(phone)) {
                    document.getElementById('phoneError').innerText = 'Phone number must be 10 digits and start with 6, 7, 8, or 9.';
                    return false;
                } else {
                    document.getElementById('phoneError').innerText = '';
                    return true;
                }
            }

        });
        
    </script>
</body>

</html>

<?php
include('includes/database.php');
echo "<script>document.getElementById('RegisterError').innerText = '';</script>";
                
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, "location", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        echo "Please enter your username";
    } else if (empty($password)) {
        echo "Please enter the password";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM users";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                if($row["user_name"]==$username && password_verify($password,$row["pwd"])){
                    echo "<script>document.getElementById('RegisterError').innerText = 'User Already exists, Please login';</script>";
                    echo "<script>alert('User Already exists, Please login);</script>";
                    exit();
                }
            }
        }

        $query = "INSERT INTO users (Name, user_name, email, pwd, ph_no, location) VALUES ('$name', '$username', '$email', '$hashed_password', '$phone', '$location')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo '<meta http-equiv="refresh" content="0;url=login.php">';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>