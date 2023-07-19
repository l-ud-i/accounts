<?php
require 'includes/_database.php';

$query = $dbCo->prepare("UPDATE `transaction` 
                         SET name = :name, date_transaction = :date, amount = :amount, id_category = :cat WHERE id_transaction = :id");

$isOK = $query->execute([
    'name' => $_POST['name'],
    'date' => $_POST['date'],
    'amount' => $_POST['amount'],
    'cat' => $_POST['category'],
    'id' => $_POST['id_transaction']

]);


header('Location: index.php?notif='.($isOK ? 'add_ok' : 'add_err'));
exit;

?>