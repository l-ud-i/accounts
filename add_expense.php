<?php
require 'includes/_database.php';

$query = $dbCo->prepare("INSERT INTO `transaction`(`name`, `date_transaction`, `amount`, `id_category`)
                        VALUES (:name, :date_transaction, :amount, :category)");

$isOK = $query->execute([
    'name' => $_POST['name'],
    'date_transaction' => $_POST['date'],
    'amount' => $_POST['amount'],
    'category' => $_POST['category']
]);



header('Location: index.php?notif='.($isOK ? 'add_ok' : 'add_err'));
exit;

?>