<!-- app/Views/layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Project Management' ?></title>
    <!-- Tailwind CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="bg-gray-100 h-screen flex flex-col">

<!-- Header -->
<?= $this->include('components/header') ?>

<div class="flex flex-1">
    <!-- Sidebar -->
    <?= $this->include('components/sidebar') ?>

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-white">
        <?= $this->renderSection('content') ?>
    </main>
</div>

<!-- Footer -->
<?= $this->include('components/footer') ?>

</body>
</html>
