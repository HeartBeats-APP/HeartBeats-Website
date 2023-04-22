function isVisible(element) {
    let position = element.getBoundingClientRect();
    let windowHeight = window.innerHeight;
    return position.top < windowHeight && position.bottom >= 0;
  }
  
  function animateElements() {
    let elements = document.querySelectorAll(".animate");
    for (let element of elements) {
      if (isVisible(element)) {
        element.classList.add("visible");
      } else {
        element.classList.remove("visible");
      }
    }
  }
  
  animateElements();
  
  window.addEventListener("scroll", animateElements);
  