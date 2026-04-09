<?php
// app/views/books/edit.php
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Edit Book</h2>
        <form method="POST" action="/library_mvc/public/index.php?url=book/edit/<?= $book['id'] ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $book['category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="total_copies" class="form-label">Total Copies</label>
                <input type="number" class="form-control" id="total_copies" name="total_copies" min="1" value="<?= $book['total_copies'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="available_copies" class="form-label">Available Copies</label>
                <input type="number" class="form-control" id="available_copies" name="available_copies" min="0" max="<?= $book['total_copies'] ?>" value="<?= $book['available_copies'] ?>" required>
                <small class="form-text text-muted">Should not exceed total copies.</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
            <a href="/library_mvc/public/index.php?url=book/index" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>