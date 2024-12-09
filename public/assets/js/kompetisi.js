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
                    onclick="showDetail(${row.id})">
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
function showDetail(kompetisiId) {
  // Fetch the competition details from the server using its ID
  fetch(baseURL + "admin/getKompetisiDetail?id=" + kompetisiId)
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        console.error("Error fetching competition details:", data.error);
      } else {
        // Update modal fields with the fetched data
        document.getElementById("detailNIM").textContent = data.NIM;
        document.getElementById("detailNama").textContent = data.Nama_Mahasiswa;
        document.getElementById("detailKompetisi").textContent =
          data.Nama_Kompetisi;
        document.getElementById("detailJenis").textContent =
          data.Jenis_Kompetisi;
        document.getElementById("detailTingkat").textContent =
          data.Tingkat_Kompetisi;
        document.getElementById("detailTempat").textContent =
          data.Tempat_Kompetisi;
        document.getElementById("detailURL").href = data.URL_Kompetisi;
        document.getElementById("detailSurat").textContent =
          data.No_Surat_Tugas;
      }
    })
    .catch((error) => console.error("Error:", error));
}

document.addEventListener("DOMContentLoaded", function () {
  // Tombol "Next" di modal pertama
  document
    .querySelector("#insertModal .btn-outline-primary")
    .addEventListener("click", function () {
      const form1 = new FormData(document.getElementById("formDataDiri"));
      console.log("Data Form 1: ", Object.fromEntries(form1)); // Debugging
      localStorage.setItem(
        "form1Data",
        JSON.stringify(Object.fromEntries(form1))
      );
      const nextModal = new bootstrap.Modal(
        document.getElementById("insertModal2")
      );
      nextModal.show();
    });

  // Tombol "Next" di modal kedua
  document
    .querySelector("#insertModal2 .btn-outline-primary")
    .addEventListener("click", function () {
      const form2 = new FormData(document.getElementById("formUploadFile"));
      console.log("Data Form 2: ", Object.fromEntries(form2)); // Debugging
      localStorage.setItem(
        "form2Data",
        JSON.stringify(Object.fromEntries(form2))
      );
      const nextModal = new bootstrap.Modal(
        document.getElementById("insertModal3")
      );
      nextModal.show();
    });

  // Tombol "Save" di modal ketiga
  document
    .querySelector("#insertModal3 .btn-outline-primary")
    .addEventListener("click", function () {
      const form1Data = JSON.parse(localStorage.getItem("form1Data"));
      const form2Data = JSON.parse(localStorage.getItem("form2Data"));
      const form3 = new FormData(document.getElementById("formDataKompetisi"));

      console.log("Data Form 1 (From LocalStorage): ", form1Data); // Debugging
      console.log("Data Form 2 (From LocalStorage): ", form2Data); // Debugging
      console.log("Data Form 3: ", Object.fromEntries(form3)); // Debugging

      // Menggabungkan semua data
      const finalData = new FormData();
      Object.entries(form1Data).forEach(([key, value]) => {
        console.log(`Appending ${key}: ${value}`); // Debugging
        finalData.append(key, value);
      });
      Object.entries(form2Data).forEach(([key, value]) => {
        console.log(`Appending ${key}: ${value}`); // Debugging
        finalData.append(key, value);
      });
      form3.forEach((value, key) => {
        console.log(`Appending ${key}: ${value}`); // Debugging
        finalData.append(key, value);
      });

      // Debugging sebelum mengirim data
      console.log("Final Data to be sent: ", finalData);

      // Mengirim data ke server
      fetch(baseURL + "admin/insertKompetisi", {
        method: "POST",
        body: finalData,
      })
        .then((response) => response.json())
        .then((data) => {
          console.log("Server Response: ", data); // Debugging response server
          if (data.success) {
            alert("Data berhasil ditambahkan!");
            window.location.reload();
          } else {
            alert("Terjadi kesalahan: " + data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error); // Debugging error
        });
    });
});
