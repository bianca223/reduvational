<?php
    require_once("menu.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/styles-index.css"></link>
        <script src="scripts/taskList.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="content-box-parent">
                <div class="title-part">
                    <h1 class="title">Planuri Lunare</h1>
                </div>
                <form action="javascript:" data-role="validator" id="form-input-articole">
                    <div class="input-parts-childs">
                        <label>Numele articolului</label>
                        <input type="text" name="nume_articol" class="metro-input"></input>
                    </div>
                    <div class="input-parts-childs">
                        <label>Categoria articolului</label>
                        <input type="text" name="categorie" class="metro-input"></input>
                    </div>
                    <div class="input-parts-childs">
                        <label>Scris articol</label>
                        <select name="scrie" id="select_scris" data-role='select' data-filter='true' data-validare='required'>
                            <option value=""></option>
                            <option value="bianca">Bianca</option>
                            <option value="kinga">Kinga</option>
                            <option value="bogdan">Bogdan</option>
                            <option value="vivi">Vivi</option>
                        </select>
                    </div>
                    <div class="input-parts-childs">
                        <label>Poze Instagram</label>
                        <select name="instagram" id="select_instagram" data-role='select' data-filter='true' data-validare='required'>
                            <option value=""></option>
                            <option value="bianca">Bianca</option>
                            <option value="kinga">Kinga</option>
                            <option value="lavinia">Lavinia</option>
                            <option value="vivi">Vivi</option>
                        </select>
                    </div>
                    <div class="input-parts-childs">
                        <label>Poze Blog</label>
                        <select name="blog" id="select_blog" data-role='select' data-filter='true' data-validare='required'>
                            <option value=""></option>
                            <option value="bianca">Bianca</option>
                            <option value="kinga">Kinga</option>
                            <option value="lavinia">Lavinia</option>
                            <option value="vivi">Vivi</option>
                        </select>
                    </div>
                    <div class="input-parts-childs">
                        <label>Corectat</label>
                        <select name="corectat" id="select_corectat" data-role='select' data-filter='true' data-validare='required'>
                            <option value="kinga">Kinga</option>
                            <option value="bianca">Bianca</option>
                        </select>
                    </div>
                    <div class="input-parts-childs">
                        <label>Termen</label>
                        <input type="text" id="date-time" data-role="calendarpicker" name="termen">
                    </div>
                    <button class="submit-button"type="submit" value='SUBMIT' onclick="createFormular('form-input-articole', 'adaugare')">Adauga Articol</button>
                </form>
            </div>
        </div>
    </body>
</html>