<?php
session_start();
include('includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=melodrama@400,600,700,1,500&f[]=plus-jakarta-sans@800,401,501,400,601,500,600,700,701&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@1,600&display=swap" rel="stylesheet">
    <style>
        .box {
            width: 18vmax;
            /* aspect-ratio: 3/ 2; */
            position: absolute;
            transition: z-index 400ms ease;
            animation: float 3s ease infinite;
        }

        .box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .box:nth-child(1) {
            top: 20%;
            left: 15%;
            z-index: 1;
            scale: 1.15;
            animation-direction: forwards;
        }

        .box:nth-child(2) {
            bottom: 9%;
            left: 10%;
            z-index: 2;
            scale: 1.1;
            animation-direction: reverse;
        }

        .box:nth-child(3) {
            bottom: 16%;
            right: 10%;
            z-index: 3;
            animation-direction: forwards;
        }

        .box:nth-child(4) {
            top: 15%;
            right: 20%;
            animation-direction: reverse;
            z-index: 3;
            scale: 1.25;
        }

        @keyframes float {

            0%,
            100% {
                transform: translatey(0);
            }

            50% {
                transform: translatey(10%);
            }
        }

        #slogan {
            width: 100%;
            height: 100%;
            position: absolute;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 50px;
            text-wrap: nowrap;
        }

        .normal {
            font-family: "Plus Jakarta Sans", sans-serif;
            font-size: 4vmax;
            line-height: 70%;
            font-weight: 200;
        }

        .fancy {
            font-family: "Melodrama", serif;
            font-style: italic;
            padding: 0px 5px;
            line-height: 70%;
            color: #ef233c;
            font-weight: 800;
        }

        .image-container {
            position: relative;
            width: 80%;
            height: calc(80%);
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: auto;
            transition: transform .2s;
        }

        .image-container:hover img {
            transform: scale(1.2);
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.6);
            overflow: hidden;
            width: 100%;
            height: 0;
            transition: .5s ease;
        }

        .image-container:hover .overlay {
            overflow: hidden;
            height: 100%;
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .img-container {
            margin-left: 60px;
            display: flex;
        }
        h1{
            font-family: "Melodrama", serif;
            font-style: italic;
            text-align: center;
            color: #FFBB64;
            font-weight: 800;
        }
        .hero{
            height: 90vh;
        }
    </style>
</head>

<body>
    <div class="hero">
        <div class="py-4">
            <div class="mt-4">
                <div class="box"><img src="https://thumbs.dreamstime.com/b/tablet-pc-lying-open-enpty-book-engineering-drawings-tools-close-industrial-concept-47155803.jpg?w=768" alt="product image" /> </div>
                <div class="box"><img src="https://m.media-amazon.com/images/I/51hd+VIvIjL._AC_UF1000,1000_QL80_.jpg" alt="product image" /> </div>
                <div class="box"><img src="https://media.istockphoto.com/id/1127259379/video/chemistry-professor-doctor-holding-tube-are-using-ideas-in-a-lab-science.jpg?s=640x640&k=20&c=FQuNMHJzNGmmi_Q6NPhUmbUwJzGoX74hoZWR3HGRm-E=" alt="product image" /> </div>
                <div class="box"><img src="https://media.istockphoto.com/id/135940655/photo/calculating-cash.jpg?s=612x612&w=0&k=20&c=JwAPHnZQMc7-C-ez73mK5H2VhaHd-hajPzQq_UbvJ8M=" alt="product image" /> </div>

                <div id="slogan">
                    <h2 class="normal">Upgrade Your Academic Adventure</h2>
                    <h2 class="normal"> Elevate Everyday Essentials with a Touch of </h2>
                    <h2 class="normal"><span class="fancy">Student Style</span></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-[#FFEAA7]">
    <h1 class="text-5xl py-8">Our Products</h1>
    <div class="img-container">
        <a href="product.php">
        <div class="image-container">
            <img src="https://thumbs.dreamstime.com/b/tablet-pc-lying-open-enpty-book-engineering-drawings-tools-close-industrial-concept-47155803.jpg?w=768" alt="Image 1">
            <div class="overlay">
                <div class="text">Geometry kit</div>
            </div>
        </div>
        </a>
        <a href="product.php">
        <div class="image-container">
            <img src="https://m.media-amazon.com/images/I/51hd+VIvIjL._AC_UF1000,1000_QL80_.jpg" alt="Image 2">
            <div class="overlay">
                <div class="text">Drafter</div>
            </div>
        </div>
        </a>
        <a href="product.php">
        <div class="image-container">
            <img src="https://media.istockphoto.com/id/135940655/photo/calculating-cash.jpg?s=612x612&w=0&k=20&c=JwAPHnZQMc7-C-ez73mK5H2VhaHd-hajPzQq_UbvJ8M=" alt="Image 3">
            <div class="overlay">
                <div class="text">Calculator</div>
            </div>
        </div>
        </a>
    </div>
    </div>
</body>

</html>
<?php
include('includes/footer.php')
?>