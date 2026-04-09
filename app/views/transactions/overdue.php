<h1>Overdue Books</h1>
<?php if (empty($overdue)): ?>
    <div class="alert alert-success">No overdue books. Good job!</div>
<?php else: ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Email</th>
                <th>Book</th>
                <th>Author</th>
                <th>Issue Date</th>
                <th>Due Date</th>
                <th>Days Overdue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($overdue as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['user_name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['book_title']) ?></td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= $row['issue_date'] ?></td>
                <td><?= $row['due_date'] ?></td>
                <td>
                    <?php
                        $due = new DateTime($row['due_date']);
                        $today = new DateTime();
                        $interval = $today->diff($due);
                        echo $interval->days . ' days';
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/library_mvc/public/index.php?url=report/exportOverdue" class="btn btn-primary">Export as CSV</a>
<?php endif; ?>