<?php
    require_once("menu.php");
?>
<html>
  <head>
      <link rel="stylesheet" href="styles/styles-index.css"></link>
      <script src="scripts/toDo.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="content-box-parent">
        <div class="title-part">
            <h1 class="title">Dashbord</h1>
        </div>
        <div class="childs-box">
          <div class="child-box">
            <label>Bianca</label>
            <div class="createElementToDo" id="bianca"></div>
          </div>
          <div class="child-box">
            <label>Kinga</label>
            <div class="createElementToDo" id="kinga"></div>
          </div>
          <div class="child-box">
            <label>Lavinia</label>
            <div class="createElementToDo" id="lavinia"></div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>