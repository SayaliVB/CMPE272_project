<h3 class="prod-name"><?=$prod["name"]?></h3>
<img src="<?php
    if(isset($prod["img"]) && $prod["domain"] == "https://subramanyajagadeesh-0a2895b9a580.herokuapp.com/") echo $prod["domain"]."assets/images/".$prod["img"];
    else if(isset($prod["img"])) echo $prod["domain"]."/images/".$prod["img"];
    else echo "https://cmpe272hw.pietrasik.top/images/Missing.png";
?>" alt="<?=$prod["name"]?> image" class="prod-pic" style="width: 150px; height: 150px;">
<p class="prod-desc">
    <?=$prod["description"]?>
</p>
<p class="prod-price"><?=$prod["price"]?></p><?php
    if(isset($prod["avgrating"])){
        echo "<p class=\"prod-rating\">";
        echo "Rating: ".$prod["avgrating"];
        echo "/5</p>";
    }
?><p class="prod-views">Views: <?=$prod["hits"]?></p>