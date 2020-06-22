<?php

$attributes = '';
if (isset($data->attributes)) {
    $arAttributes = [];
    foreach ($data->attributes as $name => $value) {
        $arAttributes[] = "{$name}=\"{$value}\""; 
    }

    $attributes = implode(' ', $arAttributes);
}

?>

<form method="<?= $data->method ?>" action="<?= $data->action ?>" <?= $attributes ?>>
<?php foreach ($data->input as $name => $input) : ?>

<?php if ($input) : ?>
<?php endif; ?>

<?php endforeach; ?>
</form>