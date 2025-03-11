// Barcha til tugmalarini olish
const langButtons = document.querySelectorAll(".lang-btn");
const form = document.getElementById("contactForm");
const submitButton = document.getElementById("submitButton");
const successModal = document.getElementById("successModal");
const okButton = document.getElementById("okButton");
const successMessage = document.getElementById("successMessage");
const nameInput = document.getElementById("nameInput");
const phoneInput = document.getElementById("phoneInput");
const branchSelect = document.getElementById("branchSelect");


window.addEventListener("scroll", function () {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});
// Til tugmalari uchun event
langButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    langButtons.forEach((b) =>
      b.classList.remove("bg-white", "text-[#4A9F50]")
    );
    btn.classList.add("bg-white", "text-[#4A9F50]");
  });
});

// Barcha linklarni olish
const scrollLinks = document.querySelectorAll(".scroll-link");

scrollLinks.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    const targetId = link.getAttribute("href").substring(1);
    const targetSection = document.getElementById(targetId);

    window.scrollTo({
      top: targetSection.offsetTop,
      behavior: "smooth", // Animatsiyali tushish
    });
  });
});

// Formani tekshirish va tugmani yoqish
function validateForm() {
  if (
    nameInput.value.trim() !== "" &&
    phoneInput.value.trim() !== "" &&
    branchSelect.value !== ""
  ) {
    submitButton.disabled = false;
    submitButton.classList.remove("opacity-50", "cursor-not-allowed");
  } else {
    submitButton.disabled = true;
    submitButton.classList.add("opacity-50", "cursor-not-allowed");
  }
}

// Maydonlarni kuzatish
nameInput.addEventListener("input", validateForm);
phoneInput.addEventListener("input", validateForm);
branchSelect.addEventListener("change", validateForm);

// Submit bosilganda modalni ko'rsatish
submitButton.addEventListener("click", function (e) {
    const { value: name } = document.querySelector("#nameInput");
    const { value: phone } = document.querySelector("#phoneInput");
    const { value: branch_id } = document.querySelector("#branchSelect");

    console.log(name, phone, branch_id,$('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        "type": 'POST',
        "url": 'api/call_backs/store',
        "data": {
            "name": name,
            "phone": phone,
            "branch_id": branch_id
        },
        "beforeSend": function () {
            $("body").addClass("loading");
        },
        "success": function (data) {
            $("body").removeClass("loading");
            if( data && data.status && data.result ){
                e.preventDefault();
                successModal.classList.remove("hidden");
            }else{
                Swal.fire({
                    position: 'top-end',
                    type: "error",
                    title: data.error.message,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        },
        "error": function (err) {
            $("body").removeClass("loading");
            console.log(err);
        }
    });
});

// "OK" tugmasini bosganda muvaffaqiyatli animatsiya ishlaydi
okButton.addEventListener("click", function () {
  successModal.classList.add("hidden");
  form.classList.add("hidden");
  successMessage.classList.remove("hidden");

  gsap.fromTo(
    "#successTitle",
    { opacity: 0, y: -20 },
    { opacity: 1, y: 0, duration: 0.8 }
  );
  gsap.fromTo(
    "#successText",
    { opacity: 0, y: -20 },
    { opacity: 1, y: 0, duration: 0.8, delay: 0.3 }
  );

  showSuccessMessage();
});

// Muvaffaqiyatli animatsiya funksiyasi
function showSuccessMessage() {
  const tl = gsap.timeline();
  successMessage.classList.remove("hidden");

  tl.to("#circle", {
    strokeDashoffset: 0,
    duration: 1,
  });

  tl.to(
    "#checkMark",
    {
      strokeDashoffset: 0,
      duration: 0.5,
    },
    "-=0.5"
  );

  tl.to("#successTitle", {
    opacity: 1,
    y: -10,
    duration: 0.5,
  });

  tl.to("#successText", {
    opacity: 1,
    y: -10,
    duration: 0.5,
  });
}
