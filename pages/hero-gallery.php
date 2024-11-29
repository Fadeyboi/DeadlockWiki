<!-- Name: Fahd Adel Alghamdi -->
<!-- ID: 2135938 -->
<!-- Section: CS1 -->
<!-- Date: 9/22/2024 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <title>Image Gallery</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="../images/website-logo.png" />
    <link rel="stylesheet" href="../global/styles.css" />
    <script>
        function showImage(src, alt) {
            const largeImage = document.getElementById('large-image');
            const caption = document.getElementById('image-caption');
            largeImage.src = src;
            largeImage.alt = alt;
            caption.textContent = alt;
        }
    </script>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div id="main">
        <h1>Image Gallery</h1>
        <div id="gallery">
            <!-- Display large image -->
            <div id="large-image-container" style="text-align: center; margin-bottom: 20px;">
                <img id="large-image" src="../images/abrams-icon.png" alt="Default Image" style="max-width: 100%; height: auto; border-radius: 10px;" />
                <figcaption id="image-caption" style="margin-top: 10px; font-size: 1.2em; color: #555;">Abrams' Icon</figcaption>
            </div>

            <!-- Thumbnails -->
            <div class="thumbnails-gallery">
                <div class="thumbnail">
                    <img src="../images/abrams-icon.png" alt="Gallery Image 1" onclick="showImage('../images/abrams-icon.png', 'Abrams\' Icon')" />
                </div>
                <div class="thumbnail">
                    <img src="../images/bebop-icon.png" alt="Gallery Image 2" onclick="showImage('../images/bebop-icon.png', 'Bebop\'s Icon')" />
                </div>
                <div class="thumbnail">
                    <img src="../images/dynamo-icon.png" alt="Gallery Image 3" onclick="showImage('../images/dynamo-icon.png', 'Dynamo\'s Icon')" />
                </div>
                <div class="thumbnail">
                    <img src="../images/abrams-gallery-1.png" alt="Gallery Image 4" onclick="showImage('../images/abrams-gallery-1.png', 'Abrams\' Ingame Model')" />
                </div>
                <div class="thumbnail">
                    <img src="../images/bebop-gallery-1.png" alt="Gallery Image 5" onclick="showImage('../images/bebop-gallery-1.png', 'POV Bebop just hooked you')" />
                </div>
            </div>
            <div class="thumbnails-gallery">
                <div class="thumbnail">
                    <img src="../images/dynamo-gallery-1.png" alt="Gallery Image 6" onclick="showImage('../images/dynamo-gallery-1.png', 'How it looks like when you miss your ultimate as Dynamo')" />
                </div>
                <div class="thumbnail">
                    <img src="../images/abrams-gallery-2.png" alt="Gallery Image 6" onclick="showImage('../images/abrams-gallery-2.png', 'Full build Abrams')" />
                </div>
            </div>

        </div>
    </div>
    <?php include  '../includes/footer.php'; ?>
</body>

</html>