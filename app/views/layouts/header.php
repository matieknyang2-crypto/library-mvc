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
    <div id="globalLoader" class="global-loader" aria-hidden="true">
        <div class="spinner-border text-light" role="status" aria-label="Loading"></div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/library_mvc/public/index.php?url=home/index">📚 Library MVC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation" aria-controls="navbarNav" aria-expanded="false">
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
        <?php
            $currentUrl = $_GET['url'] ?? 'home/index';
            $urlParts = array_values(array_filter(explode('/', trim($currentUrl, '/'))));
            $labelMap = [
                'home' => 'Home',
                'dashboard' => 'Dashboard',
                'book' => 'Books',
                'category' => 'Categories',
                'transaction' => 'Transactions',
                'report' => 'Reports',
                'user' => 'Users',
                'auth' => 'Authentication',
                'index' => 'Overview',
                'create' => 'Create',
                'edit' => 'Edit',
                'show' => 'Details',
                'issue' => 'Issue',
                'return' => 'Return',
                'overdue' => 'Overdue',
                'export' => 'Export',
                'login' => 'Login',
                'register' => 'Register',
                'forgot' => 'Forgot Password',
                'logout' => 'Logout'
            ];

            $renderParts = [];
            foreach ($urlParts as $partIndex => $part) {
                // Avoid duplicate "Home" in breadcrumb when URL starts with home/index.
                if ($partIndex === 0 && $part === 'home') {
                    continue;
                }

                $renderParts[] = [
                    'part' => $part,
                    'path' => implode('/', array_slice($urlParts, 0, $partIndex + 1))
                ];
            }
        ?>
        <nav class="app-breadcrumb" aria-label="Breadcrumb">
            <ol class="breadcrumb mb-3">
                <li class="breadcrumb-item"><a href="/library_mvc/public/index.php?url=home/index">Home</a></li>
                <?php foreach ($renderParts as $index => $node):
                    $label = $labelMap[$node['part']] ?? ucfirst($node['part']);
                    $isLast = $index === (count($renderParts) - 1);
                ?>
                    <?php if ($isLast): ?>
                        <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($label) ?></li>
                    <?php else: ?>
                        <li class="breadcrumb-item"><a href="/library_mvc/public/index.php?url=<?= htmlspecialchars($node['path']) ?>"><?= htmlspecialchars($label) ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </nav>
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['flash']['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>