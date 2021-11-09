function fetchData(element){
  $.ajax({
    type:"GET",
    url: `/API/Controllers/ArticoleController.php?${element}=true`,
    data: "JSON",
    success: function(response){
      createTable(response);
    },
  });
}
function createTable(response){ 
  if(response["records"].length){ 
    const body = document.getElementById('table'); 
    const serializer = serializeTable(response["records"], { 
      "id" : "Formular ID", 
      "nume_articol" : "Nume Articol", 
      "categorie" : "Categorie", 
      "scrie": "Articol De Scris", 
      "instagram" : "Poze Instagram",
      "blog" : "Poze Blog",
      'corectat' : "Corectat",
      'termen' : "Termen",
      "status" : "Status"
    }) 
    if(body){ 
      body.innerHTML = " "; 
      body.appendChild(createElementFromHTML(` 
        <div> 
          <table class="table table-border cell-border compact table-color"> 
            <thead> 
              <tr> 
                ${serializer[0]} 
              </tr> 
            </thead> 
            <tbody> 
            ${eachRow(serializer[1], response["records"], function(row){ 
              return `class='pressable-row hover-color' onclick='pressRow("${row['id']}")'`; 
            })} 
            </tbody> 
        </div> 
      `)) 
    } 
  } else { 
    const body = document.getElementById("table"); 
    if(body){ 
      body.innerHTML = ` 
      <div class='remark warning text-bold'>Nu este nicio solicitare activa</div> 
      ` 
    } 
    return; 
  } 
} 
function pressRow(id){ 
  redirectToPage(`solicitariExtins.php?id=${id}`); 
} 
fetchData('status');