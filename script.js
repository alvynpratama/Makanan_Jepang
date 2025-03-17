async function fetchRecipe(mealId) {
    const response = await fetch(`https://www.themealdb.com/api/json/v1/1/lookup.php?i=${mealId}`);
    const data = await response.json();
    const meal = data.meals[0];

    let ingredients = "<h5>Ingredients:</h5><ul>";
    for (let i = 1; i <= 20; i++) {
        if (meal[`strIngredient${i}`]) {
            ingredients += `<li>${meal[`strIngredient${i}`]} - ${meal[`strMeasure${i}`]}</li>`;
        }
    }
    ingredients += "</ul>";

    document.getElementById("recipeModalLabel").innerText = meal.strMeal;
    document.getElementById("recipeContent").innerHTML = `
        <img src="${meal.strMealThumb}" class="img-fluid mb-3" />
        ${ingredients}
        <h5>Instructions:</h5>
        <p>${meal.strInstructions}</p>
    `;

    new bootstrap.Modal(document.getElementById("recipeModal")).show();
}
