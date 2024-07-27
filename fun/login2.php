<?php 
session_start();
include('includes/database.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($email)) {
        echo "Please enter your Email";
    } else if (empty($password)) {
        echo "Please enter the password";
    } else {
        
        $query = "SELECT * FROM users";
        $user_exists = false;
        $pass_correct = true;

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row["email"] == $email ) {
                    $user_exists = true;
                    if(password_verify($password, $row["pwd"])){
                    $_SESSION["USERNAME"] = $row["user_name"];
                    $_SESSION["NAME"] = $row["Name"];
                    $_SESSION["EMAIL"] = $row["email"];
                    $_SESSION["PHONE"] = $row["ph_no"];
                    $_SESSION["LOCATION"] = $row["location"];
                    header('Location: Homepage.php');
                    exit();
                    }
                    else{
                        $pass_correct = false;
                    }
                }
            }
        }
        if(!$pass_correct){
            echo "<script>window.location.href = 'login.php';</script>";
            echo "<script>document.addEventListener('DOMContentLoaded', function() {document.getElementById('LoginError').innerText = 'Enter correct password';})</script>";
        }
        if(!$user_exists){
            echo "<script>window.location.href = 'login.php';</script>";
            echo "<script>document.getElementById('LoginError').innerText = 'User doesn\'t exist'</script>";
        }
    }
}

?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="bg-gray-100 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg drop-shadow-2xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="login.php" method="post">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Your email
                            </label>
                            <div class="relative border rounded-lg">
                                <input type="text" id="email" name="email" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" autocomplete="email" required />
                                <label for="email" class="z-0 absolute text-sm text-gray-800 bg-transparent dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                    Enter your email
                                </label>
                            </div>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Password
                            </label>
                            <div class="relative border rounded-lg">
                                <input type="password" name="password" id="password" placeholder="••••••••" required class="z-50 block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                <label for="email" class="z-0 absolute text-sm text-gray-800 bg-transparent dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                    Enter your password
                                </label>
                            </div>
                        </div>



                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-sky-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-sky-600 dark:ring-offset-gray-800" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <a href="#" class="text-sm font-medium text-sky-600 hover:underline dark:text-sky-500">
                                Forgot password?
                            </a>
                        </div>
                        <button type="submit" class="w-full text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                            Sign in
                        </button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet?
                            <a href="register.php" class="font-medium text-sky-600 hover:underline dark:text-sky-500">
                                Sign up
                            </a>
                        </p>
                        <center><div id="LoginError" class="text-red-600 font-bold text-md mt-1"></div></center>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html> -->
<?php           
    
?>

