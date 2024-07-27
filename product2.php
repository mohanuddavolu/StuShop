<?php
session_start();
include('includes/header.php');
include('includes/database.php');
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
        echo "<script>
            document.addEventListener('DOMContentLoaded', function(e){
            const divelement = document.createElement('div');
            const hiddendiv=document.createElement('div');
            hiddendiv.classList.add('hidden');
            hiddendiv.innerHTML=`
                <div id='ProductName'>{$row['ProductName']}</div>
                <div id='Category'>{$row['Category']}</div>
                <div id='Description'>{$row['Description']}</div>
                <div id='price'>{$row['Price']}</div>
                <div id='UserName'>{$name}</div>
                <div id='Phone'>{$phone}</div>
                <div id='url'>{$row['url']}</div>;`;
                
            hiddendiv.style.display='none';
            const container = document.getElementsByClassName('container')[0];
            const image = document.createElement('img');
            const button=document.createElement('button');
            button.id='buy';
            button.innerHTML='BUY';
            button.classList.add('button-17');
            image.src = '{$row['url']}';
            image.classList.add('imageelement');
            const heading = document.createElement('h2');
            heading.innerText = 'Product:'+'{$escapedName}';
            heading.classList.add('headingelement');
            const heading2= document.createElement('h2');
            heading2.innerText = 'price:'+'{$row['Price']}';
            heading2.classList.add('headingelement');
            divelement.classList.add('card');
            divelement.appendChild(hiddendiv);
            divelement.appendChild(image);
            divelement.appendChild(heading);
            divelement.appendChild(heading2);
            divelement.appendChild(button);
            container.appendChild(divelement);
        });</script>";
    }
}
?>
<html>
<link rel="stylesheet" href="card.css">

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
    function addCard(url, name, price) {


        const divelement = document.createElement('div');
        const hiddendiv = document.createElement('div');
        hiddendiv.classList.add('hidden');
        hiddendiv.innerHTML = `
                <div id='ProductName'>{$row['ProductName']}</div>
                <div id='Category'>{$row['Category']}</div>
                <div id='Description'>{$row['Description']}</div>
                <div id='price'>{$row['Price']}</div>
                <div id='UserName'>{$name}</div>
                <div id='Phone'>{$phone}</div>
                <div id='url'>{$row['url']}</div>;`;

        hiddendiv.style.display = 'none';
        const container = document.getElementsByClassName('container')[0];
        const image = document.createElement('img');
        const button = document.createElement('button');
        button.id = 'buy';
        button.innerHTML = 'BUY';
        button.classList.add('button-17');
        image.src = '{$row['
        url ']}';
        image.classList.add('imageelement');
        const heading = document.createElement('h2');
        heading.innerText = 'Product:' + '{$escapedName}';
        heading.classList.add('headingelement');
        const heading2 = document.createElement('h2');
        heading2.innerText = 'price:' + '{$row['
        price ']}';
        heading2.classList.add('headingelement');
        divelement.classList.add('card');
        divelement.appendChild(hiddendiv);
        divelement.appendChild(image);
        divelement.appendChild(heading);
        divelement.appendChild(heading2);
        divelement.appendChild(button);
        container.appendChild(divelement);



        // const container = document.getElementsByClassName('container')[0];
        // count += 1;
        // const divelement = document.createElement('div');
        // divelement.classList.add('card');

        // const image = document.createElement('img');
        // image.src = url;
        // image.classList.add('imageelement');
        // divelement.appendChild(image);

        // const heading = document.createElement('h2');
        // heading.innerText = 'Author: ' + name;
        // heading.classList.add('headingelement');
        // divelement.appendChild(heading);

        // const heading2 = document.createElement('h2');
        // heading2.innerText = 'Price: ' + price;
        // heading2.classList.add('headingelement');
        // divelement.appendChild(heading2);

        // const button = document.createElement('button');
        // button.innerHTML = 'BUY';
        // button.classList.add('button-17');
        // divelement.appendChild(button);

        // container.appendChild(divelement);
    }

    function fetchpriceproducts() {
        <?php
        $query = "SELECT * FROM `products` WHERE DATEDIFF(NOW(), manufactured)<6";
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
                $escapedName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                echo "addCard('{$row['url']}', '{$escapedName}', '{$escapedName}');";
            }
        }
        ?>
    }

    function fetchdefaultproducts() {
        <?php
        $query = "SELECT * FROM `products`";
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
                $escapedName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                echo "addCard('{$row['url']}', '{$escapedName}', '{$escapedName}');";
            }
        }
        ?>

    }

    function fetchLatestProducts() {
        <?php
        $query = "SELECT * FROM `products` WHERE DATEDIFF(NOW(), manufactured) > 20";
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
                $escapedName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                echo "addCard('{$row['url']}', '{$escapedName}', '{$escapedName}');";
            }
        }
        ?>
    }


    document.addEventListener('DOMContentLoaded', function(e) {
        const dropdown = document.getElementById('dropdown');
        dropdown.addEventListener('change', function(e) {
            const value = e.target.value;
            console.log(value);
            if (value === 'latest') {
                document.getElementsByClassName('container')[0].innerHTML = "hi";
                fetchLatestProducts();
            } else if (value === 'price') {
                document.getElementsByClassName('container')[0].innerHTML = "hi1";
                fetchpriceproducts();
            } else if (value === 'default') {
                document.getElementsByClassName('container')[0].innerHTML = "hi2";
                fetchdefaultproducts();
            }
        });
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
    })
    document.getElementById("close").addEventListener('click', () => {
        document.getElementById("dialogbox").close();
        overlay.style.display = 'none';
    })
</script>

</html>

<?php
include('includes/footer.php');
?>