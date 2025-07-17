<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 100px);">
    <div class="card shadow p-4" style="min-width: 320px; max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4">Register</h3>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/register" novalidate>
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control <?= !empty($errors['login']) ? 'is-invalid' : '' ?>" id="login" name="login" value="<?= htmlspecialchars($old['login'] ?? '') ?>" required>
                <?php if (!empty($errors['login'])) : ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($errors['login']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>" id="password" name="password" required>
                <?php if (!empty($errors['password'])) : ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($errors['password']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password_repeat" class="form-label">Repeat Password</label>
                <input type="password" class="form-control <?= !empty($errors['password_repeat']) ? 'is-invalid' : '' ?>" id="password_repeat" name="password_repeat" required>
                <?php if (!empty($errors['password_repeat'])) : ?>
                    <div class="invalid-feedback">
                        <?= htmlspecialchars($errors['password_repeat']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark">Register</button>
            </div>
        </form>
    </div>
</div>