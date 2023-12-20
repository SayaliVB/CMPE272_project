<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/src/linked_database.php");

    echo "<h2>Top 5 Products by Average Rating</h2>";
    $products = $db->getTopProductsRatingCombined();
    include($_SERVER["DOCUMENT_ROOT"]."/src/element/product/full_products.php");
?>