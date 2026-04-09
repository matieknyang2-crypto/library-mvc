<?php
// app/views/categories/index.php
?>
<h1>Categories</h1>
<a href="/library_mvc/public/index.php?url=category/create" class="btn btn-success mb-3">Add New Category</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?= $cat['id'] ?></td>
            <td><?= htmlspecialchars($cat['name']) ?></td>
            <td>
                <a href="/library_mvc/public/index.php?url=category/edit/<?= $cat['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="/library_mvc/public/index.php?url=category/delete/<?= $cat['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? This will fail if books are assigned.')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>