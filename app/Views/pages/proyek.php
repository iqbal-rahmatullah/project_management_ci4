<!-- app/Views/projects/index.php -->
<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container mx-auto px-4">
    <h2 class="text-3xl mb-4">Projects</h2>
    <a href="/create-proyek" class="bg-blue-600 text-white p-2 rounded mb-4 inline-block">Create New Project</a>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($projects) && is_array($projects)): ?>
            <?php foreach ($projects as $project): ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="px-6 py-4">
                        <h3 class="text-xl font-bold mb-2"><?= esc($project['namaProyek']) ?></h3>
                        <p class="text-gray-700 text-base">Client: <?= esc($project['client']) ?></p>
                        <p class="text-gray-700 text-base">Nama Pimpinan: <?= esc($project['pimpinanProyek']) ?></p>
                        <p class="text-gray-500 text-sm">Start Date: <?= esc($project['tanggalMulai']) ?></p>
                        <p class="text-gray-500 text-sm">End Date: <?= esc($project['tanggalSelesai']) ?></p>
                        <p class="mt-3 text-gray-500 text-sm"><?= esc($project['keterangan']) ?></p>
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
                    <div class="px-6 pt-4 pb-4 flex justify-end">
                        <a href="<?= site_url('project/edit/' . $project['id']) ?>" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                            Edit
                        </a>
                        <form action="<?= site_url('project/delete/' . $project['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this project?');" class="ml-2">
                            <?= csrf_field() ?>
                            <button type="submit" class="inline-block bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500">No projects yet.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
