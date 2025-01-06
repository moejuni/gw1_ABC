import "../css/style.css";

console.log("javascript works 2.0.......");

document.addEventListener("DOMContentLoaded", function () {
  const readMoreBtn = document.querySelector(".read-more-btn");
  const readMoreText = document.querySelector(".read-more-text");

  readMoreBtn.addEventListener("click", () => {
    readMoreText.classList.toggle("read-more-text--show");

    if (readMoreText.classList.contains("read-more-text--show")) {
      readMoreBtn.textContent = "Read less..";
    } else {
      readMoreBtn.textContent = "Read more..";
    }
  });
});

const hamburger = document.querySelector(".burger");
const navitems = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navitems.classList.toggle("active");
});
