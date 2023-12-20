<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/src/linked_database.php");

    echo "<h2>Top 5 Products by Viewcount</h2>";
    $products = $db->getTopProductsHitsCombined();
    include($_SERVER["DOCUMENT_ROOT"]."/src/element/product/full_products.php");
?>