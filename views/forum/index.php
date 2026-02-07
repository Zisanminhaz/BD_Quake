<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Panic Help Forum</h2>

        <?php if (!empty($_SESSION['user_id'])): ?>
            <div>
                <a href="<?= BASE_URL ?>/index.php?controller=forum&action=create"
                   class="btn btn-warning btn-sm me-2">
                    New Post
                </a>
                <a href="<?= BASE_URL ?>/index.php?controller=forum&action=myPosts"
                   class="btn btn-outline-light btn-sm">
                    My Posts
                </a>
            </div>
        <?php endif; ?>
    </div>

    <p class="mb-4" style="font-size:0.9rem;color:#9ca3af;">
        Ask questions, share tips, and support others during earthquake panic situations.
    </p>

    <?php if (empty($posts)): ?>
        <p>No posts yet. Be the first to start a discussion!</p>
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
                    <div>
                        Posted by
                        <strong><?= htmlspecialchars($p['author_name'] ?? 'Unknown') ?></strong>
                        on <?= htmlspecialchars($p['created_at']) ?>
                    </div>

                    <?php
                    $isOwner = (!empty($_SESSION['user_id']) && $p['user_id'] == $_SESSION['user_id']);
                    $isAdmin = (!empty($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin');
                    ?>
                    <?php if ($isOwner || $isAdmin): ?>
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
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
