<div class="container py-5">
    <div class="col-md-8 mx-auto card-custom">
        <h2 class="mb-3">Create Forum Post</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post"
              action="<?= BASE_URL ?>/index.php?controller=forum&action=create">

            <div class="mb-3">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control"
                       value="<?= htmlspecialchars($old['title'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                    <option value="question" <?= ($old['category'] ?? '') === 'question' ? 'selected' : '' ?>>
                        Question
                    </option>
                    <option value="tip" <?= ($old['category'] ?? '') === 'tip' ? 'selected' : '' ?>>
                        Safety Tip
                    </option>
                    <option value="experience" <?= ($old['category'] ?? '') === 'experience' ? 'selected' : '' ?>>
                        Experience
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Message *</label>
                <textarea name="body" rows="5" class="form-control" required><?= htmlspecialchars($old['body'] ?? '') ?></textarea>
            </div>

            <button class="btn btn-warning w-100">Post</button>
        </form>
    </div>
</div>
