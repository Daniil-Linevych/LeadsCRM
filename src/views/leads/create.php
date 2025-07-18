<h2 class="fw-bold mb-4 mt-4"><?= $isEditing ? "Edit Lead" : 'Add New Lead' ?></h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action=<?= $isEditing ? "/leads/{$old['id']}/edit" : '/leads' ?>>
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Lead name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
                <?php if (!empty($errors['name'])) : ?>
                    <div class="text-danger small"><?= $errors['name'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="user@gmail.com" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                <?php if (!empty($errors['email'])) : ?>
                    <div class="text-danger small"><?= $errors['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="+38 (099)-999-9999" value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
                <?php if (!empty($errors['phone'])) : ?>
                    <div class="text-danger small"><?= $errors['phone'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <?php foreach ($allowedStatuses as $option) : ?>
                        <option value="<?= $option ?>" <?= ($old['status'] ?? '') === $option ? 'selected' : '' ?>>
                            <?= ucfirst($option) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['status'])) : ?>
                    <div class="text-danger small"><?= $errors['status'] ?></div>
                <?php endif; ?>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/leads" class="btn btn-secondary btn-sm">Cancel</a>
                <button type="submit" class="btn btn-primary btn-sm"><?= $isEditing ? 'Save' : 'Add Lead' ?></button>
            </div>
        </form>
    </div>
</div>