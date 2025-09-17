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
        <div class="album bg-body-tertiary w-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12  mt-5">
                        <h1 class="pb-3 border-bottom">Modification du produit : <span id="productTitle"></span></h1>
                    </div>
                    <div class="col-12 mt-5">
                        <form action="" method="post" id="UpdateProductForm" class="border p-3">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="category_id">Catégorie</label>
                                <select name="category_id" id="category_id" class="form-control"></select>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="stock">Stock</label>
                                <input type="text" name="stock" id="stock" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="price">Prix</label>
                                <input type="text" name="price" id="price" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="image">Image actuelle</label><br>
                                <img id="oldImage" class="img-thumbnail" width="140" src="">
                            </div>
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-dark">Modifier</button>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../js/access_back.js"></script>
    <script src="../js/edit_products.js"></script>
</body>

</html>