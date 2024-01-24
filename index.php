<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coolstays Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script>
        function fetchProperties() {
            var categoryId = document.getElementById('category-id-search-field').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'properties.php?category_id=' + categoryId, true);
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('properties-container').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }
    </script>
</head>

<body>
    <main class="p-3">
        <div class="container">
            <div class="alert alert-primary">
                <h3>Some sample category IDs...</h3>
                <p>Category ID 1172 - England</p>
                <p>Category ID 1192 - Scotland</p>
                <p>Category ID 1160 - Wales</p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="category-id-search-field">Search for a category ID</label>
                <input id="category-id-search-field" class="form-control" type="number" min="0" name="category_id"
                    placeholder="12345" />
            </div>
            <button type="button" id="search-button" class="btn btn-primary" onclick="fetchProperties()">Search</button>
        </div>
        <div id="properties-container"></div>
    </main>
</body>

</html>