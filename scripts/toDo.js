function fetchData(){ 
  $.ajax({ 
  type: 'GET', 
  url: `API/Controllers/ArticoleController.php?toDo=true`, 
  dataType: 'JSON', 
  success: function (response) { 
    if("1" in response){
      const body = document.getElementById('bianca');
      label = createElementFromHTML(`
      <label>Bianca</label>
      `);
      body.appendChild(label); 
      for(let i = 0; i < response["1"].length; i++){
        createElementWithFunction(response["1"][i], 'bianca');
      }
    }
    if('2' in response){
      const body = document.getElementById('kinga');
      label = createElementFromHTML(`
      <label>Kinga</label>
      `);
      body.appendChild(label); 
      for(let i = 0; i < response["2"].length; i++){
        createElementWithFunction(response["2"][i], 'kinga');
      }
    }
    if('3' in response){
      const body = document.getElementById('lavinia');
      label = createElementFromHTML(`
      <label>Lavinia</label>
      `);
      body.appendChild(label); 
      for(let i = 0; i < response["3"].length; i++){
        createElementWithFunction(response["3"][i], 'lavinia');
      }
    }
    if('4' in response){
      const body = document.getElementById('bogdan');
      label = createElementFromHTML(`
      <label>Bogdan</label>
      `);
      body.appendChild(label); 
      for(let i = 0; i < response["4"].length; i++){
       createElementWithFunction(response["4"][i], 'bogdan');
      } 
    }
    if("5" in response){
      const body = document.getElementById('vivi');
      label = createElementFromHTML(`
      <label>Vivi</label>
      `);
      body.appendChild(label); 
      for(let i = 0; i < response["5"].length; i++){
        createElementWithFunction(response["5"][i], 'vivi');
      }
    }
  }
  }) 
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
  let name = `<span>${response['nume_articol']}|${response['job']}</span>|${response['termen']}`; 
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