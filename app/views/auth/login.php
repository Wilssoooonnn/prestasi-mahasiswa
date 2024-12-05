<div class="card w-25 mx-auto position-absolute top-50 start-50 translate-middle">
  <div class="card-body">
    <h5 class="card-title text-center mb-4">Login</h5>
    <form id="loginForm" method="POST" action="<?= BASE_URL; ?>auth/login">

      <div class="form-group mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fi fi-rr-user" style="font-size: 16px;"></i>
            </span>
          </div>
          <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
        </div>
      </div>

      <div class="form-group mb-4">
        <label for="password" class="form-label">Password</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fi fi-rr-lock" style="font-size: 16px;"></i>
            </span>
          </div>
          <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
        </div>
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>