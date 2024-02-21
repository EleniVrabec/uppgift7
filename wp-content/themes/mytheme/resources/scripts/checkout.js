document.addEventListener("DOMContentLoaded", function () {
  var billingAddressInput = document.getElementById("billing_email");
  if (billingAddressInput) {
    billingAddressInput.value = ""; // Set placeholder to empty string
  }

  /* 

  document.addEventListener("click", function (event) {
    var clickedItem = event.target.closest("li.wc_payment_method");
    if (clickedItem) {
      // Reset the color of all labels within all li elements with class wc_payment_method to gray
      document
        .querySelectorAll("li.wc_payment_method label")
        .forEach(function (label) {
          label.style.color = "gray";
        });

      // Find the label associated with the clicked item
      var label = clickedItem.querySelector("label");
      var input = clickedItem.querySelector("input");
      if (label && (event.target === label || event.target === input)) {
        // Change the color of the label to black
        label.style.color = "black";
      }
    }
  });
  */
});
