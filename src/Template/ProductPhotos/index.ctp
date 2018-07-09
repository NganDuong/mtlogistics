<?php
$inipath = php_ini_loaded_file();

if ($inipath) {
    echo 'Loaded php.ini: ' . $inipath;
} else {
   echo 'A php.ini file is not loaded';
}
?>

<h1>Upload File</h1>
<div class="content">
    <?= $this->Flash->render() ?>
    <div class="upload-frm">
        <?php echo $this->Form->create('upload', ['type' => 'file']); ?>
            <?php echo $this->Form->input('file', ['type' => 'file', 'class' => 'form-control']); ?>
            <?php echo $this->Form->button(__('Upload File'), ['type'=>'submit', 'class' => 'form-controlbtn btn-default']); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>