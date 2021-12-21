<?php
?>
<html>
    <link rel="stylesheet" href="styles/styles-menu.css"></link>
    <link rel="stylesheet" href="metro/metro-all.min.css"></link>
    <script src="metro/jquery-3.5.1.min.js"></script>
    <script src="metro/js/metro.js"></script>
    <script src="metro/js/metro.min.js"></script>
    <script src="metro/js/metro.min.js.map"></script>
    <script src="scripts/utils.js" defer></script>
    <body>
        <div class="navbar-parent">
          <div class="navbar-childs">
            <img src="./Reduvational_white_resize.png" styles="width:100%;">
          </div>
          <div class="navbar-childs">
            <button class="navbar-buttons" type="submit" onclick="redirectToPage('/index.php')">Planificare Articole</button>
            <button class="navbar-buttons" type="submit" onclick="redirectToPage('/statusArticole.php')">Status Articole</button>
            <button class="navbar-buttons" type="submit" onclick="redirectToPage('/articoleTerminate.php')">Articole Terminate</button>
            <button class="navbar-buttons" type="submit" onclick="redirectToPage('/toDo.php')">Dashboard</button>
            <button class="navbar-buttons" type="submit">Redu in cifre</button>
            <button class="navbar-buttons" type="submit" onclick="redirectToPage('/allArticole.php')">Toate Articolele Postate</button>
          </div>  
        </div>
    </body>
</html>