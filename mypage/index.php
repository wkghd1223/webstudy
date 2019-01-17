<?php
    require("./db.php");
    require("./config.php");
    $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
    $menu = mysqli_query($conn,'select * from menu');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="./css/Gstyle.css">
    <link rel="stylesheet" href="../bootstrap-4.2.1-dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <div class="container">
        <header class = "jumbotron text-center bg-light" >
            <span class = "banner"><h1><a href="./index.php">Gallery</a></h1></p></span>
        </header>
        <div class="control bg-light">
                <nav>
                    <ul class="nav justify-content-center">
                    <?php
                        while( $row = mysqli_fetch_assoc($menu)){
                            echo '<li class="nav-liem"><a class="nav-link" href="./index.php?id='.$row['id'].'">'.$row['category'].'</a></li>'."\n";
                        }
                    ?>
                    </ul>
                </nav>
        </div>
        <article>
            <div >
                <?php
                    if(empty($_GET['id']) == false ) {
                        $sql = 'SELECT * FROM descrip,menu WHERE descrip.category=menu.category and id='.$_GET['id'];
                        $result = mysqli_query($conn, $sql);                  
                               
                        while($row = mysqli_fetch_assoc($result))
                        {
                        echo $row['description'];
                        }
                    }
                ?>
            </div>
        </article>
        <div class="bg-light">
        <ul class="nav justify-content-end">
            <li id="mkcategory" class="nav-item">
                <a class="nav-link" href="./mkcategory.php">카테고리 만들기</a>
            </li>
            <li id="mkarticle" class="nav-item">
                <a class="nav-link" href="./mkarticle.php">게시물 만들기</a>
            </li>
        </ul>
        </div>  
    
    </div>

 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="../bootstrap-4.2.1-dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>