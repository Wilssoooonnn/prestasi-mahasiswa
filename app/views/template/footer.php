</body>

<script src="<?= BASE_URL; ?>/public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>/public/assets/js/jquery.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    document.getElementById("toggleBtn").addEventListener("click", function() {
        const sidebar = document.getElementById("sidebar");

        if (sidebar.classList.contains("collapsed")) {
            sidebar.classList.remove("collapsed");
            sidebar.classList.add("expanded");
        } else {
            sidebar.classList.remove("expanded");
            sidebar.classList.add("collapsed");
        }
    });
</script>

</html>