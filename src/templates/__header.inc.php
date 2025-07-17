<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">LeadsCRM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#crmNavbar" aria-controls="crmNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="crmNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="leads.php">Leads</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php if (\Php\LeadsCrmApp\Models\User::isAuthorised()) { ?>
                        <span class="me-3 text-white">Hello, <?= Php\LeadsCrmApp\Models\User::authorisedUserName() ?></span>
                        <a href="/logout" class="btn btn-light btn-sm">Log out</a>
                    <?php } else { ?>
                        <a href="/login" class="btn btn-light btn-sm me-2">Log in</a>
                        <a href="/register" class="btn btn-light btn-sm">Sign up</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
</header>