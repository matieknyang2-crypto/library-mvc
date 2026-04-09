<?php
// app/views/home/welcome.php
?>
<div style="text-align: center; padding: 4rem 0;">
    <div style="font-size: 3rem; margin-bottom: 1rem;">📚</div>
    <h1 class="dashboard-title" style="font-size: 2.5rem;">Welcome to Library MVC</h1>
    <p class="dashboard-subtitle" style="font-size: 1.1rem;">Discover thousands of books at your fingertips</p>
    
    <div style="margin: 3rem 0; display: flex; gap: 1rem; justify-content: center;">
        <a href="/library_mvc/public/index.php?url=book/index" class="btn btn-primary btn-lg">
            <span style="font-size: 1.2rem; margin-right: 0.5rem;">🔍</span>
            Browse Books
        </a>
        <a href="/library_mvc/public/index.php?url=auth/login" class="btn btn-success btn-lg">
            <span style="font-size: 1.2rem; margin-right: 0.5rem;">🔐</span>
            Sign In
        </a>
    </div>
    
    <div class="row g-4" style="margin-top: 4rem;">
        <div class="col-md-4">
            <div class="section-card">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">📖</div>
                <h3>Vast Collection</h3>
                <p>Browse our extensive collection of books across various categories.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="section-card">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">👥</div>
                <h3>Easy Access</h3>
                <p>Create an account to issue books and track your reading activity.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="section-card">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">⏰</div>
                <h3>Smart Tracking</h3>
                <p>Keep track of due dates and get notifications for overdue books.</p>
            </div>
        </div>
    </div>
</div>
