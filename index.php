<?php
// Chicken Data
$chicken_source = 'https://www.themealdb.com/api/json/v1/1/search.php?s=chicken';
$chicken_content = file_get_contents($chicken_source);
$chicken_data = json_decode($chicken_content, true);

// Seafood Data
$seafood_source = 'https://www.themealdb.com/api/json/v1/1/filter.php?c=Seafood';
$seafood_content = file_get_contents($seafood_source);
$seafood_data = json_decode($seafood_content, true);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Makanan Jepang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Makanan Jepang</h1>
        <ul class="nav nav-tabs mt-3" id="foodTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="chicken-tab" data-bs-toggle="tab" data-bs-target="#chicken">Chicken</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="seafood-tab" data-bs-toggle="tab" data-bs-target="#seafood">Seafood</button>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="chicken">
                <div class="row">
                    <?php foreach ($chicken_data['meals'] as $meal) { ?>
                        <div class="col-md-3 mt-3">
                            <div class="card shadow" onclick="fetchRecipe(<?= $meal['idMeal']; ?>)">
                                <img src="<?= $meal['strMealThumb']; ?>" class="card-img-top" alt="<?= $meal['strMeal']; ?>">
                                <div class="card-body">
                                    <p class="card-text text-center fw-bold"> <?= $meal['strMeal']; ?> </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="tab-pane fade" id="seafood">
                <div class="row">
                    <?php foreach ($seafood_data['meals'] as $meal) { ?>
                        <div class="col-md-3 mt-3">
                            <div class="card shadow" onclick="fetchRecipe(<?= $meal['idMeal']; ?>)">
                                <img src="<?= $meal['strMealThumb']; ?>" class="card-img-top" alt="<?= $meal['strMeal']; ?>">
                                <div class="card-body">
                                    <p class="card-text text-center fw-bold"> <?= $meal['strMeal']; ?> </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan resep -->
    <div class="modal fade" id="recipeModal" tabindex="-1" aria-labelledby="recipeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recipeModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="recipeContent">
                    Loading...
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
