<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">My Forum Posts</h2>
        <a href="<?= BASE_URL ?>/index.php?controller=forum&action=create"
           class="btn btn-warning btn-sm">
            New Post
        </a>
    </div>

    <?php if (empty($posts)): ?>
        <p>You haven't posted anything yet.</p>
    <?php else: ?>
        <?php foreach ($posts as $p): ?>
            <div class="card-custom mb-3">
                <div class="d-flex justify-content-between">
                    <h4 class="mb-1"><?= htmlspecialchars($p['title']) ?></h4>
                    <span class="badge bg-secondary">
                        <?= htmlspecialchars(ucfirst($p['category'])) ?>
                    </span>
                </div>

                <p class="mb-2" style="white-space:pre-wrap;">
                    <?= nl2br(htmlspecialchars($p['body'])) ?>
                </p>

                <div class="d-flex justify-content-between align-items-center"
                     style="font-size:0.85rem;color:#9ca3af;">
                    <span>Created: <?= htmlspecialchars($p['created_at']) ?></span>
                    <div>
                        <a href="<?= BASE_URL ?>/index.php?controller=forum&action=edit&id=<?= $p['id'] ?>"
                           class="btn btn-sm btn-outline-light me-1">
                            Edit
                        </a>
                        <form method="post" style="display:inline;"
                              action="<?= BASE_URL ?>/index.php?controller=forum&action=delete"
                              onsubmit="return confirm('Delete this post?');">
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
