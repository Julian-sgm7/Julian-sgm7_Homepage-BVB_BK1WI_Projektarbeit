<?php
$titel = "Galerie";
include 'head.php';
include 'header.php';
?>

<main class="galerie-seite">
    <div class="container">
        <h1>Galerie</h1>

        <div class="gallery-grid">
            <?php
            $imgDir = __DIR__ . '/../img';
            $files = [];
            if (is_dir($imgDir)) {
                $all = scandir($imgDir);
                foreach ($all as $f) {
                    if (in_array($f, ['.', '..'])) continue;
                    if (preg_match('/\.(jpe?g|png|gif|webp|bmp)$/i', $f)) $files[] = $f;
                }
            }

            if (empty($files)) {
                echo '<p>Keine Bilder gefunden.</p>';
            } else {
                foreach ($files as $file) {
                    $url = '/img/' . rawurlencode($file);
                    $caption = htmlspecialchars(pathinfo($file, PATHINFO_FILENAME));
                    echo '<figure class="gallery-item">';
                    echo '<img src="' . $url . '" alt="' . $caption . '" loading="lazy" data-full="' . $url . '" onclick="openLightbox(this)">';
                    echo '<figcaption>' . $caption . '</figcaption>';
                    echo '</figure>';
                }
            }
            ?>
        </div>
    </div>
</main>

<!-- Lightbox markup -->
<div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
    <span class="close" onclick="closeLightbox(event)">&times;</span>
    <div class="lightbox-inner">
        <img id="lightbox-img" src="" alt="">
        <div id="lightbox-caption" class="caption"></div>
    </div>
</div>

<script src="../js/gallery.js"></script>

<?php include 'footer.php'; ?>
