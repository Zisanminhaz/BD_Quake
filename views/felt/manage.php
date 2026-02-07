<div class="container py-5">
    <h2 class="mb-4 text-center">Admin – Manage "Did You Feel It?" Reports</h2>

    <?php if (empty($reports)): ?>
        <p>No reports yet.</p>
    <?php else: ?>
        <div class="table-responsive card-custom">
            <table class="table table-sm table-dark align-middle mb-0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>District</th>
                    <th>Intensity</th>
                    <th>Building</th>
                    <th>Details</th>
                    <th>By</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reports as $r): ?>
                    <tr>
                        <td><?= (int)$r['id'] ?></td>
                        <td><?= htmlspecialchars($r['district']) ?></td>
                        <td><?= (int)$r['intensity'] ?></td>
                        <td><?= htmlspecialchars($r['building_type']) ?></td>
                        <td style="max-width:260px;">
                            <?php
                            $text = trim(($r['location_description'] ?? '') . ' ' . ($r['comments'] ?? ''));
                            echo nl2br(htmlspecialchars($text));
                            ?>
                        </td>
                        <td><?= htmlspecialchars($r['reporter_name'] ?? 'Anonymous') ?></td>
                        <td style="font-size:0.8rem;">
                            <?= htmlspecialchars($r['created_at']) ?>
                        </td>
                        <td>
                            <form method="post"
                                  onsubmit="return confirm('Delete this report?');">
                                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
