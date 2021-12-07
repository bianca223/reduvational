function fetchData(element){
  $.ajax({
    type:"GET",
    url: `/API/Controllers/ArticoleController.php?${element}=true`,
    dataType: "JSON",
    success: function(response){
      console.log(response);
      createTable(response);
    },
  });
}
function createTable(response){ 
  if(response && response.length){ 
    const body = document.getElementById('table'); 
    const serializer = serializeTable(response, { 
      "id" : "Numarul", 
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
            ${eachRow(serializer[1], response, function(row){ 
              return `class='pressable-row hover-color' crt='${response['id']}' onclick='pressRow(this)'`; 
            })} 
            </tbody> 
        </div> 
      `)) 
    } 
  } else { 
    const body = document.getElementById("table"); 
    if(body){ 
      body.innerHTML = ` 
      <div class='remark warning text-bold'>Nu este niciun articol postat</div> 
      ` 
    } 
    return; 
  } 
}
function pressRow(element){
  id = element.getAttribute('crt');
  redirectToPage(`articoleTerminatExtins.php?id=${id}`);
} 
fetchData('terminat');