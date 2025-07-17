<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 100px);">
    <div class="card shadow-sm p-4" style="min-width: 320px; max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4">Authorisation</h3>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="/login">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark">Login</button>
            </div>
        </form>
    </div>
</div>