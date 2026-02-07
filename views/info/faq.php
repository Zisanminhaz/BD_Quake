<div class="container py-5">
    <h2 class="mb-4 text-center">Emergency Contacts & FAQ (Bangladesh)</h2>

    <!-- Contacts -->
    <div class="card-custom mb-4">
        <h4>Emergency Contacts</h4>
        <ul class="mt-3">
            <?php foreach ($contacts as $c): ?>
                <li>
                    <strong><?= htmlspecialchars($c['name']) ?></strong><br>
                    <?= htmlspecialchars($c['phone']) ?>
                    <?php if ($c['district']): ?>
                        <span style="color:#9ca3af;">(<?= htmlspecialchars($c['district']) ?>)</span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- FAQ -->
    <div class="card-custom">
        <h4>Frequently Asked Questions</h4>

        <?php foreach ($faqs as $f): ?>
            <div class="mb-3">
                <strong><?= htmlspecialchars($f['question']) ?></strong>
                <p class="mb-1"><?= nl2br(htmlspecialchars($f['answer'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
