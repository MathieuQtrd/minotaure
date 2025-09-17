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
    <?php include 'inc/nav.inc.php' ?>
    <main>      
        <div class="album py-5 bg-body-tertiary mt-5">
            <div class="container">
                <div class="row g-3">                    
                    <div class="col-sm-6">
                        <img src="" alt="" class="imt-thumbnail w-100" id="productImage">
                    </div>
                    <div class="col-sm-6" id="productInfos"></div>
                </div>
            </div>
        </div>
    </main>
    <footer class="text-body-secondary py-5">
        <div class="container">
            <p class="float-end mb-1"> <a href="#">Back to top</a> </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="js/menu.js"></script>
    <script src="js/product_details.js"></script>
</body>

</html>