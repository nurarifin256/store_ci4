<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?php

$username = [
    'name'  => 'username',
    'id'    => 'username',
    'value' => null,
    'class' => 'form-control'
];

$password = [
    'name'  => 'password',
    'id'    => 'password',
    'class' => 'form-control'
];

$session = session();
$errors = $session->getFlashdata('errors');
?>

<h1>Login Form</h1>

<?php if ($errors != null) : ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Terjadi Kesalahan</h4>
        <hr>
        <p class="mb-0">
            <?php foreach ($errors as $er) {
                echo $er . '<br>';
            }
            ?>
        </p>
    </div>
<?php endif; ?>

<?= form_open('auth/login'); ?>

<div class="form-group">
    <?= form_label("Username", "username"); ?>
    <?= form_input($username); ?>
</div>

<div class="form-group">
    <?= form_label("Password", "password"); ?>
    <?= form_password($password); ?>
</div>


<div class="text-right">
    <?= form_submit('submit', 'Login', ['class' => 'btn btn-primary']); ?>
</div>

<?= form_close(); ?>

<?= $this->endSection(); ?>