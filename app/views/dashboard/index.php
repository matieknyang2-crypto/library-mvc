<div class="dashboard-header">
    <h1 class="dashboard-title">📚 Admin Dashboard</h1>
    <p class="dashboard-subtitle">Welcome back! Here's your library overview.</p>
</div>

<!-- Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card primary">
            <div class="stat-icon">📖</div>
            <div class="stat-label">Total Books</div>
            <div class="stat-number"><?= $total_books ?></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card success">
            <div class="stat-icon">📂</div>
            <div class="stat-label">Categories</div>
            <div class="stat-number"><?= $total_categories ?></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card warning position-relative">
            <div class="stat-icon">👥</div>
            <div class="stat-label">Students</div>
            <div class="stat-number"><?= $total_students ?></div>
            <a href="/library_mvc/public/index.php?url=user/index" class="stretched-link" aria-label="View students"></a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card info">
            <div class="stat-icon">📤</div>
            <div class="stat-label">Issued Today</div>
            <div class="stat-number"><?= $issued_today ?></div>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row g-4">
    <!-- Overdue Section -->
    <div class="col-lg-6">
        <div class="section-card">
            <div class="section-title">⚠️ Overdue Books</div>
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div style="font-size: 2rem; font-weight: 700; color: #ef4444;"><?= $overdue_count ?></div>
                    <p class="text-muted mb-0" style="font-size: 0.875rem;">Books pending return</p>
                </div>
                <a href="/library_mvc/public/index.php?url=transaction/overdue" class="btn btn-danger">View Details</a>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="col-lg-6">
        <div class="section-card">
            <div class="section-title">⚡ Quick Actions</div>
            <div class="quick-actions">
                <a href="/library_mvc/public/index.php?url=book/create" class="btn btn-primary quick-action-btn">
                    <span style="font-size: 1.5rem;">➕</span>
                    <span>Add Book</span>
                </a>
                <a href="/library_mvc/public/index.php?url=category/create" class="btn btn-success quick-action-btn">
                    <span style="font-size: 1.5rem;">🏷️</span>
                    <span>Add Category</span>
                </a>
                <a href="/library_mvc/public/index.php?url=transaction/issue" class="btn btn-warning quick-action-btn">
                    <span style="font-size: 1.5rem;">📤</span>
                    <span>Issue Book</span>
                </a>
                <a href="/library_mvc/public/index.php?url=report/export" class="btn btn-info quick-action-btn">
                    <span style="font-size: 1.5rem;">📊</span>
                    <span>Reports</span>
                </a>
            </div>
        </div>
    </div>
</div>