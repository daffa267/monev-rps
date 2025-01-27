// Sidebar toggle functionality
document
  .querySelector(".toggle-sidebar")
  .addEventListener("click", function () {
    document
      .querySelector(".dashboard-container")
      .classList.toggle("sidebar-collapsed");
  });

// Fungsi untuk menampilkan atau menyembunyikan submenu RPS dan BAP
document.addEventListener("DOMContentLoaded", function () {
  // Elemen untuk submenu RPS
  const menuRPS = document.getElementById("menuRPS");
  const unggahRpsMenu = document.getElementById("unggahRpsMenu");
  const daftarUploadRpsMenu = document.getElementById("daftarUploadRpsMenu");
  const chevronIconRPS = document.querySelector("#menuRPS .chevron-icon");

  // Elemen untuk submenu BAP
  const menuBAP = document.getElementById("menuBAP");
  const isiBapMenu = document.getElementById("isiBapMenu");
  const daftarBapMenu = document.getElementById("daftarBapMenu");
  const chevronIconBAP = document.querySelector("#menuBAP .chevron-icon");

  // Set initial visibility berdasarkan localStorage
  const isRPSSubmenuVisible =
    localStorage.getItem("submenuRPSVisible") === "true";
  const isBAPSubmenuVisible =
    localStorage.getItem("submenuBAPVisible") === "true";

  // Inisialisasi visibilitas submenu RPS
  [unggahRpsMenu, daftarUploadRpsMenu].forEach((subMenu) => {
    subMenu.style.display = isRPSSubmenuVisible ? "block" : "none";
  });
  chevronIconRPS.classList.toggle("bi-chevron-down", isRPSSubmenuVisible);
  chevronIconRPS.classList.toggle("bi-chevron-left", !isRPSSubmenuVisible);

  // Inisialisasi visibilitas submenu BAP
  [isiBapMenu, daftarBapMenu].forEach((subMenu) => {
    subMenu.style.display = isBAPSubmenuVisible ? "block" : "none";
  });
  chevronIconBAP.classList.toggle("bi-chevron-down", isBAPSubmenuVisible);
  chevronIconBAP.classList.toggle("bi-chevron-left", !isBAPSubmenuVisible);

  // Toggle submenu RPS dan simpan status di localStorage
  menuRPS.addEventListener("click", function (event) {
    event.preventDefault();
    const isHidden = unggahRpsMenu.style.display === "none";

    [unggahRpsMenu, daftarUploadRpsMenu].forEach((subMenu) => {
      subMenu.style.display = isHidden ? "block" : "none";
    });
    chevronIconRPS.classList.toggle("bi-chevron-left", !isHidden);
    chevronIconRPS.classList.toggle("bi-chevron-down", isHidden);

    localStorage.setItem("submenuRPSVisible", isHidden);
  });

  // Toggle submenu BAP dan simpan status di localStorage
  menuBAP.addEventListener("click", function (event) {
    event.preventDefault();
    const isHidden = isiBapMenu.style.display === "none";

    [isiBapMenu, daftarBapMenu].forEach((subMenu) => {
      subMenu.style.display = isHidden ? "block" : "none";
    });
    chevronIconBAP.classList.toggle("bi-chevron-left", !isHidden);
    chevronIconBAP.classList.toggle("bi-chevron-down", isHidden);

    localStorage.setItem("submenuBAPVisible", isHidden);
  });

  // Prevent bubbling untuk item submenu RPS
  unggahRpsMenu.addEventListener("click", function (event) {
    event.stopPropagation();
  });
  daftarUploadRpsMenu.addEventListener("click", function (event) {
    event.stopPropagation();
  });

  // Prevent bubbling untuk item submenu BAP
  isiBapMenu.addEventListener("click", function (event) {
    event.stopPropagation();
  });
  daftarBapMenu.addEventListener("click", function (event) {
    event.stopPropagation();
  });

  // Highlight aktif menu berdasarkan URL saat ini
  const currentUrl = window.location.pathname;

  // Reset kelas aktif sebelum mengatur ulang
  const activeElements = document.querySelectorAll(".active-submenu");
  activeElements.forEach((el) => el.classList.remove("active-submenu"));

  // Terapkan kelas aktif untuk submenu RPS
  if (currentUrl.includes("unggah-rps.html")) {
    unggahRpsMenu.classList.add("active-submenu");
  } else if (currentUrl.includes("daftar-upload-rps.html")) {
    daftarUploadRpsMenu.classList.add("active-submenu");
  }

  // Terapkan kelas aktif untuk submenu BAP
  if (currentUrl.includes("isi-bap.html")) {
    isiBapMenu.classList.add("active-submenu");
  } else if (currentUrl.includes("daftar-bap.html")) {
    daftarBapMenu.classList.add("active-submenu");
  }
});
