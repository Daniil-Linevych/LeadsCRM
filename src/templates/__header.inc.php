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
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/leads">Leads</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <?php if (\Php\LeadsCrmApp\Models\User::isAuthorised()) { ?>
                        <div class="d-flex align-items-center me-3">
                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                <i class="bi bi-person-fill bg-dark text-white"></i>
                            </div>
                            <span class="text-white"><?= Php\LeadsCrmApp\Models\User::authorisedUserName() ?></span>
                        </div>
                        <a href="/logout" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Log out
                        </a>
                    <?php } else { ?>
                        <a href="/login" class="btn btn-outline-light btn-sm me-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Log in
                        </a>
                        <a href="/register" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-person-plus me-1"></i> Sign up
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
</header>