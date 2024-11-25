<?php if ($this->session->userdata('role') == 'client'): ?>
    <a href="<?= site_url('client/dashboard'); ?>">Dashboard do Cliente</a>
<?php endif; ?>
<?php if ($this->session->userdata('role') == 'admin'): ?>
    <a href="<?= site_url('admin/dashboard'); ?>">Dashboard do Administrador</a>
<?php endif; ?>
