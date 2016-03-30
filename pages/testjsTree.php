<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>jsTree test</title>
  <!-- 2 load the theme CSS file -->
  <link rel="stylesheet" href="../framework/jsTree/dist/themes/default/style.min.css" />
</head>
<body>
  <!-- 3 setup a container element -->
  <div id="jstree">
    <!-- in this example the tree is populated from inline HTML -->
    <ul>
      <li id="plugins1" class="checkbox">Root node 1
        <ul>
          <li id="child_node_1">Child node 1</li>
          <li>Child node 2</li>
        </ul>
      </li>
      <li>Root node 2</li>
    </ul>
  </div>
  <button>demo button</button>

  <script src="../js/jquery.min.js"></script>
  <script src="../framework/jsTree/dist/jstree.min.js"></script>
  <script>
  $(function () {
    $('#jstree').jstree({  
      "plugins" : [ "wholerow", "checkbox", "types" ]
    });

    $('#jstree').on("changed.jstree", function (e, data) {
      console.log(data.selected);
    });

    $('button').on('click', function () {
      $('#jstree').jstree(true).select_node('child_node_1');
      $('#jstree').jstree('select_node', 'child_node_1');
      $.jstree.reference('#jstree').select_node('child_node_1');
    });
    $("#plugins7").jstree({
    "types" : {
      "default" : {
        "icon" : "glyphicon glyphicon-flash"
      },
      "demo" : {
        "icon" : "glyphicon glyphicon-ok"
      }
    },    "plugins" : [ "types" ]
  });

    $("#plugins1").jstree({
      "checkbox" : {
        "keep_selected_style" : false
        }    });
  });

  </script>
</body>
</html>