<?php
//-- a visszaküldendő fájl tartalmának a beállítása
header('Content-Type: text/html; charset=utf-8');
session_start(); //-- munkamenet adatinak tárolására $_SESSION[]
require_once './classes/Database.php';
$db = new Database("localhost", "root", "", "autokolcsonzo");

if (!isset($_SESSION['login'])){$_SESSION['login'] = false;}

require_once './layout/head.php';
$menu = filter_input(INPUT_GET, "menu");
?>
<body>
    <?php
    require_once './layout/header.php';
    require_once './layout/menu.php';
    require_once './tartalom.php';
    require_once './layout/footer.php';
    ?>
    <script src="./bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <!-- https://getbootstrap.com/docs/5.3/forms/validation/ -->
    <script src="./js/autokolcsonzo.js"></script>
</body>
</html>