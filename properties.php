<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coolstays Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style>
        .card {
            margin-bottom: 20px;
            width: 300px;
            border-radius: 20px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card .card-image {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .card .card-title {
            padding: 10px;
            color: black;
            font-weight: bold;
            opacity: 0.7;
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body>
    <main class="p-3">
        <div class="container">
            <h1>Properties</h1>
            <div class="row">

                <?php
                require_once 'vendor/autoload.php';

                use \Curl\Curl;

                $category_id = $_GET['category_id'] ?? '1172';

                define('RESULT_LIMIT', 50);

                $curl = new Curl();

                $apiUrl = 'https://api.coolstays.com/v2/search/properties';


                $fields = 'property_id,sleeps_friendly,title,image_id,image(*),property_breadcrumb';


                $apiToken = '1880|auLAzeOlg9rAcx89TG4szeUGhbNfpTB0dWDhaB0V';


                $curl->setHeader('Authorization', 'Bearer ' . $apiToken);


                $curl->get($apiUrl, ['fields' => $fields]);

                $properties = [];

                if ($curl->error) {
                    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
                } else {

                    foreach ($curl->response->data->properties as $property) {

                        $breadcrumbs = json_decode($property->property_breadcrumb, true);


                        foreach ($breadcrumbs as $breadcrumb) {
                            if ($breadcrumb['CATID'] === $category_id) {

                                $properties[] = $property;
                                break;
                            }
                        }
                    }
                }


                usort($properties, function ($a, $b) {
                    return strcmp($a->title, $b->title);
                });


                if (empty($properties)) {
                    echo "<p>Apologies, unfortunately no properties have been found under this category ID.</p>";
                } else {
                    $propertyCount = count($properties);
                    $resultText = $propertyCount . ($propertyCount == RESULT_LIMIT ? '+' : '') . '+ results found';
                }


                echo "<p>$resultText</p>";


                foreach ($properties as $property) {
                    $imgUri = $property->image->uri . '&w=300&h=200&fit=crop';
                    ?>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card">
                            <div class="card-image" style="background-image: url('<?php echo $imgUri; ?>');"></div>
                            <div class="card-title">
                                <?php echo $property->title; ?>
                                <br>
                                <i class="fa fa-bed"></i>
                                <?php echo " " . (isset($property->sleeps_friendly) ? $property->sleeps_friendly : 'Not available'); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                $curl->close();
                ?>
            </div>
    </main>
</body>

</html>