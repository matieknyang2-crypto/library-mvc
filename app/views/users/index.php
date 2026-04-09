<div class="users-header">
    <h1 class="page-title">👥 User Management</h1>
    <p class="page-subtitle">Manage all users in the system</p>
</div>

<div class="row">
    <div class="col-12">
        <div class="section-card">
            <div class="section-title">📋 All Users</div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">No users found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2">
                                                <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                            </div>
                                            <?= htmlspecialchars($user['name']) ?>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $user['role'] === 'admin' ? 'primary' : 'success' ?>">
                                            <?= ucfirst($user['role']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary btn-sm" title="View Details">
                                                👁️
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                ✏️
                                            </button>
                                            <?php if ($user['role'] !== 'admin'): ?>
                                                <button class="btn btn-outline-danger btn-sm" title="Delete">
                                                    🗑️
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.875rem;
}

.table th {
    border-top: none;
    font-weight: 600;
}

.table td {
    vertical-align: middle;
}
</style>