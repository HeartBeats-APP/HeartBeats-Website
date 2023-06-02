function animateElements(entries, observer) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("visible");
    } else {
      entry.target.classList.remove("visible");
    }
  });
}

const contentWrapper = document.querySelector(".content-wrapper");
const elements = contentWrapper.querySelectorAll(".animate");

const options = {
  root: contentWrapper,
  rootMargin: "0px",
  threshold: 0, // Adjust this threshold value as needed
};

const observer = new IntersectionObserver(animateElements, options);

elements.forEach((element) => {
  observer.observe(element);
});
