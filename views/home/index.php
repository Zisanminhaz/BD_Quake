<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="hero-title">
            Bangladesh Earthquake Awareness &amp; Safety Reporting System
        </h1>
        <p class="hero-subtitle mt-3">
            <?php if (isset($total_users)) : ?>
    <p class="mt-2" style="font-size:0.9rem; color:#9ca3af;">
        Registered users in database: <strong><?= htmlspecialchars($total_users) ?></strong>
    </p>
<?php endif; ?>

            Get real-time safety info, report unsafe buildings, find nearby shelters, and learn how to stay safe.
        </p>

    </div>
</section>

<!-- Features Cards -->
<section class="pb-4">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-6 col-lg-4">
                <div class="card-custom">
                    <h3>Report Unsafe Buildings</h3>
                    <p>Submit details of cracked or damaged buildings so admins can verify and mark them as critical or solved.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card-custom">
                    <h3>Emergency Shelters &amp; Hospitals</h3>
                    <p>Browse safe spots, open fields, schools, and hospitals categorized by district.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card-custom">
                    <h3>Panic Help Forum</h3>
                    <p>Ask questions, share experiences, and support others in a dedicated community space.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card-custom">
                    <h3>"Did You Feel It?" Reports</h3>
                    <p>Let others know where and how strongly you felt the earthquake to build a crowd-sourced intensity map.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card-custom">
                    <h3>Safety Guidelines</h3>
                    <p>Learn what to do before, during, and after an earthquake, tailored for people in Bangladesh.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card-custom">
                    <h3>FAQ &amp; Emergency Contacts</h3>
                    <p>Quick answers and important numbers ready when you need them most.</p>
                </div>
            </div>
        </div>
    </div>
</section>
