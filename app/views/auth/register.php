<div class="card w-50 mx-auto">
    <div class="card-body">
        <h5 class="card-title text-center mb-5">Register</h5>
        <form id="registerForm" method="POST" action="<?= BASE_URL; ?>auth/register">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    <option value="">-- SELECT ROLE --</option>
                    <?php
                    // Koneksi ke database
                    require_once '../config/Database.php'; // Sesuaikan path ke Database.php
                    $db = new Database();
                    $conn = $db->connect();

                    // Query untuk mengambil data role
                    $query = "SELECT id, role_name FROM roles";
                    $stmt = sqlsrv_query($conn, $query);

                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }

                    // Loop data role dari database
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'>{$row['role_name']}</option>";
                    }

                    // Tutup koneksi
                    sqlsrv_free_stmt($stmt);
                    sqlsrv_close($conn);
                    ?>
                </select>
            </div>
            <div style="text-align: center;">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>

        <!-- Tempat untuk menampilkan pesan error atau sukses -->
        <div id="registerMessage"></div>
    </div>
</div>