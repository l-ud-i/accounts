<?php
require 'includes/_database.php';

// session_start();
// if (!(array_key_exists('HTTP_REFERER', $_SERVER)) && str_contains($_SERVER['HTTP_REFERER'], $_ENV["URL"])) {
//     header('Location: index.php?msg=error_referer');
//     exit;
// }
// else if (!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST) || $_SESSION['token'] !== $_REQUEST["token"]) {
//     header('Location: index.php?msg=error_csrf');
//     exit;
// }

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