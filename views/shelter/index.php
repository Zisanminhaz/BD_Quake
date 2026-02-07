<div class="container py-5">
    <h2 class="mb-4 text-center">Emergency Shelters &amp; Hospitals</h2>

    <!-- Map -->
    <div id="shelter-map"></div>

    <!-- Filter form -->
    <form class="row g-2 mb-4" method="get"
          action="<?= BASE_URL ?>/index.php">
        <input type="hidden" name="controller" value="shelter">
        <input type="hidden" name="action" value="index">

        <div class="col-md-4">
            <input type="text" name="district" class="form-control"
                   placeholder="Filter by district (e.g. Dhaka)"
                   value="<?= htmlspecialchars($district) ?>">
        </div>
        <div class="col-md-2">
            <button class="btn btn-warning w-100">Search</button>
        </div>
        <div class="col-md-2">
            <a href="<?= BASE_URL ?>/index.php?controller=shelter&action=index"
               class="btn btn-outline-light w-100">
                Clear
            </a>
        </div>
    </form>

    <?php if (empty($shelters)): ?>
        <p>No shelters found.</p>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($shelters as $s): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card-custom h-100">
                        <h4 class="mb-1"><?= htmlspecialchars($s['name']) ?></h4>
                        <p class="mb-1" style="font-size:0.9rem;color:#9ca3af;">
                            <?= htmlspecialchars(ucfirst($s['type'] ?: 'Shelter')) ?>
                        </p>
                        <p class="mb-1"><strong>District:</strong> <?= htmlspecialchars($s['district']) ?></p>
                        <p class="mb-1"><strong>Address:</strong> <?= htmlspecialchars($s['address']) ?></p>
                        <?php if ($s['latitude'] && $s['longitude']): ?>
                            <p class="mb-0" style="font-size:0.85rem;color:#9ca3af;">
                                Co-ordinates: <?= htmlspecialchars($s['latitude']) ?>,
                                <?= htmlspecialchars($s['longitude']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php
    // Build simplified data for JS map (only shelters with coordinates)
    $mapShelters = [];
    foreach ($shelters as $s) {
        if (!empty($s['latitude']) && !empty($s['longitude'])) {
            $mapShelters[] = [
                'name'     => $s['name'],
                'type'     => $s['type'],
                'address'  => $s['address'],
                'district' => $s['district'],
                'lat'      => (float)$s['latitude'],
                'lng'      => (float)$s['longitude'],
            ];
        }
    }
    ?>

    <script>
        const shelterMarkers = <?= json_encode($mapShelters, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

        function initShelterMapLeaflet() {
            const defaultCenter = [23.8103, 90.4125]; // Dhaka
            const map = L.map('shelter-map').setView(defaultCenter, 7);

            // Free tiles from OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            if (shelterMarkers.length === 0) {
                return; // no markers, just show default map
            }

            const bounds = [];
            shelterMarkers.forEach(s => {
                const marker = L.marker([s.lat, s.lng]).addTo(map);
                marker.bindPopup(
                    `<strong>${s.name}</strong><br>` +
                    (s.type ? `${s.type}<br>` : '') +
                    `${s.address}<br>` +
                    `${s.district}`
                );
                bounds.push([s.lat, s.lng]);
            });

            if (bounds.length > 0) {
                map.fitBounds(bounds, {padding: [20, 20]});
            }
        }

        document.addEventListener('DOMContentLoaded', initShelterMapLeaflet);
    </script>
</div>
