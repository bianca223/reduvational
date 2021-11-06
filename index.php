<?php
    require_once("menu.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/styles-index.css"></link>
        <script src="scripts/taskList.js"></script>
    </head>
    <body>
        <div class="content-box-parent">
            <div class="title-part">
                <h1 class="title">Planuri Lunare</h1>
            </div>
            <form id="form-input-articole">
                <div class="input-parts-childs">
                    <label>Numele articolului</label>
                    <input type="text" name="nume_articol"></input>
                </div>
                <div class="input-parts-childs">
                    <label>Categoria articolului</label>
                    <input type="text" name="categorie"></input>
                </div>
                <div class="input-parts-childs">
                    <label>Scris articol</label>
                    <select name="scrie">
                        <option value="bianca">Bianca</option>
                        <option value="kinga">Kinga</option>
                        <option value="bogdan">Bogdan</option>
                        <option value="vivi">Vivi</option>
                    </select>
                </div>
                <div class="input-parts-childs">
                    <label>Poze Instagram</label>
                    <select name="instagram">
                        <option value="bianca">Bianca</option>
                        <option value="kinga">Kinga</option>
                        <option value="lavinia">Lavinia</option>
                    </select>
                </div>
                <div class="input-parts-childs">
                    <label>Poze Blog</label>
                    <select name="blog">
                        <option value="bianca">Bianca</option>
                        <option value="kinga">Kinga</option>
                        <option value="lavinia">Lavinia</option>
                    </select>
                </div>
                <div class="input-parts-childs">
                    <label>Corectat</label>
                    <select name="corectat">
                        <option value="kinga">Kinga</option>
                        <option value="bianca">Bianca</option>
                    </select>
                </div>
                <div class="input-parts-childs">
                    <label>Termen</label>
                    <input type="date" id="start" name="termen">
                </div>
                <button type="submit">Adauga Articol</button>
            </form>
        </div>
    </body>
</html>