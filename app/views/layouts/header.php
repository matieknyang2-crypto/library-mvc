<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/library_mvc/public/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/library_mvc/public/index.php?url=home/index">📚 Library MVC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Books link available to everyone -->
                    <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=book/index">📚 Books</a></li>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=dashboard/index">Dashboard</a></li>
                        <?php if ($_SESSION['user_role'] === 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=user/index">Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=category/index">Categories</a></li>
                            <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=transaction/issue">Issue Book</a></li>
                            <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=transaction/return">Return Book</a></li>
                            <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=transaction/overdue">Overdue</a></li>
                            <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=report/export">Reports</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=auth/logout">Logout (<?= htmlspecialchars($_SESSION['user_name']) ?>)</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/library_mvc/public/index.php?url=auth/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['flash']['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>