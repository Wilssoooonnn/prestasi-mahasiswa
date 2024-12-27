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
                <td>${row.kompetisi_id}</td>
                <td>${row.NIM}</td>
                <td>${row.Nama_Mahasiswa}</td>
                <td>${row.Nama_Kompetisi}</td>
                <td>${row.Jenis_Kompetisi}</td>
                <td>${row.Tingkat_Kompetisi}</td>
                <td>${row.No_Surat_Tugas}</td>
                <td class="text-center">
                    <span class="${
                      row.Status === "Proses"
                        ? "badge bg-warning text-white"
                        : row.Status === "Berhasil"
                        ? "badge bg-success text-white"
                        : "badge bg-danger text-white"
                    }">
                        ${row.Status}
                    </span>
                </td>
                <td>
                <button class="btn btn-outline-success"
                    data-bs-toggle="modal"
                    data-bs-target="#ApproveModal"
                    onclick="setApproveModal(${row.kompetisi_id})">
                    <i class="fi fi-rr-check"></i>
                </button>
                <button class="btn btn-outline-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#DeclineModal"
                    onclick="setDeclineModal(${row.kompetisi_id})">
                    <i class="fi fi-rr-cross"></i>
                </button>
                <button class="btn btn-outline-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#detailModal"
                    onclick="showDetail(${row.NIM},${row.kompetisi_id})">
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
function showDetail(nim, kompetisiId) {
  console.log(
    "Requesting data for NIM:",
    nim,
    "and Kompetisi ID:",
    kompetisiId
  );

  fetch(baseURL + "admin/getKompetisiDetail/" + nim + "/" + kompetisiId)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("Data received:", data);

      // Pastikan data yang diterima tidak kosong atau error
      if (data && !data.error) {
        // Tampilkan detail informasi kompetisi
        document.getElementById("detailNIM").innerText =
          data[0]["NIM"] || "N/A";
        document.getElementById("detailNama").innerText =
          data[0]["Nama_Mahasiswa"] || "N/A";
        document.getElementById("detailKompetisi").innerText =
          data[0]["Nama_Kompetisi"] || "N/A";
        document.getElementById("detailJenis").innerText =
          data[0]["Jenis_Kompetisi"] || "N/A";
        document.getElementById("detailTingkat").innerText =
          data[0]["Tingkat_Kompetisi"] || "N/A";
        document.getElementById("detailTempat").innerText =
          data[0]["Tempat_Kompetisi"] || "N/A";
        document.getElementById("detailURL").href =
          data[0]["URL_Kompetisi"] || "#";
        document.getElementById("detailSurat").innerText =
          data[0]["No_Surat_Tugas"] || "N/A";

        // Mengambil dan menampilkan gambar-gambar
        const imageContainer = document.getElementById("imageContainer");
        imageContainer.innerHTML = ""; // Bersihkan gambar sebelumnya jika ada

        if (data[0]["images"] && Array.isArray(data[0]["images"])) {
          data[0]["images"].forEach((imageUrl) => {
            const card = document.createElement("div");
            card.classList.add("card");
            const img = document.createElement("img");
            img.classList.add("card-img-top");
            img.src = imageUrl
              ? imageUrl
              : baseURL + "public/assets/images/images-default.jpg";
            img.alt = "Image"; // Set Alt text
            card.appendChild(img);
            imageContainer.appendChild(card); // Tambahkan ke container gambar
          });
        } else {
          console.warn("No images found in the data.");
        }
      } else {
        console.error("Data tidak lengkap atau error:", data);
        alert("Data kompetisi tidak lengkap atau terjadi kesalahan.");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Terjadi kesalahan saat memuat detail kompetisi.");
    });
}
/*


Insert Kompetisi


*/

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
    const modal = new bootstrap.Modal(document.getElementById(modalId), {
      backdrop: false, // Hilangkan modal-backdrop
    });
    modal.show();
  }

  function closeAllModals() {
    // Tutup semua modal aktif
    const modals = document.querySelectorAll(".modal.show");
    modals.forEach((modal) => {
      const instance = bootstrap.Modal.getInstance(modal);
      if (instance) instance.hide();
    });
  }

  function submitFormData(finalData) {
    console.log(baseURL + "mahasiswa/insertKompetisi");
    fetch(baseURL + "mahasiswa/insertKompetisi", {
      method: "POST",
      body: finalData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(
            "Network response was not ok: " + response.statusText
          );
        }

        return response.json();
      })
      .then((data) => {
        if (data.success) {
          console.log("Data berhasil disimpan: ", data);
          closeAllModals(); // Tutup semua modal
          showModal("successModal"); // Tampilkan modal sukses
        } else {
          alert("Terjadi kesalahan saat menyimpan data!");
        }
      })
      .catch((error) => {
        alert("Error occurred: " + error.message);
        console.error("Error details:", error);
      });
  }

  handleFormSubmission();
});
/*

Approve Kompetisi

*/
function setApproveModal(kompetisiId) {
  const approveButton = document.getElementById("approveButton");
  approveButton.setAttribute("onclick", `approveStatus(${kompetisiId})`);
}

