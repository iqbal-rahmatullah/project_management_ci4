<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4">
    <h2 class="text-3xl mb-4">Add Project</h2>
    <form action="<?= base_url('projects/update') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-4">
            <label for="namaProyek" class="block text-gray-700 text-sm font-bold mb-2">Project Name</label>
            <input type="text" id="namaProyek" name="namaProyek" class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="client" class="block text-gray-700 text-sm font-bold mb-2">Client</label>
            <input type="text" id="client" name="client"  class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="tanggalMulai" class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
            <input type="date" id="tanggalMulai" name="tanggalMulai"  class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="tanggalSelesai" class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
            <input type="date" id="tanggalSelesai" name="tanggalSelesai" class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="pimpinanProyek" class="block text-gray-700 text-sm font-bold mb-2">Project Leader</label>
            <input type="text" id="pimpinanProyek" name="pimpinanProyek"  class="form-input w-full border border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="keterangan" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea id="keterangan" name="keterangan" class="form-input w-full border border-gray-300 rounded p-2" rows="4"></textarea>
        </div>
        <div class="mb-4">
            <label for="lokasiId" class="block text-gray-700 text-sm font-bold mb-2">Locations</label>
            <select id="lokasiId" name="lokasiId[]" class="form-input w-full border border-gray-300 rounded p-2 select2" multiple>
                <?php if (!empty($locations) && is_array($locations)): ?>
                    <?php foreach ($locations as $location): ?>
                        <option value="<?= esc($location['id']) ?>"><?= esc($location['namaLokasi']) ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No locations available</option>
                <?php endif; ?>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white p-2 rounded">Create Project</button>
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
