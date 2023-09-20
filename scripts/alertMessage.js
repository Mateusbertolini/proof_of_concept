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

  function showCustomConfirm(message, callback) {
    var customConfirm = document.getElementById("customConfirm");
    var confirmMessage = document.getElementById("confirmMessage");
    var confirmYesButton = document.getElementById("confirmYesButton");
    var confirmNoButton = document.getElementById("confirmNoButton");

    if (!customConfirm || !confirmMessage || !confirmYesButton || !confirmNoButton) {
        // Handle missing elements or IDs
        console.error("Confirmation dialog elements not found.");
        return;
    }

    confirmMessage.textContent = message;
    customConfirm.style.display = "block";

    var closeElements = document.getElementsByClassName("close");

    for (var i = 0; i < closeElements.length; i++) {
        closeElements[i].onclick = function () {
            customConfirm.style.display = "none";
        };
    }

    confirmYesButton.onclick = function () {
        customConfirm.style.display = "none";
        if (typeof callback === "function") {
            callback(true); // Call the callback function with 'true' (Yes)
        }
    };

    confirmNoButton.onclick = function () {
        customConfirm.style.display = "none";
        if (typeof callback === "function") {
            callback(false); // Call the callback function with 'false' (No)
        }
    };
}
