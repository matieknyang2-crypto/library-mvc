<?php
// app/views/categories/create.php
?>
<div class="row justify-content-center">
    <div class="col-md-4">
        <h2>Add New Category</h2>
        <form method="POST" action="/library_mvc/public/index.php?url=category/create">
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/library_mvc/public/index.php?url=category/index" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>