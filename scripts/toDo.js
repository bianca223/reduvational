function fetchData(){ 
  $.ajax({ 
  type: 'GET', 
  url: `API/Controllers/ArticoleController.php?toDo=true`, 
  dataType: 'JSON', 
  success: function (response) { 
    if("1" in response){
      for(let i = 0; i < response["1"].length; i++){
        createElementWithFunction(response["1"][i], 'bianca');
      }
    }
    if('2' in response){
      for(let i = 0; i < response["2"].length; i++){
        createElementWithFunction(response["2"][i], 'kinga');
      }
    }
    if('3' in response){
      for(let i = 0; i < response["3"].length; i++){
        createElementWithFunction(response["3"][i], 'lavinia');
      }
    }
    if('4' in response){
      for(let i = 0; i < response["4"].length; i++){
       createElementWithFunction(response["4"][i], 'bogdan');
      } 
    }
    if("5" in response){
      for(let i = 0; i < response["5"].length; i++){
        createElementWithFunction(response["5"][i], 'vivi');
      }
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
  type: 'POST', 
  url: `API/Controllers/ArticoleController.php?next=true&id=${id}`, 
  dataType: 'JSON', 
  success: function (response) { 
      window.location.reload(); 
    } 
  }); 
} 
function createElementWithFunction(response, id){ 
  let name = `<span>${response['nume_articol']} | ${response['job']}</span>`; 
  const body = document.getElementById(id); 
  const element = createElementFromHTML(` 
    <div class='box-parent'> 
      <div class='box-function'> 
        ${name} 
      </div> 
      <div class='box-delete' onclick='deleteFunctie(${response['id']})'>X</div> 
    </div> 
  `) 
  body.appendChild(element); 
} 
fetchData();