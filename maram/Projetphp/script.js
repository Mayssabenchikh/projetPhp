const slidepage = document.querySelector(".form-outer form");
const firstNextBtn = document.querySelector(".nextbtn button");
const prevBtn2 = document.querySelector(".prev-1");
const nextBtn2 = document.querySelector(".next-1");
const prevBtn3 = document.querySelector(".prev-2");
const nextBtn3 = document.querySelector(".next-2");
const prevBtn4 = document.querySelector(".prev-3");
const submit = document.querySelector(".submit");


firstNextBtn.addEventListener("click", function (e) {
    e.preventDefault(); 
    slidepage.style.marginLeft = "-125%";
});


nextBtn2.addEventListener("click", function (e) {
    e.preventDefault();
    slidepage.style.marginLeft = "-125%";
});

nextBtn3.addEventListener("click", function (e) {
    e.preventDefault();
    slidepage.style.marginLeft = "-125%";
});


prevBtn2.addEventListener("click", function (e) {
    e.preventDefault();
    slidepage.style.marginLeft = "125%";
});


prevBtn3.addEventListener("click", function (e) {
    e.preventDefault();
    slidepage.style.marginLeft = "250%";
});

// Bouton "Previous" - Page 4 vers Page 3
prevBtn4.addEventListener("click", function (e) {
    e.preventDefault();
    slidepage.style.marginLeft = "375%";
});
