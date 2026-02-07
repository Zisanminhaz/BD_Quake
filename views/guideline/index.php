<div class="container py-5">
    <h2 class="mb-4 text-center">Earthquake Safety Guidelines (Bangladesh)</h2>

    <p class="text-center mb-4" style="color:#9ca3af;">
        Practical steps for before, during, and after an earthquake based on Bangladesh conditions.
    </p>

    <?php foreach (['before'=>'Before Earthquake','during'=>'During Earthquake','after'=>'After Earthquake'] as $catKey => $catName): ?>
        <div class="card-custom mb-4">
            <h4><?= $catName ?></h4>
            <ul>
                <?php foreach ($guidelines[$catKey] as $g): ?>
                    <li>
                        <strong><?= htmlspecialchars($g['title']) ?></strong><br>
                        <?= htmlspecialchars($g['content']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>