// Fungsi untuk mengirim permintaan approve
function approveStatus(kompetisiId) {
  console.log("Menyetujui kompetisi ID:", kompetisiId);

  fetch(baseURL + "admin/approveKompetisi/" + kompetisiId)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      const approveButton = document.getElementById("approveButton");
      const approveMessage = document.getElementById("approveMessage");
      const closeButton = document.getElementById("closeButton");
      if (data.success) {
        console.log(data.message);
        approveButton.className = "btn btn-success";
        approveButton.innerText = "Disetujui";
        approveMessage.innerText = "Data berhasil diterima.";
        closeButton.style.display = "none";
        setTimeout(() => {
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("ApproveModal")
          );
          modal.hide(); // Tutup modal
          location.reload(); // Muat ulang halaman
        }, 1000);
      } else {
        console.error(data.message);
        approveButton.innerText = "Gagal";
      }
    })
    .catch((error) => {
      console.error("Terjadi kesalahan:", error);
    });
}

function setDeclineModal(kompetisiId) {
  const declineButton = document.getElementById("declineButton");
  declineButton.setAttribute("onclick", `declineStatus(${kompetisiId})`);
}

// Fungsi untuk mengirim permintaan approve
function declineStatus(kompetisiId) {
  console.log("Menolak kompetisi ID:", kompetisiId);

  fetch(baseURL + "admin/declineKompetisi/" + kompetisiId)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      const declineButton = document.getElementById("declineButton");
      const declineMessage = document.getElementById("declineMessage");
      const closeButton = document.getElementById("closeButtonDecline");
      if (data.success) {
        console.log(data.message);
        declineButton.innerText = "Digagalkan";
        declineMessage.innerText = "Data berhasil digagalkan.";
        closeButton.style.display = "none";
        setTimeout(() => {
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("DeclineModal")
          );
          modal.hide(); // Tutup modal
          location.reload(); // Muat ulang halaman
        }, 1000);
      } else {
        console.error(data.message);
        declineButton.innerText = "Gagal";
      }
    })
    .catch((error) => {
      console.error("Terjadi kesalahan:", error);
    });
}

// Handle form update
document.addEventListener("DOMContentLoaded", function () {
  // Fungsi untuk submit data ke server
  function submitFormUpdate(finalData) {
    fetch(baseURL + "mahasiswa/updateKompetisi", {
      method: "POST",
      body: finalData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(
            `Network response was not ok: ${response.statusText}`
          );
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          alert("Data berhasil diperbarui!");
          location.reload(); // Reload halaman setelah berhasil
        } else {
          alert("Gagal memperbarui data. Silakan periksa kembali.");
          console.error("Error response from server:", data);
        }
      })
      .catch((error) => {
        alert("Terjadi kesalahan: " + error.message);
        console.error("Error details:", error);
      });
  }

  // Event delegation untuk tombol "Next"
  document.body.addEventListener("click", function (event) {
    if (event.target.matches(".btn-outline-primary[data-next]")) {
      const kompetisiId = event.target.getAttribute("data-competisi-id");
      const formElement = document.querySelector(
        `#formUpdateDataDiri${kompetisiId}`
      );
      if (!formElement) {
        console.error(
          `Form with ID formUpdateDataDiri${kompetisiId} not found`
        );
        return;
      }
      const form1 = new FormData(formElement);

      // Validasi Form 1
      if (validateForm1(form1)) {
        console.log(`Data Form 1 (${kompetisiId}):`, Object.fromEntries(form1));
        localStorage.setItem(
          `form1Data_${kompetisiId}`,
          JSON.stringify(Object.fromEntries(form1))
        );

        // Tutup modal pertama
        const modal1Id = `editModal${kompetisiId}`;
        const modal1 = bootstrap.Modal.getInstance(
          document.getElementById(modal1Id)
        );
        if (modal1) modal1.hide();

        // Tampilkan modal kedua
        const modal2Id = `editModal2${kompetisiId}`;
        const modal2 = new bootstrap.Modal(document.getElementById(modal2Id));
        modal2.show();
      } else {
        alert("Pastikan semua field di Form 1 terisi!");
      }
    }
  });

  // Event delegation untuk tombol "Save"
  document.body.addEventListener("click", function (event) {
    if (event.target.matches(".btn-outline-primary[data-save]")) {
      const kompetisiId = event.target.getAttribute("data-competisi-id");
      const form1Data = JSON.parse(
        localStorage.getItem(`form1Data_${kompetisiId}`)
      );
      const form2 = new FormData(
        document.querySelector(`#formUpdateFile${kompetisiId}`)
      );

      console.log(`Data Form 2 (${kompetisiId}):`, Object.fromEntries(form2));

      // Gabungkan data dari Form 1 dan Form 2
      const finalData = new FormData();
      Object.entries(form1Data).forEach(([key, value]) => {
        finalData.append(key, value);
      });
      for (let [key, value] of form2.entries()) {
        finalData.append(key, value);
      }

      console.log(
        `Final Data (${kompetisiId}):`,
        Object.fromEntries(finalData)
      );
      submitFormUpdate(finalData);
    }
  });
});
