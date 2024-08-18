<!-- app/Views/projects/index.php -->
<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container mx-auto px-4">
    <h2 class="text-3xl mb-4">Projects</h2>
    <a href="<?= base_url('projects/create') ?>" class="bg-blue-600 text-white p-2 rounded mb-4 inline-block">Create New Project</a>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($projects) && is_array($projects)): ?>
            <?php foreach ($projects as $project): ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="px-6 py-4">
                        <h3 class="text-xl font-bold mb-2"><?= esc($project['namaProyek']) ?></h3>
                        <p class="text-gray-700 text-base"><?= esc($project['client']) ?></p>
                        <p class="text-gray-500 text-sm">Start Date: <?= esc($project['tanggalMulai']) ?></p>
                        <p class="text-gray-500 text-sm">End Date: <?= esc($project['tanggalSelesai']) ?></p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <?php if (!empty($project['lokasi'])): ?>
                            <?php foreach ($project['lokasi'] as $lokasi): ?>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    <?= esc($lokasi['namaLokasi']) ?>, <?= esc($lokasi['kota']) ?>, <?= esc($lokasi['provinsi']) ?>
                                </span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-gray-500">No location data available</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500">No projects yet.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
