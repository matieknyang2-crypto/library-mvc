<?php
// app/views/books/create.php
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Add New Book</h2>
        <form method="POST" action="/library_mvc/public/index.php?url=book/create">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="total_copies" class="form-label">Total Copies</label>
                <input type="number" class="form-control" id="total_copies" name="total_copies" min="1" value="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Book</button>
            <a href="/library_mvc/public/index.php?url=book/index" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>