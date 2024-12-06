</div>
<!-- Source JavaScript -->
<script src="<?= BASE_URL; ?>/public/assets/js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.2.0/dist/js/coreui.bundle.min.js" integrity="sha384-JdRP5GRWP6APhoVS1OM/pOKMWe7q9q8hpl+J2nhCfVJKoS+yzGtELC5REIYKrymn" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- End Source JavaScript -->

<!-- Script Code -->
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        if (sidebar.style.marginLeft === '-250px') {
            sidebar.style.marginLeft = '0';
            mainContent.style.marginLeft = '250px';
        } else {
            sidebar.style.marginLeft = '-250px';
            mainContent.style.marginLeft = '0';
        }
    });
</script>

<!-- End Script Code -->
</body>

</html>