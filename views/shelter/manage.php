<div class="container py-5">
    <h2 class="mb-4 text-center">Admin – Manage Shelters</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Create new shelter -->
    <div class="card-custom mb-4">
        <h4 class="mb-3">Add New Shelter</h4>
        <form method="post" class="row g-3">
            <input type="hidden" name="action" value="create">

            <div class="col-md-4">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Type</label>
                <input type="text" name="type" class="form-control" placeholder="school, hospital, field">
            </div>

            <div class="col-md-5">
                <label class="form-label">Address *</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">District *</label>
                <input type="text" name="district" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Latitude</label>
                <input type="text" name="latitude" class="form-control">
            </div>

            <div class="col-md-2">
                <label class="form-label">Longitude</label>
                <input type="text" name="longitude" class="form-control">
            </div>

            <div class="col-md-2 align-self-end">
                <button class="btn btn-warning w-100">Add</button>
            </div>
        </form>
    </div>

    <!-- Existing shelters -->
    <h4 class="mb-3">Existing Shelters</h4>

    <?php if (empty($shelters)): ?>
        <p>No shelters added yet.</p>
    <?php else: ?>
        <?php foreach ($shelters as $s): ?>
            <div class="card-custom mb-3">
                <form method="post" class="row g-2 align-items-end">
                    <input type="hidden" name="id" value="<?= $s['id'] ?>">

                    <div class="col-md-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control"
                               value="<?= htmlspecialchars($s['name']) ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Type</label>
                        <input type="text" name="type" class="form-control"
                               value="<?= htmlspecialchars($s['type']) ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control"
                               value="<?= htmlspecialchars($s['address']) ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">District</label>
                        <input type="text" name="district" class="form-control"
                               value="<?= htmlspecialchars($s['district']) ?>">
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">Lat</label>
                        <input type="text" name="latitude" class="form-control"
                               value="<?= htmlspecialchars($s['latitude']) ?>">
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">Lng</label>
                        <input type="text" name="longitude" class="form-control"
                               value="<?= htmlspecialchars($s['longitude']) ?>">
                    </div>

                    <div class="col-md-12 mt-2">
                        <button type="submit" name="action" value="update"
                                class="btn btn-sm btn-primary me-2">
                            Update
                        </button>
                        <button type="submit" name="action" value="delete"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this shelter?');">
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
