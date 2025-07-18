<h2 class="fw-bold mb-4 mt-4">Leads</h2>
<div class="d-flex justify-content-between align-items-center w-100 mb-3">
    <a href="/leads/create" class="btn btn-primary"><i class="bi bi-person-plus me-2"></i>Add new</a>
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
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Date Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads as $lead) : ?>
                    <tr onclick="window.location='/leads/<?= $lead['id'] ?>'" style="cursor: pointer;" class="table-hover align-middle">
                        <td><?= htmlspecialchars($lead["id"]) ?></td>
                        <td><?= htmlspecialchars($lead["name"]) ?></td>
                        <td><?= htmlspecialchars($lead["email"]) ?></td>
                        <td><?= htmlspecialchars($lead["phone"]) ?></td>
                        <td><?php
                            $statusClass = match (strtolower($lead['status'])) {
                                'new' => 'bg-info',
                                'contacted' => 'bg-primary',
                                'interested' => 'bg-success',
                                'wrong number' => 'bg-danger',
                                'wrong email' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                            ?>
                            <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($lead['status']) ?>
                        </td>
                        <td><?= htmlspecialchars($lead["date_created"]) ?></td>
                        <td><?= htmlspecialchars($lead["date_updated"]) ?></td>

                    </tr>
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