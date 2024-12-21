import './bootstrap';

  
  sideLinks.forEach((item) => {
    const li = item.parentElement;
    item.addEventListener("click", () => {
      sideLinks.forEach((i) => {
        i.parentElement.classList.remove("active");
      });
      li.classList.add("active");
    });
  });
  
  
  
  const toggler = document.getElementById("theme-toggle");
  
  toggler.addEventListener("change", function () {
    if (this.checked) {
      document.body.classList.add("dark");
    } else {
      document.body.classList.remove("dark");
    }
  });

  
 