<?php
if ($current_page > 2) {
    $fist_page = 1;
?>
    <a href="?per_page=<?= $item_per_page ?>&page=<?= $fist_page ?>">Fist</a>
<?php
}
?>

<?php
if ($current_page > 1) {
    $prev_page = $current_page - 1;

?>
    <a href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Frev</a>
<?php
}
?>

<?php
for ($i = 1; $i <= $totalPage; $i++) { ?>
    <?php if ($i != $current_page) { ?>

        <?php if ($i > $current_page - 2 && $i < $current_page + 2) { ?>
            <a href="?per_page=<?= $item_per_page ?>&page=<?= $i ?>"><?= $i ?></a>
        <?php } ?>
    <?php } else { ?>
        <strong><?= $current_page ?> </strong>

    <?php } ?>
<?php
}

?>

<?php
if ($current_page < $totalPage) {
    $next_page = $current_page + 1;

?>
    <a href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
<?php
}
?>

<?php
if ($current_page < $totalPage - 1) {

?>
    <a href="?per_page=<?= $item_per_page ?>&page=<?= $totalPage ?>">Last</a>
<?php
}
?>