<?= $this->extend('layout'); ?>
<?= $this->Section('content'); ?>

<?php
$id_barang = [
    'name' => 'id_barang',
    'id'   => 'id_barang',
    'value' => $model->id,
    'type'  => 'hidden'
];

$id_pembeli = [
    'name' => 'id_pembeli',
    'id'   => 'id_pembeli',
    'value' => session()->get('id'),
    'type'  => 'hidden'
];

$jumlah = [
    'name' => 'jumlah',
    'id'   => 'jumlah',
    'value' => 1,
    'min'   => 1,
    'class' => 'form-control',
    'type'  => 'number',
    'max'   => $model->stok
];

$total_harga = [
    'name' => 'total_harga',
    'id'   => 'total_harga',
    'value' => null,
    'class' => 'form-control',
    'readonly' => true
];

$ongkir = [
    'name' => 'ongkir',
    'id'   => 'ongkir',
    'value' => null,
    'class' => 'form-control',
    'readonly' => true
];

$alamat = [
    'name' => 'alamat',
    'id'   => 'alamat',
    'class' => 'form-control'
];

$submit = [
    'name' => 'submit',
    'id'   => 'submit',
    'type' => 'submit',
    'value' => 'Beli',
    'class' => 'btn btn-success'
]
?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <img src="/uploads/<?= $model->gambar ?>" class="img-fluid">
                    <h1 class="text-success"><?= $model->nama ?></h1>
                    <h4>Harga : <?= $model->harga ?></h4>
                    <h4>Stok : <?= $model->stok ?></h4>
                </div>
            </div>
        </div>

        <div class="col-6">
            <h4>Pengiriman</h4>

            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select name="" id="provinsi" class="form-control">
                    <option value="">Pilih Provinsi</option>
                    <?php foreach ($provinsi  as $p) : ?>
                        <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="kabupaten">Kabupate/Kota</label>
                <select name="" id="kabupaten" class="form-control">
                    <option value="">Pilih Kabupaten/Kota</option>
                </select>
            </div>

            <div class="form-group">
                <label for="service">Service</label>
                <select name="" id="service" class="form-control">
                    <option value="">Pilih Service</option>
                    
                </select>
            </div>

            <strong>Estimasi : <span id="estimasi"></span></strong>

            <?= form_open('Etalase/beli') ?>
            <?= form_input($id_barang) ?>
            <?= form_input($id_pembeli) ?>

            <div class="form-group">
                <?= form_label('Jumlah Pembelian', 'jumlah') ?>
                <?= form_input($jumlah) ?>
            </div>

            <div class="form-group">
                <?= form_label('Ongkir', 'ongkir') ?>
                <?= form_input($ongkir) ?>
            </div>

            <div class="form-group">
                <?= form_label('Total Harga', 'total_harga') ?>
                <?= form_input($total_harga) ?>
            </div>

            <div class="form-group">
                <?= form_label('Alamat', 'alamat') ?>
                <?= form_input($alamat) ?>
            </div>

            <div class="text-right">
                <?= form_submit($submit) ?>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>