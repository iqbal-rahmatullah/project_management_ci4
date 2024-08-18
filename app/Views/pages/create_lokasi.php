<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4">
    <h2 class="text-3xl mb-4">Add New Location</h2>

    <?php if (isset($error)): ?>
        <div class="mb-4 p-2 bg-red-200 text-red-700 border border-red-400 rounded">
            <?= esc($error) ?>
        </div>
    <?php endif; ?>

    <form action="/lokasi" method="post">
        <?= csrf_field() ?>

        <div class="mb-4">
            <label for="namaLokasi" class="block text-gray-700 text-sm font-bold mb-2">Location Name</label>
            <input type="text" id="namaLokasi" name="namaLokasi" value="<?= esc($inputData['namaLokasi'] ?? '') ?>" class="form-input w-full border border-gray-300 rounded p-2" required>
            <?= isset($validation) ? $validation->getError('namaLokasi') : '' ?>
        </div>

        <div class="mb-4">
            <label for="negara" class="block text-gray-700 text-sm font-bold mb-2">Country</label>
            <input type="text" id="negara" name="negara" value="<?= esc($inputData['negara'] ?? '') ?>" class="form-input w-full border border-gray-300 rounded p-2" required>
            <?= isset($validation) ? $validation->getError('negara') : '' ?>
        </div>

        <div class="mb-4">
            <label for="provinsi" class="block text-gray-700 text-sm font-bold mb-2">Province</label>
            <input type="text" id="provinsi" name="provinsi" value="<?= esc($inputData['provinsi'] ?? '') ?>" class="form-input w-full border border-gray-300 rounded p-2" required>
            <?= isset($validation) ? $validation->getError('provinsi') : '' ?>
        </div>

        <div class="mb-4">
            <label for="kota" class="block text-gray-700 text-sm font-bold mb-2">City</label>
            <input type="text" id="kota" name="kota" value="<?= esc($inputData['kota'] ?? '') ?>" class="form-input w-full border border-gray-300 rounded p-2" required>
            <?= isset($validation) ? $validation->getError('kota') : '' ?>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-600 text-white p-2 rounded">Save Location</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
