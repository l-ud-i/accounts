<?php
require 'includes/_database.php';

// request to database for the balance of july
$query = $dbCo->prepare("SELECT SUM(amount) AS sum_amount 
                        FROM `transaction`
                        WHERE MONTH(`date_transaction`) = 7 AND YEAR(`date_transaction`) = 2023");
$query->execute();
$balance_july = $query->fetch();


// request to database for july's expenses
$query = $dbCo->prepare("SELECT `date_transaction`, `name`,`amount`, `id_transaction`
                        FROM `transaction`
                        WHERE MONTH(`date_transaction`) = 7 AND YEAR(`date_transaction`) = 2023
                        ORDER BY `date_transaction` DESC;");
$query->execute();
$expenses = $query->fetchAll();




?>

<!DOCTYPE html>
<html lang="fr">

<body>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opérations de Juillet 2023 - Mes Comptes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<?php
include 'header.php';
?>


<div class="container">
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h2 class="my-0 fw-normal fs-4">Solde aujourd'hui</h2>
            </div>
            <div class="card-body">
                <?php
                echo '<p class="card-title pricing-card-title text-center fs-1">' . implode(' ', $balance_july) . ' €</p>';
                ?>
            </div>
        </section>
        
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal fs-4">Opérations de Juillet 2023</h1>
            </div>

        <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Opération</th>
                            <th scope="col" class="text-end">Montant</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                        foreach($expenses as $expense) {
                            echo '
                            <tr>
                                <td width="50" class="ps-3"></td>
                                <td>
                                    <time datetime="' . $expense['date_transaction'] . '" class="d-block fst-italic fw-light">' . $expense['date_transaction'] . '</time>
                                    ' . $expense['name'] . '
                                </td>
                                <td class="text-end">
                                    <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                    ' . $expense['amount'] . ' €
                                    </span>
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="update.php?id_transaction=' . $expense['id_transaction'] . '" class="btn btn-outline-primary btn-sm rounded-circle">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="delete.php?id=' . $expense['id_transaction'] . '" class="btn btn-outline-danger btn-sm rounded-circle">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td> 
                            </tr>'
                        ;}
                        ?>
                    </tbody>
                </table>
        </div>
        
            <div class="card-footer">
                <nav class="text-center">
                    <ul class="pagination d-flex justify-content-center m-2">
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="bi bi-arrow-left"></i>
                            </span>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">Juillet 2023</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="index.html">Juin 2023</a>
                        </li>
                        <li class="page-item">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="index.html">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>

    <div class="position-fixed bottom-0 end-0 m-3">
        <a href="add.php" class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-plus fs-1"></i>
        </a>
    </div>


<?php
include 'footer.php';
?>
</body>
</html>