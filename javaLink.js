

var navBar = document.querySelector(".centered-navbar");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    navBar.style.width = "calc(100% - 20%)";
    navBar.style.margin = "0.6% 10%";
    navBar.style.transition = "all 0.4s ease";
    navBar.style.boxShadow = "0 0 10px #0004";
    navBar.style.borderBottom = "none";
    navBar.style.borderRadius = "10px";
  } else {
    navBar.style.width = "100%";
    navBar.style.margin = "0px";
    navBar.style.boxShadow = "none";
    navBar.style.borderBottom = "1px solid #0003";
    navBar.style.borderRadius = "0";
  }
}




  var clickMe = document.querySelectorAll(".click");

clickMe.forEach(function(element) {
    element.addEventListener("click", function(){
        var show = this.nextElementSibling;
        var icon = this.querySelector(".bx");

        // Check if the clicked item is already active
        var isActive = show.classList.contains("active");

        // Deactivate all items
        clickMe.forEach(function(item) {
            item.nextElementSibling.classList.remove("active");
            item.querySelector(".bx").classList.remove("bxs-down-arrow");
            item.querySelector(".bx").classList.add("bxs-right-arrow");
        });

        // Activate the clicked item if it wasn't already active
        if (!isActive) {
            show.classList.add("active");
            icon.classList.remove("bxs-right-arrow");
            icon.classList.add("bxs-down-arrow");
        }
    });
});

var navLinks = document.querySelectorAll(".nav-links");

navLinks.forEach(function(element) {
    element.addEventListener("click", function() {
        // Remove the "active" class from all nav links
        navLinks.forEach(function(link) {
            link.classList.remove("active");
        });
        this.classList.add("active");
    });
});





const faqQuestions = document.querySelectorAll(".faq-question");

faqQuestions.forEach((question) => {
  question.addEventListener("click", () => {
    const faqItem = question.parentElement;
    const answer = faqItem.querySelector(".faq-answer");
    const iconBox = faqItem.querySelector(".bxs-right-arrow-circle");

    // Toggle the "active" class on the faq-item
    faqItem.classList.toggle("active");

    // Toggle the "active" class on the answer
    answer.classList.toggle("active");

    // Toggle the "active" class on the IconBox
    iconBox.classList.toggle("active");

    // Close other items
    faqQuestions.forEach((otherQuestion) => {
      if (otherQuestion !== question) {
        const otherFaqItem = otherQuestion.parentElement;
        const otherAnswer = otherFaqItem.querySelector(".faq-answer");
        const otherIconBox = otherFaqItem.querySelector(".bxs-right-arrow-circle");

        // Remove "active" class from other items
        otherFaqItem.classList.remove("active");
        otherAnswer.classList.remove("active");
        otherIconBox.classList.remove("active");
      }
    });
  });
});