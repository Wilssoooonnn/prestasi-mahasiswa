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
