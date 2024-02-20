import "./test";
import "./checkout";

document.addEventListener("DOMContentLoaded", function () {
  const colorItems = document.querySelectorAll(".color-variable-item");
  const sizeItems = document.querySelectorAll(".button-variable-item");

  
  colorItems.forEach((item) => {
    item.addEventListener("click", function () {
      
      colorItems.forEach((item) => {
        item.style.border = "none";
      });
      
      this.style.border = "2px solid gray";
    });
  });

  
  function clearBorder(items) {
    items.forEach((item) => {
      item.style.border = "none";
    });
  }

  
  sizeItems.forEach((item) => {
    item.addEventListener("click", function () {
      
      clearBorder(sizeItems);
      
      this.style.border = "1px solid black";
    });
  });

  
  sizeItems.forEach((item) => {
    item.addEventListener("click", function () {
      
      sizeItems.forEach((item) => {
        item.style.backgroundColor = "";
      });
      
      this.style.backgroundColor = "#FBEBB5";
    });
  });
});