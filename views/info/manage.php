<div class="container py-5">
    <h2 class="mb-4 text-center">Manage FAQ & Emergency Contacts</h2>

    <!-- ========================= -->
    <!--      EMERGENCY CONTACTS   -->
    <!-- ========================= -->

    <div class="card-custom mb-4">
        <h4>Add Emergency Contact</h4>
        <form method="post">
            <input type="hidden" name="type" value="contact_add">

            <div class="row g-2 mt-2">
                <div class="col-md-3">
                    <label class="form-label">Name *</label>
                    <input name="name" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Phone *</label>
                    <input name="phone" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Type (e.g. Fire, Police)</label>
                    <input name="ctype" class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="form-label">District</label>
                    <input name="district" class="form-control">
                </div>
            </div>

            <button class="btn btn-warning mt-3">Add Contact</button>
        </form>
    </div>

    <!-- Existing Contacts -->
    <div class="card-custom mb-5">
        <h4 class="mb-3">Existing Emergency Contacts</h4>

        <?php if (empty($contacts)): ?>
            <p>No contacts added yet.</p>
        <?php else: ?>
            <?php foreach ($contacts as $c): ?>
                <div class="mb-3 p-3" style="border:1px solid rgba(255,255,255,0.12); border-radius:10px;">
                    <form method="post" class="row g-2">
                        <input type="hidden" name="id" value="<?= $c['id'] ?>">

                        <input type="hidden" name="type" value="contact_update">

                        <div class="col-md-3">
                            <label class="form-label">Name</label>
                            <input name="name" class="form-control"
                                   value="<?= htmlspecialchars($c['name']) ?>">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Phone</label>
                            <input name="phone" class="form-control"
                                   value="<?= htmlspecialchars($c['phone']) ?>">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Type</label>
                            <input name="ctype" class="form-control"
                                   value="<?= htmlspecialchars($c['type']) ?>">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">District</label>
                            <input name="district" class="form-control"
                                   value="<?= htmlspecialchars($c['district']) ?>">
                        </div>

                        <div class="col-md-1 d-grid">
                            <button class="btn btn-primary" name="type" value="contact_update">
                                Save
                            </button>
                        </div>

                        <div class="col-md-12 mt-1">
                            <button class="btn btn-danger btn-sm"
                                    name="type" value="contact_delete"
                                    onclick="return confirm('Delete this contact?');">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>


    <!-- ========================= -->
    <!--           FAQ             -->
    <!-- ========================= -->

    <div class="card-custom mb-4">
        <h4>Add FAQ</h4>
        <form method="post">
            <input type="hidden" name="type" value="faq_add">

            <div class="mb-2">
                <label class="form-label">Question *</label>
                <input name="question" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Answer *</label>
                <textarea name="answer" class="form-control" rows="3" required></textarea>
            </div>

            <button class="btn btn-warning mt-2">Add FAQ</button>
        </form>
    </div>

    <!-- Existing FAQ -->
    <div class="card-custom">
        <h4 class="mb-3">Existing FAQ</h4>

        <?php if (empty($faqs)): ?>
            <p>No FAQ added yet.</p>
        <?php else: ?>
            <?php foreach ($faqs as $f): ?>
                <div class="mb-3 p-3" style="border:1px solid rgba(255,255,255,0.12); border-radius:10px;">
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $f['id'] ?>">
                        <input type="hidden" name="type" value="faq_update">

                        <label class="form-label">Question</label>
                        <input name="question" class="form-control mb-2"
                               value="<?= htmlspecialchars($f['question']) ?>">

                        <label class="form-label">Answer</label>
                        <textarea name="answer" class="form-control mb-2"
                                  rows="3"><?= htmlspecialchars($f['answer']) ?></textarea>

                        <button class="btn btn-primary btn-sm" name="type" value="faq_update">
                            Save
                        </button>

                        <button class="btn btn-danger btn-sm"
                                name="type" value="faq_delete"
                                onclick="return confirm('Delete this FAQ?');">
                            Delete
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
