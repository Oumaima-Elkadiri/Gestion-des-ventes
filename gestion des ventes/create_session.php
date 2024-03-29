<?php
session_start();

$_SESSION['prod'] = [$_POST['ref'], $_POST['image']];

echo "Session créée avec succès.";
?>
