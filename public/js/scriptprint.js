function imprimirElemento(elemento) {
  var ventana = window.open('', 'PRINT', 'height=400,width=600');
  ventana.document.write('<html><head><title>' + document.title + '</title>');
  ventana.document.write('<link rel="stylesheet" href="style.css">');
  ventana.document.write('</head><body >');
  ventana.document.write(elemento.innerHTML);
  ventana.document.write('</body></html>');
  ventana.document.close();
  ventana.focus();
  ventana.onload = function () {

    ventana.print();
    ventana.close();
  }
  return true;
}

document.querySelector("#btnImprimirDiv").addEventListener("click", function () {
  var div = document.querySelector("#imprimible");
  imprimirElemento(div);
});

document.querySelector("#btnImprimirParrafo").addEventListener("click", function () {
  var parrafo = document.querySelector("#areaImprimir");
  imprimirElemento(parrafo);
});