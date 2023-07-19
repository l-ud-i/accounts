<!-- <?php
require 'includes/_database.php';

$query = $dbCo->prepare("DELETE FROM transaction WHERE id_transaction = :id");
$isOK = $query->execute([
    'id' => $_GET['id']
]);




header('Location: index.php?notif='.($isOK ? 'del_ok' : 'del_error'));
exit;
?> -->