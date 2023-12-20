<table class="table-display">
    <tr>
        <?php
            foreach($data[0] as $col => $val){
                echo "<th>";
                echo $col;
                echo "</th>";
            }
        ?>        
    </tr>
    <?php
        foreach($data as $row){
            echo "<tr>";
            foreach($row as $col => $val){
                echo "<td>";
                echo $val;
                echo "</td>";
            }
            echo "</tr>";
        }
    ?>
</table>