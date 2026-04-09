<?php
// app/views/dashboard/student.php
?>
<div class="dashboard-header">
    <h1 class="dashboard-title">📚 My Library</h1>
    <p class="dashboard-subtitle">Track your issued books and browse the collection.</p>
</div>

<!-- Issued Books Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="section-card">
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.5rem;">
                <div class="section-title" style="margin-bottom: 0;">📤 Your Issued Books</div>
                <a href="/library_mvc/public/index.php?url=book/index" class="btn btn-outline-primary" aria-label="Browse books from student dashboard">
                    Browse Books
                </a>
            </div>
            
            <?php if (empty($issued_books)): ?>
                <div class="alert alert-info" role="alert">
                    <strong>No issued books yet!</strong> Browse our collection to find interesting reads.
                </div>
                <a href="/library_mvc/public/index.php?url=book/index" class="btn btn-primary" aria-label="Browse books when no books are issued">
                    <span style="margin-right: 0.5rem;">📚</span>Browse Available Books
                </a>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>Author</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Days Left</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($issued_books as $book): ?>
                                <?php 
                                    $due_date = strtotime($book['due_date']);
                                    $today = strtotime(date('Y-m-d'));
                                    $days_left = floor(($due_date - $today) / (60 * 60 * 24));
                                    $badge_class = $days_left < 0 ? 'badge-danger' : ($days_left < 3 ? 'badge-warning' : 'badge-success');
                                    $badge_text = $days_left < 0 ? 'Overdue' : ($days_left < 3 ? 'Due Soon' : 'On Track');
                                ?>
                                <tr>
                                    <td>
                                        <a href="/library_mvc/public/index.php?url=book/show/<?= $book['book_id'] ?>" aria-label="View details for <?= htmlspecialchars($book['book_title']) ?>">
                                            <strong><?= htmlspecialchars($book['book_title']) ?></strong>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($book['author']) ?></td>
                                    <td><?= $book['issue_date'] ?></td>
                                    <td><?= $book['due_date'] ?></td>
                                    <td>
                                        <strong class="<?php echo $days_left < 0 ? 'text-danger' : ($days_left < 3 ? 'text-warning' : 'text-success'); ?>">
                                            <?= $days_left < 0 ? abs($days_left) . ' days' : $days_left . ' days' ?>
                                        </strong>
                                    </td>
                                    <td><span class="badge <?= $badge_class ?>"><?= $badge_text ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Explore More Section -->
<div class="row">
    <div class="col-12">
        <div class="section-card">
            <div class="section-title">🔍 Explore Our Collection</div>
            <p class="text-muted mb-3">Discover more books from our extensive library collection.</p>
            <a href="/library_mvc/public/index.php?url=book/index" class="btn btn-primary btn-lg">
                <span style="font-size: 1.2rem; margin-right: 0.5rem;">📖</span>
                Browse All Books
            </a>
        </div>
    </div>
</div>
