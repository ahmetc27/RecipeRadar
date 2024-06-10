<div class="row justify-content-center">
        
    <div class="col-12">
        
        <h4 class="untertitle mb-1 mt-5">Post</h4>
        
        <hr>

        <form action="services/post_service.php" method="post" enctype="multipart/form-data">

            <label for="meal_title" style="font-size: 12px;">Meal Title:</label><br>
            <input type="text" id="meal_title" name="meal_title" style="font-size: 14px; padding: 5px;" required><br><br>

            <label for="category" style="font-size: 12px;">Kategorie wählen:</label><br>
            <select id="category" name="category">
                <option value="Mediterranean">Mediterranean</option>
                <option value="Chinese">Chinese</option>
                <option value="Thai">Thai</option>
                <option value="Italian">Italian</option>
                <option value="Greek">Greek</option>
                <option value="Turkish">Turkish</option>
                <option value="Moroccan">Moroccan</option>
                <option value="Lebanese">Lebanese</option>
            </select><br><br>

            <label for="description" style="font-size: 12px;">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" style="font-size: 14px; padding: 5px;" required></textarea><br><br>

            <label for="photo" style="font-size: 12px;">Upload Photo:</label><br>
            <input type="file" id="photo" name="photo" accept="image/*" style="font-size: 14px; padding: 5px;" required><br><br>

            <label for="ingredients" style="font-size: 12px;">Ingredients/Recipe:</label><br>
            <textarea id="ingredients" name="ingredients" rows="6" cols="50" style="font-size: 14px; padding: 5px;" required></textarea><br><br>

            <input type="submit" value="Submit" class="auth-btn">

        </form>

    </div>
        
</div>