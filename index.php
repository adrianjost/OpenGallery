<html>
<head>
    <?php require("static/html/head.php"); ?>
</head>
<body>
    <?php require("static/html/header.php"); ?>
    <main class="clearfix container">
        <div class="card">
            <div class="card-block">
                <?php 
                $prefix = "/gallery";
                $path = __DIR__ . str_replace($prefix,"",$_SERVER[REQUEST_URI]);
                (file_exists("html".$path.".php"))?(include("html".$path.".php")) : (include("html/index.php"));
                ?>
            </div>
        </div>
    </main>
    <?php require("static/html/footer.php"); ?>
</body>
</html>