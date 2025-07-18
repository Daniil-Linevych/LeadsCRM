<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Lead Details</h2>
        <a href="/leads" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Leads
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="card-title mb-0 fw-bold">
                <i class="bi bi-person-badge me-2"></i><?= htmlspecialchars($lead['name']) ?>
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 text-muted">
                    <i class="bi bi-hash me-2"></i><strong>ID:</strong>
                </div>
                <div class="col-md-8">
                    <span class="badge bg-light text-dark"><?= htmlspecialchars($lead['id']) ?></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">
                    <i class="bi bi-envelope me-2"></i><strong>Email:</strong>
                </div>
                <div class="col-md-8">
                    <a href="mailto:<?= htmlspecialchars($lead['email']) ?>" class="text-decoration-none">
                        <?= htmlspecialchars($lead['email']) ?>
                    </a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">
                    <i class="bi bi-telephone me-2"></i><strong>Phone:</strong>
                </div>
                <div class="col-md-8">
                    <a href="tel:<?= htmlspecialchars($lead['phone']) ?>" class="text-decoration-none">
                        <?= htmlspecialchars($lead['phone']) ?>
                    </a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">
                    <i class="bi bi-circle-fill me-2"></i><strong>Status:</strong>
                </div>
                <div class="col-md-8">
                    <?php
                    $statusClass = match (strtolower($lead['status'])) {
                        'new' => 'bg-info',
                        'contacted' => 'bg-primary',
                        'interested' => 'bg-success',
                        'wrong number' => 'bg-danger',
                        'wrong email' => 'bg-danger',
                        default => 'bg-secondary'
                    };
                    ?>
                    <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($lead['status']) ?></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-muted">
                    <i class="bi bi-calendar-plus me-2"></i><strong>Date Created:</strong>
                </div>
                <div class="col-md-8">
                    <?= date('M j, Y', strtotime(htmlspecialchars($lead['date_created']))) ?>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4 text-muted">
                    <i class="bi bi-calendar-check me-2"></i><strong>Date Updated:</strong>
                </div>
                <div class="col-md-8">
                    <?= date('M j, Y', strtotime(htmlspecialchars($lead['date_updated']))) ?>
                </div>
            </div>

            <div class="d-flex justify-content-end border-top pt-3">
                <a href="/leads/<?= $lead["id"] ?>/edit" class="btn btn-warning me-2">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash me-1"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You are about to permanently delete the <strong><?= htmlspecialchars($lead['name']) ?></strong>.</p>
                <p class="text-danger"><i class="bi bi-exclamation-circle-fill me-1"></i> This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Cancel
                </button>
                <form method="POST" action="/leads/<?= $lead['id'] ?>/delete">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>