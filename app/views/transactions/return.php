<h1>Return Book</h1>
<?php if (empty($issued)): ?>
    <div class="alert alert-info">No books currently issued.</div>
<?php else: ?>
    <table class="table table-bordered" aria-label="Issued books table for returns">
        <thead>
            <tr>
                <th>Student</th>
                <th>Book</th>
                <th>Issue Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($issued as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['user_name']) ?></td>
                <td><?= htmlspecialchars($row['book_title']) ?> by <?= htmlspecialchars($row['author']) ?></td>
                <td><?= $row['issue_date'] ?></td>
                <td><?= $row['due_date'] ?></td>
                <td>
                    <?php if ($row['due_date'] < date('Y-m-d')): ?>
                        <span class="badge bg-danger">Overdue</span>
                    <?php else: ?>
                        <span class="badge bg-success">Issued</span>
                    <?php endif; ?>
                </td>
                <td>
                    <form method="POST" action="/library_mvc/public/index.php?url=transaction/return" style="display:inline;" aria-label="Return form for <?= htmlspecialchars($row['book_title']) ?>">
                        <input type="hidden" name="transaction_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Mark as returned?')" aria-label="Return <?= htmlspecialchars($row['book_title']) ?>">Return</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>