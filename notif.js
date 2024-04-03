function checkNewLines() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "check_size.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var size = parseInt(xhr.responseText);

      var storedSize = parseInt(localStorage.getItem("produtoSize") || 0);
      if (size > storedSize) {
        displayNotification("Novo produto adicionado à loja!");

        localStorage.setItem("produtoSize", size);
      }
    }
  };
  xhr.send();
}


function displayNotification(message) {

  alert(message);
}


setInterval(checkNewLines, 2000);
