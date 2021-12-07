<?php
    require_once("menu.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/styles-index.css"></link>
        <script src="scripts/terminatList.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="content-box-parent">
                <div class="title-part">
                    <h1 class="title">Alege Data de Postare</h1>
                </div>
                <div class="input-parts-childs">
                        <label>Termen</label>
                        <input type="text" id="date-time" data-role="calendarpicker" name="termen">
                    </div>
            </div>
        </div>
    </body>
</html>