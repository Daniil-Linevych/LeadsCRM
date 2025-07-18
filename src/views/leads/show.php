<h2 class="fw-bold mb-4 mt-4">Lead Details</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-4 fw-bold"><?= htmlspecialchars($lead['name']) ?></h5>

        <div class="row mb-3">
            <div class="col-md-4"><strong>ID:</strong></div>
            <div class="col-md-8"><?= htmlspecialchars($lead['id']) ?></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4"><strong>Email:</strong></div>
            <div class="col-md-8"><?= htmlspecialchars($lead['email']) ?></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4"><strong>Phone:</strong></div>
            <div class="col-md-8"><?= htmlspecialchars($lead['phone']) ?></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4"><strong>Status:</strong></div>
            <div class="col-md-8"><?= htmlspecialchars($lead['status']) ?></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4"><strong>Date Created:</strong></div>
            <div class="col-md-8"><?= htmlspecialchars($lead['date_created']) ?></div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4"><strong>Date Updated:</strong></div>
            <div class="col-md-8"><?= htmlspecialchars($lead['date_updated']) ?></div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="/leads" class="btn btn-secondary btn-sm">← Back to Leads</a>
            <div>
                <a href="/leads/<?= $lead["id"] ?>/edit" class="btn btn-warning btn-sm me-1">Edit</a>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    Delete
                </button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete lead</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Once deleted, this lead's data cannot be recovered. Please confirm before proceeding.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="POST" action="/leads/<?= $lead['id'] ?>/delete">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>