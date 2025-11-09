document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("sidebar-toggle");
  const appContainer = document.querySelector(".app-container");
  const storageKey = "sidebarState";

  if (!toggleButton || !appContainer) {
    return;
  }

  // Fungsi untuk menerapkan state dari localStorage
  const applySidebarState = (state) => {
    if (state === "collapsed") {
      appContainer.classList.add("sidebar-collapsed");
    } else {
      appContainer.classList.remove("sidebar-collapsed");
    }
  };

  // Cek localStorage saat halaman dimuat
  const savedState = localStorage.getItem(storageKey);
  if (savedState) {
    applySidebarState(savedState);
  }

  // Tambahkan event listener ke tombol toggle
  toggleButton.addEventListener("click", () => {
    appContainer.classList.toggle("sidebar-collapsed");

    // Simpan state baru ke localStorage
    const newState = appContainer.classList.contains("sidebar-collapsed")
      ? "collapsed"
      : "expanded";
    localStorage.setItem(storageKey, newState);
  });
});
