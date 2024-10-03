<!-- app/Views/swagger/index.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="./css/swagger-ui.css">
</head>
<body>
    <div id="swagger-ui"></div>

    <script src="./js/swagger-ui-bundle.js"></script>
    <script src="./js/swagger-ui-standalone-preset.js"></script>
    <script>
        window.onload = function () {
            // Begin Swagger UI call region
            const ui = SwaggerUIBundle({
                url: "/swagger.json",
                dom_id: "#swagger-ui",
                presets: [SwaggerUIBundle.presets.apis],
            });
            // End Swagger UI call region

            window.ui = ui;
        };
    </script>
</body>
</html>
