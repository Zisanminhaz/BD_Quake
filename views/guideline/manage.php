<div class="container py-5">
    <h2 class="mb-4 text-center">Manage Guidelines</h2>

    <!-- Add new -->
    <div class="card-custom mb-4">
        <h4>Add New Guideline</h4>
        <form method="post">
            <input type="hidden" name="action" value="create">

            <div class="mb-2">
                <label>Title *</label>
                <input name="title" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Content *</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>

            <div class="mb-2">
                <label>Category</label>
                <select name="category" class="form-select">
                    <option value="before">Before</option>
                    <option value="during">During</option>
                    <option value="after">After</option>
                </select>
            </div>

            <button class="btn btn-warning mt-2">Add</button>
        </form>
    </div>

    <!-- List existing -->
    <?php foreach ($guidelines as $g): ?>
        <div class="card-custom mb-3">
            <form method="post">
                <input type="hidden" name="id" value="<?= $g['id'] ?>">

                <div class="mb-2">
                    <label>Title</label>
                    <input name="title" class="form-control" value="<?= htmlspecialchars($g['title']) ?>">
                </div>

                <div class="mb-2">
                    <label>Content</label>
                    <textarea name="content" class="form-control"><?= htmlspecialchars($g['content']) ?></textarea>
                </div>

                <div class="mb-2">
                    <label>Category</label>
                    <select name="category" class="form-select">
                        <option value="before" <?= $g['category']=='before'?'selected':'' ?>>Before</option>
                        <option value="during" <?= $g['category']=='during'?'selected':'' ?>>During</option>
                        <option value="after" <?= $g['category']=='after'?'selected':'' ?>>After</option>
                    </select>
                </div>

                <button name="action" value="update" class="btn btn-primary btn-sm">Update</button>
                <button name="action" value="delete" class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete?')">
                    Delete
                </button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
