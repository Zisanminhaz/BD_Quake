<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card-custom">
                    <h2 class="mb-3">Create Account</h2>
                    <p class="mb-3" style="font-size:0.9rem;color:#9ca3af;">
                        Register to report unsafe buildings, join the forum, and save your reports.
                    </p>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0" style="padding-left: 18px;">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= BASE_URL ?>/index.php?controller=auth&action=register">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirm" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 mt-2">
                            Sign Up
                        </button>

                        <p class="mt-3 mb-0" style="font-size:0.9rem;">
                            Already have an account?
                            <a href="<?= BASE_URL ?>/index.php?controller=auth&action=login">Login here</a>.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
