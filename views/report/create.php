<div class="container py-5">
    <div class="col-md-7 mx-auto card-custom">

        <h2 class="mb-3">Report Unsafe Building</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label>Building Name</label>
                <input type="text" name="building_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>District</label>
                <input type="text" name="district" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Severity</label>
                <select class="form-select" name="severity">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Upload Photo (optional)</label>
                <input type="file" class="form-control" name="photo">
            </div>

            <button class="btn btn-warning w-100">Submit Report</button>
        </form>

    </div>
</div>
