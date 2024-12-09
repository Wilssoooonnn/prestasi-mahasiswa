fetch("http:localhost/prestasi-mahasiswa/public/assets/images/header.svg")
  .then((response) => response.text())
  .then((data) => {
    document.getElementById("svgContainer").innerHTML = data;
  });
