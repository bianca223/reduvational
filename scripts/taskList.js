function createFormular(id, element){
  dateToUpdate = getForm(id);
  if(element === 'pregatit'){
    dateToUpdate["id"] = getParamBy(window.location.href, "id");
  }
  $.ajax({
    type:"POST",
    url: `/API/Controllers/ArticoleController.php?${element}=true`,
    data: dateToUpdate,
    success: function(response){
      Metro.dialog.create({
        title: "Success",
        content: `<div style='color:rgb(0, 153, 51)'>Articolul a fost adaugat cu success</div>`,
        actions: [
          {
            caption: "OK",
            cls:"js-dialog-close alert",
            onclick: function(){}
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