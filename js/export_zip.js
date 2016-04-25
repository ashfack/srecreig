var tableToExcelE = (function() {
	var zip = new JSZip();
	zip.file(tableToExcel('dataTable_Entreprise_niveau1', 'W3C Example Table'));
	//var img = zip.folder("images");
	//img.file("smile.gif", imgData, {base64: true});
zip.generateAsync({type:"base64"})
.then(function (content) {
    location.href="data:application/zip;base64,"+content;
});

   
})


var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()

function create_zip() {
var zip = new JSZip();
zip.file("hello1.txt", "Hello World First file in the zip\n");
zip.file("hello2.txt", "Hello World Second File in the zip\n");
content = zip.generate();
location.href="data:application/zip;base64," + content;
}