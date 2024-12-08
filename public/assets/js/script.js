document.getElementById("sidebarToggle").addEventListener("click", function () {
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("main-content");

  if (sidebar.style.marginLeft === "-250px") {
    sidebar.style.marginLeft = "0";
    mainContent.style.marginLeft = "250px";
  } else {
    sidebar.style.marginLeft = "-250px";
    mainContent.style.marginLeft = "0";
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Ambil tombol submit
  const submitButton = document.getElementById("submitInsertKompetisi");

  // Tambahkan event listener untuk mengirim data via AJAX
  submitButton.addEventListener("click", function () {
    // Ambil data dari form
    const formData = new FormData(
      document.getElementById("insertKompetisiForm")
    );

    // Kirim data melalui AJAX
    fetch("<?= BASE_URL; ?>mahasiswa/insertKompetisi", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("HTTP error " + response.status);
        }
        return response.json();
      })
      .then((data) => {
        // Cek apakah berhasil atau tidak
        if (data.success) {
          alert("Data berhasil ditambahkan!");
          // Tutup modal
          const insertModal = new bootstrap.Modal(
            document.getElementById("insertModal3")
          );
          insertModal.hide();

          // Refresh data tabel (opsional, tambahkan implementasi sesuai kebutuhan)
          location.reload();
        } else {
          alert("Gagal menambahkan data: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Terjadi kesalahan:", error);
        alert("Gagal mengirim data. Silakan coba lagi.");
      });
  });
});
