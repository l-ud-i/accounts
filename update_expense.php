<?php
require 'includes/_database.php';

// request to database the current operation
$query = $dbCo->prepare("SELECT `name`, `date_transaction`, `amount`, `id_category` FROM `transaction` WHERE id_transaction = :id");
$query->execute(['id' => $_POST['id_transaction']]);
$existingData = $query->fetch();

if ($existingData) {
    $query = $dbCo->prepare("UPDATE `transaction` SET name = :name, date_transaction = :date, amount = :amount, id_category = :cat WHERE id_transaction = :id");

    $isOK = $query->execute([
        'name' => $_POST['name'],
        'date' => $_POST['date'],
        'amount' => $_POST['amount'],
        'cat' => $_POST['category'],
        'id' => $_POST['id_transaction']
    ]);

    if ($isOK) {
        // update ok
        header('Location: index.php?notif=add_ok');
        exit;
    } else {
        // update ko
        header('Location: index.php?notif=add_err');
        exit;
    }
} else {
    echo "Opération introuvable dans la base de données.";
    exit;
}
?>
