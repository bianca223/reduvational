function fetchData(element){ 
  $.ajax({ 
  type: 'GET', 
  url: `API/Controllers/ArticoleController.php?${element}=true`, 
  dataType: 'JSON', 
  success: function (response) { 
      for(let i = 0; i < response['records'].length; i++){ 
        createElementWithFunction(response['records'][i]); 
      } 
    } 
  }) 
} 
 
function createOptionForSelect(){ 
  const element = document.getElementById('createElementToDo').value; 
  if(checkElementForSpace(element) === 1){ 
    $.ajax({ 
      type: 'POST', 
      url: `API/Controllers/ArticoleController.php`, 
      data: { 
        "email": element 
      }, 
      dataType: 'JSON', 
      success: function (response) { 
        Metro.dialog.create({ 
          title: "Succes", 
          content: `<div style="color:rgb(57, 172, 57)"> Emailul a fost adaugata cu success</div>`, 
          actions: [ 
            { 
              caption: "Ok", 
              cls: "js-dialog-close alert", 
              onclick:function(){ 
                window.location.reload(); 
              } 
            } 
          ] 
        }) 
      } 
    }) 
  } else { 
    Metro.dialog.create({ 
      title: "Eroare", 
      content: `<div style="color:rgb(255,0,0)"> Emailul exista deja</div>`, 
      actions: [ 
        { 
          caption: "Ok", 
          cls: "js-dialog-close alert", 
        } 
      ] 
    }) 
  } 
}  
function deleteFunctie(id){ 
  $.ajax({ 
  type: 'DELETE', 
  url: `API/Controllers/ArticolController.php?id=${id}`, 
  dataType: 'JSON', 
  success: function (response) { 
      window.location.reload(); 
    } 
  }); 
} 
function createElementWithFunction(response){ 
  let name = `<span>${response['scris']}</span>`; 
  const body = document.getElementById('createElementToDo'); 
  const element = createElementFromHTML(` 
    <div class='box-parent'> 
      <div class='box-functie'> 
        ${name} 
      </div> 
      <div class='box-delete' onclick='deleteFunctie(${response['id']})'>X</div> 
    </div> 
  `) 
  body.appendChild(element); 
} 
fetchData('bianca');