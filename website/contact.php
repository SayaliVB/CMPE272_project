
  <?php include "header.html" ?>

    <div style="margin-top:30px;margin-left:20px;">

      <section style="background:#ffffff;" class="list">
        <p>
          <h2> <center> Call: <center></h2>
          <?php
            $contacts = file("contacts.txt");
            foreach ($contacts as $line_num => $line){
            echo "<center>$line</center><br>";
            }
          ?>
        </p>
          </section>
      <section style="background:#ffffff;" class="list">
        <p>
          <h2> <center> Email: </center> </h2>
          <?php
            $contacts = file("email.txt");
            foreach ($contacts as $line_num => $line){
            echo "<center>$line</center><br>";
            }
          ?>
        </p>
        </section>

      <section style="background:#ffffff;" class="list">
        <p>
          <h2> <center> Locate: </center> </h2>
          <?php
            $contacts = file("locations.txt");
            foreach ($contacts as $line_num => $line){
            echo "<center>$line</center><br>";
            }
          ?>
        </p>
          </section>

    </div>
    <?php include "footer.html" ?>

