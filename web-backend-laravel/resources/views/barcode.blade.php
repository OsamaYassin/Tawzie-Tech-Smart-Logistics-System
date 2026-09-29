<!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Laravel 8 Barcode Demo - codeanddeploy.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <div class="row">
            <?php echo DNS1D::getBarcodeSVG("12345", 'C39');?>
        </div>
    </body>

</html>
