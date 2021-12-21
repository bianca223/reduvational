function fetchData(element){
  $.ajax({
    type:"GET",
    url: `/API/Controllers/ArticoleController.php?${element}=true`,
    dataType: "JSON",
    success: function(response){
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
              return `class='pressable-row hover-color'onclick='pressRow(${row['id']})'`; 
            })} 
            </tbody> 
        </div> 
      `)) 
    } 
  } else { 
    const body = document.getElementById("table"); 
    if(body){ 
      body.innerHTML = ` 
      <div class='remark warning text-bold'>Nu este niciun articol terminat</div> 
      ` 
    } 
    return; 
  } 
}
function pressRow(id){
  redirectToPage(`articoleTerminatExtins.php?id=${id}`);
} 
function createPostat(){
  data = {
    'data_postare' : document.getElementById('date-time').value,
    'id' : getParamBy(window.location.href,'id'),
    'status' : 'postat'
  };
  // data = {};
  // data.push('data_postare', document.getElementById('date-time').value);
  // data.push('id', getParamBy(window.location.href,'id'));
  // data['data_postare'] = document.getElementById('date-time').value;
  // data['id'] = getParamBy(window.location.href,'id');
  $.ajax({
    type:"POST",
    url: `/API/Controllers/ArticoleController.php?update=true`,
    data: data,
    dataType: "JSON",
    success: function(response){
      Metro.dialog.create({
        title: "Success",
        content: `<div style='color:rgb(0, 153, 51)'>Articolul a fost adaugat cu success</div>`,
        actions: [
          {
            caption: "OK",
            cls:"js-dialog-close alert",
            onclick: function(){
              redirectToPage('allArticole.php');
            }
          }
        ]
      });
    },
    error:function(response){
      Metro.dialog.create({
        title:"Eroare",
        content: `<div style='color:rgb(179, 0, 0)'>Articolul are urmatoarele erori ${response["Error"]}</div>`,
        actions:[{
          caption:"OK",
          cls:"js-dialog-close-alert",
          onclick:function(){

          }
        }]
      });
    }
  });
}
fetchData('terminat');