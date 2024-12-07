function loadDetailData(data) {
  document.getElementById("detailNIM").textContent = data.NIM;
  document.getElementById("detailNama").textContent = data.Nama_Mahasiswa;
  document.getElementById("detailKompetisi").textContent = data.Nama_Kompetisi;
  document.getElementById("detailJenis").textContent = data.Jenis_Kompetisi;
  document.getElementById("detailTingkat").textContent = data.Tingkat_Kompetisi;
  document.getElementById("detailTempat").textContent = data.Tempat_Kompetisi;
  document.getElementById("detailURL").setAttribute("href", data.URL_Kompetisi);
  document.getElementById("detailSurat").textContent = data.No_Surat_Tugas;
}

let currentPage = 1;

// Fungsi untuk memuat data kompetisi dari server
function loadKompetisi(page = 1) {
  currentPage = page; // Update halaman saat ini
  fetch(baseURL + "admin/loadKompetisiAjax", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `page=${page}`,
  })
    .then((response) => response.json())
    .then((data) => {
      // Update tabel data
      updateTable(data.data);

      // Update navigasi pagination
      updatePagination(data.totalPages, data.currentPage);
    })
    .catch((error) => console.error("Error loading kompetisi data:", error));
}

// Fungsi untuk memperbarui isi tabel
function updateTable(data) {
  const tbody = document.getElementById("kompetisiTableBody");
  if (data.length === 0) {
    tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data kompetisi</td>
                </tr>
            `;
    return;
  }

  tbody.innerHTML = data
    .map(
      (row) => `
            <tr>
                <td>${row.NIM}</td>
                <td>${row.Nama_Mahasiswa}</td>
                <td>${row.Nama_Kompetisi}</td>
                <td>${row.Jenis_Kompetisi}</td>
                <td>${row.Tingkat_Kompetisi}</td>
                <td>${row.No_Surat_Tugas}</td>
                <td>
                <button class="btn btn-outline-success">
                    <i class="fi fi-rr-check"></i>
                </button>
                <button class="btn btn-outline-danger">
                    <i class="fi fi-rr-cross"></i>
                </button>
                <button class="btn btn-outline-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#detailModal"
                    onclick="loadDetailData(${JSON.stringify(row)})">
                    <i class="fi fi-rr-eye"></i>
                </button>
                </td>
            </tr>
        `
    )
    .join("");
}

// Fungsi untuk memperbarui pagination
function updatePagination(totalPages, currentPage) {
  const pagination = document.getElementById("pagination");
  let paginationHTML = "";

  // Tombol Previous
  if (currentPage > 1) {
    paginationHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" onclick="loadKompetisi(${
                      currentPage - 1
                    })">Previous</a>
                </li>
            `;
  }

  // Halaman tengah
  for (let i = 1; i <= totalPages; i++) {
    paginationHTML += `
                <li class="page-item ${i === currentPage ? "active" : ""}">
                    <a class="page-link" href="#" onclick="loadKompetisi(${i})">${i}</a>
                </li>
            `;
  }

  // Tombol Next
  if (currentPage < totalPages) {
    paginationHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" onclick="loadKompetisi(${
                      currentPage + 1
                    })">Next</a>
                </li>
            `;
  }

  pagination.innerHTML = paginationHTML;
}

// Muat data pertama kali saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
  loadKompetisi();
});
