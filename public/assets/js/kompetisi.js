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
  function handleFormSubmission() {
    // Tombol "Next" di modal pertama
    document
      .querySelector("#insertModal .btn-outline-primary")
      .addEventListener("click", function () {
        const form1 = new FormData(document.getElementById("formDataDiri"));
        if (validateForm1(form1)) {
          console.log("Data Form 1: ", Object.fromEntries(form1)); // Debugging
          localStorage.setItem(
            "form1Data",
            JSON.stringify(Object.fromEntries(form1))
          );
          showModal("insertModal2");
        } else {
          alert("Pastikan semua field di Form 1 terisi!");
        }
      });

    // Tombol "Save" di modal kedua
    document
      .querySelector("#insertModal2 .btn-outline-primary")
      .addEventListener("click", function () {
        const form1Data = JSON.parse(localStorage.getItem("form1Data"));
        const form2 = new FormData(document.getElementById("formUploadFile"));

        if (validateForm2(form2)) {
          console.log("Data Form 1 (From LocalStorage): ", form1Data); // Debugging
          console.log("Data Form 2: ", Object.fromEntries(form2)); // Debugging

          // Combine form1Data and form2 into one FormData
          const finalData = new FormData();

          // Append data from form1Data to finalData
          if (form1Data) {
            Object.entries(form1Data).forEach(([key, value]) => {
              finalData.append(key, value);
            });
          }

          // Append form2 data (files) to finalData
          form2.forEach((value, key) => {
            finalData.append(key, value);
          });

          console.log("Final Data before submit: ", finalData);
          submitFormData(finalData);
        } else {
          alert("Pastikan semua file di Form 2 terupload!");
        }
      });
  }

  function showModal(modalId) {
    const modal = new bootstrap.Modal(document.getElementById(modalId));
    modal.show();
  }

  function validateForm1(formData) {
    // Validate the first form fields
    return (
      formData.get("jenis_id") &&
      formData.get("tingkat_id") &&
      formData.get("nama_kompetisi")
    );
  }

  function validateForm2(formData) {
    // Validate the second form fields (file inputs)
    return (
      formData.get("file_surat_tugas") &&
      formData.get("file_sertifikat") &&
      formData.get("foto_kegiatan") &&
      formData.get("file_poster")
    );
  }

  function submitFormData(finalData) {
    fetch(baseURL + "mahasiswa/insertKompetisi", {
      method: "POST",
      body: finalData,
    })
      .then((response) => {
        // Check if the response is not OK
        if (!response.ok) {
          throw new Error(
            "Network response was not ok: " + response.statusText
          );
        }

        // Read the response text first to inspect if it's valid JSON or HTML
        return response.text().then((text) => {
          // Try parsing the response text as JSON
          try {
            const data = JSON.parse(text);
            console.log("Parsed JSON:", data);
          } catch (error) {
            // If parsing fails, log the raw response text for debugging
            console.error("Response is not valid JSON:", text);
            alert(
              "The server responded with an error or unexpected data. Check the server logs."
            );
          }
        });
      })
      .catch((error) => {
        alert("Error occurred: " + error.message);
        console.error("Error details:", error);
      });
  }

  function handleFormUpdate() {
    // Tombol "Next" di modal pertama
    document
      .querySelector("#editModal .btn-outline-primary")
      .addEventListener("click", function () {
        const form1 = new FormData(
          document.getElementById("formUpdateDataDiri")
        );
        if (validateForm1(form1)) {
          console.log("Data Form 1: ", Object.fromEntries(form1)); // Debugging
          localStorage.setItem(
            "form1Data",
            JSON.stringify(Object.fromEntries(form1))
          );
          showModal("editModal2");
        } else {
          alert("Pastikan semua field di Form 1 terisi!");
        }
      });

    // Tombol "Save" di modal kedua
    document
      .querySelector("#editModal2 .btn-outline-primary")
      .addEventListener("click", function () {
        const form1Data = JSON.parse(localStorage.getItem("form1Data"));
        const form2 = new FormData(document.getElementById("formUpdateFile"));

        console.log("Data Form 1 (From LocalStorage): ", form1Data); // Debugging
        console.log("Data Form 2: ", Object.fromEntries(form2)); // Debugging

        // Combine form1Data and form2 into one FormData
        const finalData = new FormData();

        // Append data from form1Data to finalData
        if (form1Data) {
          Object.entries(form1Data).forEach(([key, value]) => {
            finalData.append(key, value);
          });
        }

        // Append form2 data (files) to finalData
        form2.forEach((value, key) => {
          finalData.append(key, value);
        });

        console.log("Final Data before update: ", finalData);
        submitFormUpdate(finalData);
      });
  }

  function submitFormUpdate(finalData) {
    fetch(baseURL + "mahasiswa/updateKompetisi", {
      method: "POST",
      body: finalData,
    })
      .then((response) => {
        // Check if the response is not OK
        if (!response.ok) {
          throw new Error(
            "Network response was not ok: " + response.statusText
          );
        }

        // Read the response text first to inspect if it's valid JSON or HTML
        return response.text().then((text) => {
          // Try parsing the response text as JSON
          try {
            const data = JSON.parse(text);
            console.log("Parsed JSON:", data);
          } catch (error) {
            // If parsing fails, log the raw response text for debugging
            console.error("Response is not valid JSON:", text);
            alert(
              "The server responded with an error or unexpected data. Check the server logs."
            );
          }
        });
      })
      .catch((error) => {
        alert("Error occurred: " + error.message);
        console.error("Error details:", error);
      });
  }

  handleFormSubmission();
  handleFormUpdate();
});

// function submitFormData(finalData) {
//   fetch("/mahasiswa/insertKompetisi", {
//     method: "POST",
//     body: finalData,
//   })
//     .then((response) => {
//       if (!response.ok) {
//         throw new Error(
//           "Network response was not ok: " + response.statusText
//         );
//       }
//       return response.json();
//     })
//     .then((data) => {
//       console.log("Parsed JSON:", data);
//     })
//     .catch((error) => {
//       alert("Error occurred: " + error.message);
//       console.error("Error details:", error);
//     });
// }
