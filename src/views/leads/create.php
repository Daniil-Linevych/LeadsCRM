<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="bi <?= $isEditing ? 'bi-pencil-square' : 'bi-person-plus' ?> me-2"></i>
            <?= $isEditing ? "Edit Lead" : 'Add New Lead' ?>
        </h2>
        <a href="/leads" class="btn btn-outline-secondary">
            <i class="bi bi-x-lg me-1"></i> Cancel
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-<?= $isEditing ? 'warning' : 'primary' ?> text-white py-3">
            <h5 class="card-title mb-0 fw-bold">
                <i class="bi bi-info-circle me-2"></i>
                <?= $isEditing ? 'Update Lead Information' : 'Enter New Lead Details' ?>
            </h5>
        </div>
        <div class="card-body">
            <form id="createLeadForm" method="POST" action="<?= $isEditing ? "/leads/{$old['id']}/edit" : '/leads' ?>">

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">
                        <i class="bi bi-person me-1"></i> Full Name
                    </label>
                    <input type="text" class="form-control <?= !empty($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" placeholder="John Smith" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
                    <?php if (!empty($errors['name'])) : ?>
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i><?= $errors['name'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">
                        <i class="bi bi-envelope me-1"></i> Email Address
                    </label>
                    <input type="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="john.smith@example.com" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                    <?php if (!empty($errors['email'])) : ?>
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i><?= $errors['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">
                        <i class="bi bi-telephone me-1"></i> Phone Number
                    </label>
                    <input type="tel" class="form-control <?= !empty($errors['phone']) ? 'is-invalid' : '' ?>" id="phone" name="phone" placeholder="+1 (555) 123-4567" value="<?= htmlspecialchars($old['phone'] ?? '') ?>">
                    <?php if (!empty($errors['phone'])) : ?>
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i><?= $errors['phone'] ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-text">Format: +[country code] ([area code]) [number]</div>
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label fw-bold">
                        <i class="bi bi-activity me-1"></i> Status
                    </label>
                    <select name="status" class="form-select <?= !empty($errors['status']) ? 'is-invalid' : '' ?>" required>
                        <?php foreach ($allowedStatuses as $option) : ?>
                            <option value="<?= $option ?>" <?= ($old['status'] ?? '') === $option ? 'selected' : '' ?>>
                                <?= ucfirst($option) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['status'])) : ?>
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i><?= $errors['status'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-end border-top pt-3">
                    <button type="submit" class="btn btn-<?= $isEditing ? 'warning' : 'primary' ?>">
                        <i class="bi <?= $isEditing ? 'bi-check-circle' : 'bi-plus-circle' ?> me-1"></i>
                        <?= $isEditing ? 'Update Lead' : 'Add Lead' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>