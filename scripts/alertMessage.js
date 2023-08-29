function showCustomAlert(message) {
    var customAlert = document.getElementById("customAlert");
    var alertMessage = document.getElementById("alertMessage");
    var okButton = document.getElementById("okButton");
  
    alertMessage.textContent = message;
    customAlert.style.display = "block";
  
    var closeElements = document.getElementsByClassName("close");
    
    for (var i = 0; i < closeElements.length; i++) {
      closeElements[i].onclick = function () {
        customAlert.style.display = "none";
      };
    }
  
    okButton.onclick = function () {
      customAlert.style.display = "none";
    };
  }