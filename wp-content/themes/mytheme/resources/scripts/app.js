import "./test";
import "./checkout";

document.addEventListener("DOMContentLoaded", function () {
  const colorItems = document.querySelectorAll(".color-variable-item");

  // Loop through each li element and add click event listener
  colorItems.forEach((item) => {
    item.addEventListener("click", function () {
      // Remove border from all li elements
      colorItems.forEach((item) => {
        item.style.border = "none";
      });
      // Add border to the clicked li element
      this.style.border = "2px solid gray";
    });
  });

  const sizeItems = document.querySelectorAll(".button-variable-item");

  sizeItems.forEach((item) => {
    item.addEventListener("click", function () {
      sizeItems.forEach((item) => {
        item.style.border = "none";
      });

      this.style.border = "1px solid black";
    });
  });
});
