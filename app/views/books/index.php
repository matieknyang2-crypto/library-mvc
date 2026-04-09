<?php
// app/views/books/index.php
?>
<h1>📚 Books Catalog</h1>
<?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?>
    <a href="/library_mvc/public/index.php?url=book/create" class="btn btn-success mb-3">➕ Add New Book</a>
<?php endif; ?>

<!-- Search and Filter -->
<form method="GET" action="/library_mvc/public/index.php" class="row g-3 mb-4">
    <input type="hidden" name="url" value="book/index">
    <div class="col-md-5">
        <input type="text" name="search" class="form-control" placeholder="Search by title, author, ISBN" value="<?= htmlspecialchars($search) ?>">
    </div>
    <div class="col-md-4">
        <select name="category_id" class="form-select">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $selected_category == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary w-100">🔍 Filter</button>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Category</th>
            <th>Total</th>
            <th>Available</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $book): ?>
        <tr>
            <td><?= $book['id'] ?></td>
            <td><strong><?= htmlspecialchars($book['title']) ?></strong></td>
            <td><?= htmlspecialchars($book['author']) ?></td>
            <td><?= htmlspecialchars($book['isbn']) ?></td>
            <td><?= htmlspecialchars($book['category_name'] ?? 'N/A') ?></td>
            <td><?= $book['total_copies'] ?></td>
            <td>
                <?php if ($book['available_copies'] > 0): ?>
                    <span class="badge bg-success"><?= $book['available_copies'] ?></span>
                <?php else: ?>
                    <span class="badge bg-danger">Out of Stock</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="/library_mvc/public/index.php?url=book/show/<?= $book['id'] ?>" class="btn btn-sm btn-info">👁️ View</a>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'): ?>
                    <a href="/library_mvc/public/index.php?url=book/edit/<?= $book['id'] ?>" class="btn btn-sm btn-warning">✏️ Edit</a>
                    <a href="/library_mvc/public/index.php?url=book/delete/<?= $book['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>