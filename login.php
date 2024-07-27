<?php
session_start();
include('includes/database.php');
$user_exists = false;
$pass_correct = true;

function login()
{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty($email)) {
      echo "Please enter your Email";
    } else if (empty($password)) {
      echo "Please enter the password";
    } else {

      $query = "SELECT * FROM users";

      include('includes/database.php');
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row["email"] == $email) {
            global $user_exists;
            $user_exists = true;
            if (password_verify($password, $row["pwd"])) {
              $_SESSION["USERNAME"] = $row["user_name"];
              $_SESSION["USERID"] = $row["id"];
              $_SESSION["NAME"] = $row["Name"];
              $_SESSION["EMAIL"] = $row["email"];
              $_SESSION["PHONE"] = $row["ph_no"];
              $_SESSION["LOCATION"] = $row["location"];
              header('Location: Homepage.php');
              exit();
            } else {
              global $pass_correct;
              $pass_correct = false;
            }
          }
        }
      }
    }
  }
}

function signup()
{
  echo "<script>document.getElementById('RegisterError').innerText = '';</script>";
  echo "<script>alert('hi');</script>";

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

      include('includes/database.php');
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row["user_name"] == $username && password_verify($password, $row["pwd"])) {
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
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["login"])) {
    login();
  } 
  else {
    signup();
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css" />
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="login.php" method="post" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="email" type="text" placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="password" type="password" placeholder="Password" />
          </div>
          <div id="LoginError" class="text-red-600 font-bold text-md mt-1"></div>
          <input name="login" type="submit" value="Login" id="btn" />
        </form>

        <form action="login.php" method="post" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="name" id="name" type="text" placeholder="Name" />
          </div>
          <div id="nameError" class="text-red-600 text-sm mt-1"></div>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input name="username" id="username" type="text" placeholder="Username" />
          </div>
          <div id="usernameError" class="text-red-600 text-sm mt-1"></div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input name="email" id="email" type="email" placeholder="Email" />
          </div>
          <div id="emailError" class="text-red-600 text-sm mt-1"></div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="password" id="password" type="password" placeholder="Password" />
          </div>
          <div id="passwordError" class="text-red-600 text-sm mt-1"></div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="confirm_password" id="confirm_password" type="password" placeholder="confirm password" />
          </div>
          <div id="confirmPasswordError" class="text-red-600 text-sm mt-1"></div>
          <div class="input-field">
            <i class="fa fa-phone"></i>
            <input name="phone" id="phone" type="number" placeholder="Phone number" />
          </div>
          <div id="phoneError" class="text-red-600 text-sm mt-1"></div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input name="location" id="location" type="text" placeholder="Location" />
          </div>
          <div id="locationError" class="text-red-600 text-sm mt-1"></div>

          <div id="RegisterError" class="text-red-600 font-bold text-md mt-1"></div>
          <input name="signup" type="submit" id="btn1" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>Enter your details and start your journey with us</p>
          <button class="btn transparent" id="sign-up-btn" id="btn">Sign up</button>
        </div>
        <img src="https://raw.githubusercontent.com/LoginRadius/awesome-login-pages/4cbd3b38490e50478c181219c365875cb676ca37/login-form-v34/img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            To keep connected with us please login with your personal info
          </p>
          <button class="transparent" id="sign-in-btn" id="btn">Sign in</button>
        </div>
        <img src="https://raw.githubusercontent.com/LoginRadius/awesome-login-pages/4cbd3b38490e50478c181219c365875cb676ca37/login-form-v34/img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>
  <script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
    });
  </script>
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
echo "<script>document.addEventListener('DOMContentLoaded', function() {document.getElementById('LoginError').innerText = '';})</script>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!$user_exists) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {document.getElementById('LoginError').innerText = 'User doesn\'t exist'})</script>";
  } elseif (!$pass_correct) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {document.getElementById('LoginError').innerText = 'Enter correct password';})</script>";
  } else {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {document.getElementById('LoginError').innerText = '';})</script>";
  }
}
?>