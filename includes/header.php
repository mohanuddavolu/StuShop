<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class='sticky top-0 z-50'>
    <nav class="bg-[#DADDB1] border-gray-200 ">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="Homepage.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="data:image/png;base64,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" class="h-8" alt="Swara Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-gray-900">Anits OLx</span>
            </a>
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                <?php 
                    if(!isset($_SESSION["USERNAME"])) :
                ?>      
                    <a href="\project 1\login.php"><button type="button" class="text-white bg-[#6DA4AA] hover:bg-[#647D87] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Login/signup</button></a>
                <?php else : ?>
                    <a href="sell.php"><button class="text-white bg-[#6DA4AA] hover:bg-[#647D87] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none dark:focus:ring-sky-800">Sell</button></a>
                    <form action="logout.php" method="post">
                        <button type="submit" class="text-white bg-[#6DA4AA] hover:bg-[#647D87] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2  focus:outline-none dark:focus:ring-blue-800">Log out</button>
                    </form>
                <?php endif; ?>
                </div>
        </div>
    </nav>
</header>

</body>
</html>