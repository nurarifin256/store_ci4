<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<h1>List Barang</h1>

<table class="table">
    <thead>
        <th>No</th>
        <th>Nama</th>
        <th>Gambar</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        <?php foreach ($barang as $index => $b) : ?>
            <tr>
                <td><?= ($index + 1); ?></td>
                <td><?= $b->nama ?></td>
                <td><img src="/uploads/<?= $b->gambar ?>" class="img-fluid" width="200px" alt="gambar"></td>
                <td><?= $b->harga ?></td>
                <td><?= $b->stok ?></td>
                <td>
                    <a href="/Barang/view/<?= $b->id; ?>" class="btn btn-primary">View</a>
                    <a href="/Barang/update/<?= $b->id; ?>" class="btn btn-success">Edit</a>
                    <a href="/Barang/delete/<?= $b->id; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection(); ?>