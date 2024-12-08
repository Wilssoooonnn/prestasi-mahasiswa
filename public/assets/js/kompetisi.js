let currentPage = 1;

function loadKompetisi(page = 1) {
  currentPage = page;
  fetch(baseURL + "admin/loadKompetisiAjax", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `page=${page}`,
  })
    .then((response) => response.json())
    .then((data) => {
      updateTable(data.data, "kompetisiTableBody");
      updatePagination(data.totalPages, data.currentPage, "loadKompetisi");
    })
    .catch((error) => console.error("Error loading kompetisi data:", error));
}

function loadKompetisiMahasiswa(page = 1) {
  currentPage = page;
  fetch(baseURL + "mahasiswa/loadKompetisiAjax", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `page=${page}`,
  })
    .then((response) => response.json())
    .then((data) => {
      updateTable(data.data, "mahasiswaTableBody");
      updatePagination(
        data.totalPages,
        data.currentPage,
        "loadKompetisiMahasiswa"
      );
    })
    .catch((error) =>
      console.error("Error loading mahasiswa kompetisi data:", error)
    );
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
function updatePagination(totalPages, currentPage, loadFunction) {
  const pagination = document.getElementById("pagination");
  let paginationHTML = "";

  // Tombol Previous
  if (currentPage > 1) {
    paginationHTML += `
      <li class="page-item">
        <a class="page-link" href="#" onclick="${loadFunction}(${
      currentPage - 1
    })">Previous</a>
      </li>`;
  }

  // Halaman Tengah
  for (let i = 1; i <= totalPages; i++) {
    paginationHTML += `
      <li class="page-item ${i === currentPage ? "active" : ""}">
        <a class="page-link" href="#" onclick="${loadFunction}(${i})">${i}</a>
      </li>`;
  }

  // Tombol Next
  if (currentPage < totalPages) {
    paginationHTML += `
      <li class="page-item">
        <a class="page-link" href="#" onclick="${loadFunction}(${
      currentPage + 1
    })">Next</a>
      </li>`;
  }

  pagination.innerHTML = paginationHTML;
}

document.addEventListener("DOMContentLoaded", () => {
  if (document.getElementById("kompetisiTableBody")) {
    loadKompetisi();
  }
  if (document.getElementById("mahasiswaTableBody")) {
    loadKompetisiMahasiswa();
  }
});
