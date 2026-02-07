<div class="container py-5">
    <h2 class="mb-4 text-center">Unsafe Building Reports</h2>

    <a href="<?= BASE_URL ?>/index.php?controller=report&action=create"
       class="btn btn-warning mb-4">Report New Building</a>

    <?php foreach ($reports as $r): ?>
        <div class="card-custom mb-3">
            <h4><?= htmlspecialchars($r['building_name']) ?></h4>
            <p><strong>Address:</strong> <?= htmlspecialchars($r['address']) ?></p>
            <p><strong>District:</strong> <?= htmlspecialchars($r['district']) ?></p>
            <p><strong>Severity:</strong> <?= htmlspecialchars($r['severity']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($r['status']) ?></p>
            <p><strong>Reported By:</strong> <?= htmlspecialchars($r['reporter'] ?? 'Unknown') ?></p>

            <?php if ($r["photo_path"]): ?>
                <img src="<?= BASE_URL . '/' . $r["photo_path"] ?>"
                     style="max-width:200px; border-radius:8px;">
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
