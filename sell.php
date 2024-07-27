<?php
session_start();
include('includes/header.php');
$con = mysqli_connect("localhost", "root", "", "test") or die("connection failed" . mysqli_connect_error());
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $cat = $_POST["category"];
    $desc = $_POST["desc"];
    $user_id = $_SESSION["USERID"];
    if (isset($_FILES["photo"])) {
        $file = $_FILES["photo"]["name"];
        $filetmpname = $_FILES["photo"]["tmp_name"];
        $path = "images/" . basename($file);
        if (move_uploaded_file($filetmpname, $path)) {
            echo "Picture has been uploaded successfully";
        } else {
            echo "Failed to upload picture";
        }
    } else {
        echo "File input not set";
        exit();
    }
    $url=$path;
    $sql="INSERT INTO Products (`ProductName`, `Price`, `Category`, `Description`, `url`, `user_id`) VALUES ('$name', '$price', '$cat', '$desc', '$url', '$user_id')";
    $query=mysqli_query($con,$sql);
    if($query){
        echo "image has been uploaded to the database succesfully!thankyou";
    }
    echo '<meta http-equiv="refresh" content="0;url=product.php">';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>

<body>
    <section class="bg-[#EEEDEB] text-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Add a new product</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                        <input type="text" name="name" id="name" class="bg-[#F2F1EB] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type product name" required="">
                    </div>
                    <div class="w-full">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                        <input type="number" name="price" id="price" class="bg-[#F2F1EB] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  " placeholder="999/-" required="">
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                        <select id="category" name="category" class="bg-[#F2F1EB] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                            <option selected="" class="text-gray-400">Select category</option>
                            <option value="Drafter">Drafter</option>
                            <option value="Calculator">Calculator</option>
                            <option value="Apron">Apron</option>
                            <option value="Books">Books</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea id="description" name="desc" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-[#F2F1EB] rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Your description here"></textarea>
                    </div>
                </div>
                <label for="description" class="block mt-2 text-sm font-medium text-gray-900 ">Upload Photo</label>
                <div class="flex items-center justify-center w-full mt-3 mb-4">
                        
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-[#F2F1EB] hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500"> PNG, JPG or JPEG (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" name="photo" type="file" class="" required>
                    </label>
                </div>
                <center><button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-sky-700 rounded-lg focus:ring-4 focus:ring-sky-200 dark:focus:ring-sky-900 hover:bg-sky-800">
                    Add product
                </button></center>
            </form>
        </div>
    </section>
</body>

</html>
<?php
include('includes/footer.php')
?>