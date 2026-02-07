<div class="container py-5">
    <h2 class="mb-3 text-center">"Did You Feel It?"</h2>
    <p class="text-center mb-4" style="font-size:0.9rem;color:#9ca3af;">
        Share what you felt during the earthquake. These reports help others understand how strong it was in different areas.
    </p>

    <div class="row g-4">
        <!-- Form -->
        <div class="col-lg-5">
            <div class="card-custom">
                <h4 class="mb-3">Submit Your Experience</h4>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success py-2">
                        Thank you! Your report has been recorded.
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0" style="padding-left: 18px;">
                            <?php foreach ($errors as $e): ?>
                                <li><?= htmlspecialchars($e) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">District *</label>
                        <input type="text" name="district" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location description (area, street)</label>
                        <input type="text" name="location_description" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">How strong did it feel? (1–5)</label>
                        <select name="intensity" class="form-select">
                            <option value="1">1 – Very weak</option>
                            <option value="2">2 – Weak</option>
                            <option value="3" selected>3 – Moderate</option>
                            <option value="4">4 – Strong</option>
                            <option value="5">5 – Very strong</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Building type</label>
                        <input type="text" name="building_type" class="form-control"
                               placeholder="e.g. old apartment, office, school">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Comments</label>
                        <textarea name="comments" rows="3" class="form-control"
                                  placeholder="Cracks on wall, things fell down, people panicked, etc."></textarea>
                    </div>

                    <button class="btn btn-warning w-100">Submit Report</button>

                    <p class="mt-2 mb-0" style="font-size:0.8rem;color:#9ca3af;">
                        You can submit anonymously. If logged in, your name may be shown with the report.
                    </p>
                </form>
            </div>
        </div>

        <!-- Recent reports -->
        <div class="col-lg-7">
            <div class="card-custom">
                <h4 class="mb-3">Recent Reports</h4>

                <?php if (empty($reports)): ?>
                    <p>No reports yet.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-dark align-middle">
                            <thead>
                            <tr>
                                <th>District</th>
                                <th>Intensity</th>
                                <th>Building</th>
                                <th>Details</th>
                                <th>By</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($reports as $r): ?>
                                <tr>
                                    <td><?= htmlspecialchars($r['district']) ?></td>
                                    <td><?= (int)$r['intensity'] ?></td>
                                    <td><?= htmlspecialchars($r['building_type']) ?></td>
                                    <td style="max-width:250px;">
                                        <?php
                                        $text = trim(($r['location_description'] ?? '') . ' ' . ($r['comments'] ?? ''));
                                        echo nl2br(htmlspecialchars($text));
                                        ?>
                                    </td>
                                    <td><?= htmlspecialchars($r['reporter_name'] ?? 'Anonymous') ?></td>
                                    <td style="font-size:0.8rem;">
                                        <?= htmlspecialchars($r['created_at']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
