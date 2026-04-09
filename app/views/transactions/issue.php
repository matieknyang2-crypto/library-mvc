<h1>Issue Book</h1>
<form method="POST" action="/library_mvc/public/index.php?url=transaction/issue" aria-label="Issue book form">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="user_id" class="form-label">Select Student</label>
                <select class="form-select" id="user_id" name="user_id" required aria-label="Select student">
                    <option value="">Choose...</option>
                    <?php foreach ($students as $student): ?>
                        <option value="<?= $student['id'] ?>"><?= htmlspecialchars($student['name']) ?> (<?= htmlspecialchars($student['email']) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="book_id" class="form-label">Select Book (with available copies)</label>
                <select class="form-select" id="book_id" name="book_id" required aria-label="Select book">
                    <option value="">Choose...</option>
                    <?php foreach ($books as $book): ?>
                        <?php if ($book['available_copies'] > 0): ?>
                            <option value="<?= $book['id'] ?>"><?= htmlspecialchars($book['title']) ?> by <?= htmlspecialchars($book['author']) ?> (Avail: <?= $book['available_copies'] ?>)</option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" aria-label="Issue selected book">Issue Book</button>
    <a href="/library_mvc/public/index.php?url=dashboard/index" class="btn btn-secondary" aria-label="Cancel and return to dashboard">Cancel</a>
</form>