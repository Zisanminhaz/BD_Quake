<div class="container py-5">
    <h2 class="mb-4 text-center">Admin – Manage Building Reports</h2>

    <?php foreach ($reports as $r): ?>
        <div class="card-custom mb-4">

            <h4><?= htmlspecialchars($r['building_name']) ?></h4>
            <p><strong>District:</strong> <?= htmlspecialchars($r['district']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($r['status']) ?></p>

            <?php if ($r['photo_path']): ?>
                <img src="<?= BASE_URL . '/' . $r['photo_path'] ?>" style="max-width:200px;">
            <?php endif; ?>

            <!-- STATUS UPDATE FORM -->
            <form method="POST" class="mt-3">
                <input type="hidden" name="id" value="<?= $r['id'] ?>">

                <select name="status" class="form-select mb-2">
                    <option value="pending">Pending</option>
                    <option value="verified">Verified</option>
                    <option value="critical">Critical</option>
                    <option value="solved">Solved</option>
                </select>

                <button name="action" value="status" class="btn btn-primary btn-sm">Update Status</button>
                <button name="action" value="delete" class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this report?')">
                    Delete
                </button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
