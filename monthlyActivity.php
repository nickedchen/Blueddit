<!-- Home -->

<!DOCTYPE html>
<html lang="en" class="home">

<head>
  <?php include 'include/head.php'; ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Home - Blueddit</title>
</head>

<main>

  <body>
    <?php
      if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] == false) {
        header('Location: index.php');
        die();
      }
    ?>

    <!-- Navigation bar -->
    <?php include 'include/navBar.php'; ?>

    <!-- Content -->
    <div class="container-fluid">
      <div class="row pt-4">

        <?php include 'include/sidebar.php'; ?>

        <!-- Charts -->
        <div class="col-md-6 overflow-auto">
          <h2 class="text-dark" >Overall User Activity</h2>
          <p class="text-dark" >Monthly activity.</p>
          <p style="align:center;" class = "text-dark"><canvas  id="chartjs_bar"></canvas></p>
          <?php
            if ($error != null) {
              echo "<p>Unable to reach the database!</p>";
            } else {
              $sql = "SELECT COUNT(*) AS monthlyActivity, YEAR(entryDate) AS actYear, MONTH(entryDate) AS actMonth FROM usageTracking GROUP BY YEAR(entryDate), MONTH(entryDate) ORDER BY MONTH(entryDate) DESC LIMIT 12";
              $result = mysqli_query($conn, $sql);
              echo mysqli_error($conn);
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $dates[] = $row['actMonth']."/".$row['actYear'];
                $activity[] = $row['monthlyActivity'];
              }
            }
          ?>

          <script type="text/javascript">
            Chart.defaults.color = '#818181';
            var ctx = document.getElementById("chartjs_bar").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels:<?php echo json_encode($dates); ?>,
                datasets: [{
                  label: 'Site Interactions',
                  backgroundColor: [
                    "#00B5EE"
                  ],
                  data:<?php echo json_encode($activity); ?>,
                }]
              },
              options: {
                legend: {
                  display: true,
                  position: 'bottom',
                  labels: {
                    fontColor: '#71748d',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                  }
                },
          
              }
            });
          </script>

          <!--Activity by sub-->
          <h2 class="text-dark" >Activity By Sublueddit</h2>
          <p class="text-dark" >This month's activity.</p>
          <p style="align:center;"><canvas  id="chartjs_bar2"></canvas></p>
          <?php
            if ($error != null) {
              echo "<p>Unable to reach the database!</p>";
            } else {
              $sql = "SELECT COUNT(*) AS monthlyActivity, title FROM usageTracking u INNER JOIN sublueddits s ON u.sid = s.sid
              WHERE MONTH(entryDate) = MONTH(CURDATE()) AND YEAR(entryDate) = YEAR(CURDATE()) GROUP BY u.sid
              ORDER BY COUNT(*) DESC LIMIT 10";
              $result = mysqli_query($conn, $sql);
              echo mysqli_error($conn);
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $subs[] = $row['title'];
                $subsActivity[] = $row['monthlyActivity'];
              }
            }
          ?>

          <script type="text/javascript">
            var ctx = document.getElementById("chartjs_bar2").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels:<?php echo json_encode($subs); ?>,
                datasets: [{
                  label: 'Sublueddit Interactions',
                  backgroundColor: [
                    "#00B5EE"
                  ],
                  data:<?php echo json_encode($subsActivity); ?>,
                }]
              },
              options: {
                legend: {
                  display: true,
                  position: 'bottom',
                  labels: {
                    fontColor: '#ffffff',
                    fontFamily: 'Circular Std Book',
                    fontSize: 14,
                  }
                },
          
              }
            });
          </script>
        </div>

      </div>
    </div>
  </body>
</main>

</html>