<?php
session_start();
include('includes/header.php');
include('includes/database.php');
?>

<html>
<link rel="stylesheet" href="card.css">
<script>
    function addCard(ProductName, Category, Desc, Price, url, Name, Phone){
        console.log(1);
            console.log(2);
            const divelement = document.createElement('div');
            const hiddendiv=document.createElement('div');
            hiddendiv.classList.add('hidden');
            hiddendiv.innerHTML=`
                <div id='ProductName'>`+ProductName+`</div>
                <div id='Category'>`+Category+`</div>
                <div id='Description'>`+Desc+`</div>
                <div id='price'>`+Price+`</div>
                <div id='UserName'>`+Name+`</div>
                <div id='Phone'>`+Phone+`</div>
                <div id='url'>`+url+`</div>;`;
                
            hiddendiv.style.display='none';
            const container = document.getElementsByClassName('container')[0];
            const image = document.createElement('img');
            const button=document.createElement('button');
            button.id='buy';
            button.innerHTML='BUY';
            button.addEventListener('click', function(e) {
                console.log(button);
                createOverlay(this);
            })
            button.classList.add('button-17');
            image.src = url;
            image.classList.add('imageelement');
            const heading = document.createElement('h2');
            heading.innerText = 'Product:'+ ProductName;
            heading.classList.add('headingelement');
            const heading2= document.createElement('h2');
            heading2.innerText = 'price:'+Price;
            heading2.classList.add('headingelement');
            divelement.classList.add('card');
            divelement.appendChild(hiddendiv);
            divelement.appendChild(image);
            divelement.appendChild(heading);
            divelement.appendChild(heading2);
            divelement.appendChild(button);
            container.appendChild(divelement);
            console.log(2);
    }
</script>

<style>
    .container {
        margin-top: 60px;
        min-height: 100vh;
    }

    #dialogbox {
        height: 550px;
        width: 800px;
        margin: 0;
        border: 1px solid black;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
    }

    #productimage {
        width: 250px;
        height: 250px;
    }

    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        opacity: 0.5;
        display: none;
    }

    .sash {
        display: flex;

    }

    #productimage {
        margin-top: 160px;
        margin-left: 75px;

    }

    #dialogcontent {
        margin-top: 210px;
        margin-left: 40px;
    }

    #productname {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-weight: bolder;
        font-size: x-large;
    }

    #close {
        padding: 10px;
    }

    #close:hover {
        padding: 15px;
    }
    #dropdown{
        position: absolute;
        right: 20px;
        top: 100px;
        padding: 5px;
        margin: auto 0px;
        border: 1px solid black;
    }
</style>

<body>
    <div>
        <select id="dropdown" name="latest1" value="">
            <option value="default">default</option>
            <option value="latest">latest</option>
            <option value="price">price</option>
        </select>
    </div>
    <div class="container">
    </div>

    <div id="overlay"></div>

    <dialog id="dialogbox">
        <div class="sash">
            <div id="dialogimage">
                <img src="" id="productimage">
            </div>
            <div id="dialogcontent">
                <h1 id="productname">This is product name</h1>
                <h1 id="dialogprice">price of the product</h1>
                <h2 id="category">category</h2>
                <p id="description"></p>
                <h3 id="user"></h3>
                <h3 id="phone"></h3>
                <button id="close" class="button-17">close</button>
            </div>
        </div>
    </dialog>
</body>
<script>
        const dropdown = document.getElementById('dropdown');
        console.log(dropdown);
        dropdown.addEventListener('change', function(e) {
            const value = e.target.value;
            console.log(value);
            if (value === 'latest') {
                document.getElementsByClassName('container')[0].innerHTML = "";
                Latest();
            } else if (value === 'price') {
                document.getElementsByClassName('container')[0].innerHTML = "";
                Price();
            } else if (value === 'default') {
                document.getElementsByClassName('container')[0].innerHTML = "";
                Default();
            }
        });

        function Latest(){
        <?php
            $conn = mysqli_connect("localhost","root","","test");
            $query = "SELECT * FROM products ORDER BY DATEDIFF(NOW(),creation)";
            $result = mysqli_query($conn, $query);
            
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["url"]) {
                    $query2 = "SELECT 
                    users.Name,
                    users.ph_no
                FROM products
                JOIN users ON products.user_id = users.id
                WHERE products.id = {$row['id']}";
                    $result2 = mysqli_query($conn, $query2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $name = $row2['Name'];
                    $phone = $row2['ph_no'];
                    $escapedName = htmlspecialchars($row['ProductName'], ENT_QUOTES, 'UTF-8');
                echo "addCard('{$row['ProductName']}','{$row['Category']}','{$row['Description']}','{$row['Price']}','{$row['url']}','{$name}','{$phone}');";
            }}
        ?>
        }
        
        function Price(){
        <?php
            $conn = mysqli_connect("localhost","root","","test");
            $query = "SELECT * FROM `products` ORDER BY Price";
            $result = mysqli_query($conn, $query);
            
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["url"]) {
                    $query2 = "SELECT 
                    users.Name,
                    users.ph_no
                FROM products
                JOIN users ON products.user_id = users.id
                WHERE products.id = {$row['id']}";
                    $result2 = mysqli_query($conn, $query2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $name = $row2['Name'];
                    $phone = $row2['ph_no'];
                    $escapedName = htmlspecialchars($row['ProductName'], ENT_QUOTES, 'UTF-8');
                echo "addCard('{$row['ProductName']}','{$row['Category']}','{$row['Description']}','{$row['Price']}','{$row['url']}','{$name}','{$phone}');";
            }}
        ?>
        }


        function Default(){
        <?php
            $conn = mysqli_connect("localhost","root","","test");
            $query = "SELECT * FROM `Products`";
            $result = mysqli_query($conn, $query);
            
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["url"]) {
                    $query2 = "SELECT 
                    users.Name,
                    users.ph_no
                FROM products
                JOIN users ON products.user_id = users.id
                WHERE products.id = {$row['id']}";
                    $result2 = mysqli_query($conn, $query2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $name = $row2['Name'];
                    $phone = $row2['ph_no'];
                    $escapedName = htmlspecialchars($row['ProductName'], ENT_QUOTES, 'UTF-8');
                echo "addCard('{$row['ProductName']}','{$row['Category']}','{$row['Description']}','{$row['Price']}','{$row['url']}','{$name}','{$phone}');";
            }}
        ?>
        }
    
</script>
<script>
     const btns = document.querySelectorAll('#buy');
        const overlay = document.getElementById('overlay');
        btns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                console.log(btn);
                createOverlay(this);
            })
        })


        function createOverlay(btn) {
            const card = btn.parentNode;
            const data = card.querySelectorAll('.hidden *');
            for (let i = 0; i < data.length; i++) {
                console.log(data[i].innerText);
            }
            const dialogbox = document.getElementById("dialogbox");
            document.getElementById("user").innerHTML = data[4].innerText
            document.getElementById("phone").innerHTML = data[5].innerText
            document.getElementById("dialogprice").innerHTML = data[3].innerText;
            document.getElementById("productname").innerHTML = data[0].innerText;
            document.getElementById("description").innerHTML = data[2].innerText;
            document.getElementById("productimage").src = data[6].innerText;
            document.getElementById("category").innerHTML = data[1].innerText;
            document.getElementById("dialogbox").show();
            overlay.style.display = 'block';
        }

        document.getElementById("close").addEventListener('click', () => {
            document.getElementById("dialogbox").close();
            overlay.style.display = 'none';
        })
        Default();
</script>
</html>

<?php
include('includes/footer.php');
?>