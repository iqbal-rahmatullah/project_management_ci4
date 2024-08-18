<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4">
    <h2 class="text-3xl mb-4">Locations</h2>
    <a href="/create-lokasi" class="bg-blue-600 text-white p-2 rounded mb-4 inline-block">Create New Lokasi</a>

    <?php if (session()->getFlashdata('message')): ?>
        <script>
            window.onload = function() {
                alert('<?= esc(session()->getFlashdata('message')) ?>');
            }
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <script>
            window.onload = function() {
                alert('<?= esc(session()->getFlashdata('error')) ?>');
            }
        </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('validation')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('validation') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
        <thead>
        <tr class="bg-gray-200 border-b">
            <th class="py-2 px-4 text-left">ID</th>
            <th class="py-2 px-4 text-left">Location</th>
            <th class="py-2 px-4 text-left">Country</th>
            <th class="py-2 px-4 text-left">Province</th>
            <th class="py-2 px-4 text-left">City</th>
            <th class="py-2 px-4 text-left">Created At</th>
            <th class="py-2 px-4 text-left">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($locations) && is_array($locations)): ?>
            <?php foreach ($locations as $location): ?>
                <tr>
                    <td class="py-2 px-4"><?= esc($location['id']) ?></td>
                    <td class="py-2 px-4"><?= esc($location['namaLokasi']) ?></td>
                    <td class="py-2 px-4"><?= esc($location['negara']) ?></td>
                    <td class="py-2 px-4"><?= esc($location['provinsi']) ?></td>
                    <td class="py-2 px-4"><?= esc($location['kota']) ?></td>
                    <td class="py-2 px-4"><?= esc($location['createdAt']) ?></td>
                    <td class="py-2 px-4 flex space-x-2">
                        <button  class="text-blue-500 hover:bg-blue-100 p-1 rounded edit-location-btn"
                                 data-bs-toggle="modal" data-bs-target="#editLocationModal<?= $location['id'] ?>"
                                 data-id="<?= esc($location['id']) ?>"
                                 data-nama-lokasi="<?= esc($location['namaLokasi']) ?>"
                                 data-negara="<?= esc($location['negara']) ?>"
                                 data-provinsi="<?= esc($location['provinsi']) ?>"
                                 data-kota="<?= esc($location['kota']) ?>">
                            <i class="bi bi-pencil"></i>
                        </button>


                        <div class="modal fade" id="editLocationModal<?= $location['id'] ?>" tabindex="-1" aria-labelledby="editLocationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editLocationModalLabel">Edit Location</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">  

                                        <form id="editLocationForm<?= $location['id'] ?>"  
                                              action="/lokasi" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" id="id" value="<?= $location['id'] ?>" name="id">

                                            <div class="mb-3">
                                                <label for="editNamaLokasi" class="form-label">Location Name</label>
                                                <input type="text" class="form-control" value="<?= $location['namaLokasi'] ?>" id="editNamaLokasi" name="namaLokasi" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editNegara" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="editNegara" value="<?= $location['negara'] ?>" name="negara" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProvinsi" class="form-label">Province</label>
                                                <input type="text" class="form-control" id="editProvinsi" value="<?= $location['provinsi'] ?>" name="provinsi" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editKota" class="form-label">City</label>
                                                <input type="text" class="form-control" id="editKota" value="<?= $location['kota'] ?>" name="kota" required>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  

                                        <button type="submit"  
                                                form="editLocationForm<?= $location['id'] ?>" class="btn btn-primary">Save changes</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <form action="<?= base_url('lokasi/' . esc($location['id'])) ?>" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-500 hover:bg-red-100 p-1 rounded" onclick="return confirmDelete()">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="py-2 px-4 text-center">No locations available</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this location?');
    }
</script>
<?= $this->endSection() ?>
