<h2 class="fw-bold mb-4 mt-4">Leads</h2>
<div class="d-flex justify-content-between align-items-center w-100 mb-3">
    <a href="/leads/create" class="btn btn-primary">Add new</a>
    <form method="GET" class="ms-auto">
        <div class="d-flex justify-content-end align-items-center">
            <div class="input-group me-2">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <a href="/leads" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
<?php if (empty($leads)) : ?>
    <div class="alert alert-light text-center">No leads found.</div>
<?php else : ?>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Date Updated</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads as $lead) : ?>
                    <tr>
                        <td><?= htmlspecialchars($lead["id"]) ?></td>
                        <td><?= htmlspecialchars($lead["name"]) ?></td>
                        <td><?= htmlspecialchars($lead["email"]) ?></td>
                        <td><?= htmlspecialchars($lead["phone"]) ?></td>
                        <td><?= htmlspecialchars($lead["status"]) ?></td>
                        <td><?= htmlspecialchars($lead["date_created"]) ?></td>
                        <td><?= htmlspecialchars($lead["date_updated"]) ?></td>
                        <td class="text-center">
                            <a href="/leads/<?= $lead["id"] ?>" class="btn btn-info btn-sm me-1">Show</a>
                            <a href="/leads/<?= $lead["id"] ?>/edit" class="btn btn-warning btn-sm me-1">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                Delete
                            </button>
                        </td>
                    </tr>
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
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($pager->haveToPaginate()) : ?>
            <nav>
                <ul class="pagination justify-content-center mt-4">
                    <?php for ($i = 1; $i <= $pager->getNbPages(); $i++) : ?>
                        <li class="page-item <?= $pager->getCurrentPage() === $i ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
<?php endif; ?>