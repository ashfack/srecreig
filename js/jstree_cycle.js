   $(function () {
     $('#jstree')
      .on("init.jstree", function (e, data) {
      data.instance.settings.checkbox.cascade = '';
     })
     .on("changed.jstree", function (e, data) {
       console.log(data.selected);
     })   

     .jstree({  
      checkbox : {
        three_state : false,
    },
       types : {
       "default" : {
         "icon" : "glyphicon glyphicon-flash"
       }
    }, 
       plugins : [ 'wholerow', 'checkbox', 'types' ]
     })
 });