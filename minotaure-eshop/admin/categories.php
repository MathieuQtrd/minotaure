<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Eshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="icon" href="" sizes="32x32" type="image/png">

</head>

<body>
    <?php include '../inc/nav_dashboard.inc.php' ?>
    <main class="d-flex">
        <?php include '../inc/sidebar_dashboard.inc.php' ?>
        <div class="album bg-body-tertiary w-100 flex-grow-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12  mt-5">
                        <h1 class="pb-3 border-bottom">Catégories</h1>
                    </div>
                    <div class="col-6 mt-5">
                        <form action="" method="post" id="categoryForm" class="border p-3">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-dark">Enrgistrer</button>
                        </form>
                    </div>
                    <div class="col-6 mt-5">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titre</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody id="categoriesList">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../js/access_back.js"></script>
    <script src="../js/categories.js"></script>
</body>

</html>