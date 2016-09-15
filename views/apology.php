<!DOCTYPE html>
<p class="lead text-danger">
    Hello!
</p>
<p class="text-danger">
    <?= htmlspecialchars($message) ?>
</p>

<?php $previous = "javascript:history.go(-1)";

if(isset($_SERVER['HTTP_REFERER']))
{
    $previous = $_SERVER['HTTP_REFERER'];
}
?>

<a href="<?= $previous ?>">Back</a>