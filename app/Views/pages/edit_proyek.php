<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2 class="text-3xl mb-4">Edit Project</h2>

<?php if (session()->getFlashdata('error')): ?>
    <script>
        window.onload = function() {
            alert('<?= esc(session()->getFlashdata('error')) ?>');
        }
    </script>
<?php endif; ?>

<div class="container mx-auto px-4">
    <form action="/" method="post" class="bg-white shadow-lg rounded-lg p-6">
        <?= csrf_field() ?>

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?= esc($project['id']) ?>">

        <div class="mb-4">
            <label for="namaProyek" class="block text-gray-700 text-sm font-bold mb-2">Project Name</label>
            <input type="text" id="namaProyek" name="namaProyek"
                   value="<?= esc($project['namaProyek']) ?>"
                   class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="client" class="block text-gray-700 text-sm font-bold mb-2">Client</label>
            <input type="text" id="client" name="client"
                   value="<?= esc($project['client']) ?>"
                   class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="tanggalMulai" class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
            <input type="date" id="tanggalMulai" name="tanggalMulai"
                   value="<?= esc($project['tanggalMulai']) ?>"
                   min="<?= date('Y-m-d') ?>"
                   class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="tanggalSelesai" class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
            <input type="date" id="tanggalSelesai" name="tanggalSelesai"
                   value="<?= esc($project['tanggalSelesai']) ?>"
                   min="<?= date('Y-m-d') ?>"
                   class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="pimpinanProyek" class="block text-gray-700 text-sm font-bold mb-2">Project Leader</label>
            <input type="text" id="pimpinanProyek" name="pimpinanProyek"
                   value="<?= esc($project['pimpinanProyek']) ?>"
                   class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="keterangan" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea id="keterangan" name="keterangan"
                      class="form-input w-full border border-gray-300 rounded p-2"
                      rows="4"><?= esc($project['keterangan']) ?></textarea>
        </div>

        <div class="mb-4">
            <label for="lokasiId" class="block text-gray-700 text-sm font-bold mb-2">Locations</label>
            <select id="lokasiId" name="lokasiId[]" class="form-input w-full border border-gray-300 rounded p-2 select2" multiple>
                <?php if (!empty($locations) && is_array($locations)): ?>
                    <?php foreach ($locations as $location): ?>
                        <option value="<?= esc($location['id']) ?>"
                            <?= in_array($location['id'], array_column($project['lokasi'], 'id')) ? 'selected' : '' ?>>
                            <?= esc($location['namaLokasi']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No locations available</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 text-white p-2 rounded">Update Project</button>
            <a href="<?= site_url('/') ?>" class="inline-block bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-700">
                Cancel
            </a>
        </div>
    </form>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#lokasiId').select2({
            placeholder: 'Select locations',
            allowClear: true
        });
    });
</script>

<?= $this->endSection() ?>
