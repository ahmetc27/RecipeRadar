<div class="row justify-content-center">
    <div class="col-12">
        <h4 class="untertitle mb-1 mt-5">Post</h4>
        <hr>
        <form action="services/post_service.php" method="post" enctype="multipart/form-data">

            <label for="meal_title" style="font-size: 12px;">Meal Title:</label><br>
            <input type="text" id="meal_title" name="meal_title" style="font-size: 14px; padding: 5px;" required><br><br>

            <label for="description" style="font-size: 12px;">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" style="font-size: 14px; padding: 5px;" required></textarea><br><br>

            <label for="instructions" style="font-size: 12px;">Instructions:</label><br>
            <textarea id="instructions" name="instructions" rows="5" cols="50" style="font-size: 14px; padding: 5px;" required></textarea><br><br>

            <label for="photo" style="font-size: 12px;">Upload Photo:</label><br>
            <input type="file" id="photo" name="photo" accept="image/*" style="font-size: 14px; padding: 5px;" required><br><br>

            <label for="ingredients" style="font-size: 12px;">Ingredients/Recipe:</label><br>
            <textarea id="ingredients" name="ingredients" rows="6" cols="50" style="font-size: 14px; padding: 5px;" required></textarea><br><br>

            <label for="season" style="font-size: 12px;">Choose Season:</label><br>
            <select id="season" name="season" style="font-size: 14px; padding: 5px;" required>
                <option value="">Select Season</option>
                <option value="All">All Seasons</option>
                <option value="Spring">Spring</option>
                <option value="Summer">Summer</option>
                <option value="Autumn">Autumn</option>
                <option value="Winter">Winter</option>
            </select><br><br><br><br>

            <input type="submit" value="Submit" class="auth-btn">
            <br><br>
        </form>
    </div>
</div>
