<?php
// app/views/books/show.php
?>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="section-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h2 style="margin-bottom: 0;">📖 Book Details</h2>
                <a href="/library_mvc/public/index.php?url=book/index" class="btn btn-secondary">← Back to List</a>
            </div>
            
            <table class="table">
                <tr>
                    <th style="width: 30%;">Property</th>
                    <td><strong><?= htmlspecialchars($book['title']) ?></strong></td>
                </tr>
                <tr>
                    <th>Author</th>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                </tr>
                <tr>
                    <th>ISBN</th>
                    <td><code><?= htmlspecialchars($book['isbn']) ?></code></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td><span class="badge bg-info"><?= htmlspecialchars($book['category_name'] ?? 'Uncategorized') ?></span></td>
                </tr>
                <tr>
                    <th>Total Copies</th>
                    <td><strong><?= $book['total_copies'] ?></strong></td>
                </tr>
                <tr>
                    <th>Available Copies</th>
                    <td>
                        <?php if ($book['available_copies'] > 0): ?>
                            <span class="badge bg-success" style="font-size: 1rem; padding: 0.5rem 1rem;">✓ <?= $book['available_copies'] ?> Available</span>
                        <?php else: ?>
                            <span class="badge bg-danger" style="font-size: 1rem; padding: 0.5rem 1rem;">✗ Out of Stock</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
                        <a href="/library_mvc/public/index.php?url=book/edit/<?= $book['id'] ?>" class="btn btn-warning">✏️ Edit Book</a>
                        <a href="/library_mvc/public/index.php?url=book/delete/<?= $book['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">🗑️ Delete Book</a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info" style="margin-top: 2rem;">
                    <strong>Want to issue this book?</strong> <a href="/library_mvc/public/index.php?url=auth/login" class="alert-link">Login to your account</a> to request books or <a href="/library_mvc/public/index.php?url=auth/register" class="alert-link">sign up</a> for a new account.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>