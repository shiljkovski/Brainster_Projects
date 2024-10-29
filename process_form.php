<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./css/main.css" />
  <script src="https://kit.fontawesome.com/27a957b448.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/27a957b448.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav>
    <div class="wrapper">
      <div class="logo center-div">
        <a href="./index.html"><img src="./Design/Logo.png" alt="logo" class="img-logo" />
          <p class="p-logo">brainster</p>
        </a>
      </div>
      <ul class="desktop-menu">
        <li>
          <a href="https://brainster.co/marketing/" target="_blank">Академија за маркетинг</a>
        </li>
        <li>
          <a href="https://brainster.co/full-stack/" target="_blank">Академија за програмирање</a>
        </li>
        <li>
          <a href="https://brainster.co/data-science/" target="_blank">Академија за data science</a>
        </li>
        <li>
          <a href="https://brainster.co/graphic-design/" target="_blank">Академија за дизајн</a>
        </li>
      </ul>
      <a href="./form.php" class="btn">Вработи наш студент</a>
      <div id="hamburger-icon" onclick="toggleMobileMenu(this)">
        <div class="hamburger">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
      </div>
      <ul id="mobile-menu" class="mobile-menu">
        <li>
          <a href="https://brainster.co/marketing/" target="_blank">Академија за маркетинг</a>
        </li>
        <li>
          <a href="https://brainster.co/full-stack/" target="_blank">Академија за програмирање</a>
        </li>
        <li>
          <a href="https://brainster.co/data-science/" target="_blank">Академија за data science</a>
        </li>
        <li>
          <a href="https://brainster.co/graphic-design/" target="_blank">Академија за дизајн</a>
        </li>
        <li><a href="./form.php" class="btn">Вработи наш студент</a></li>
      </ul>
    </div>
  </nav>
  <div class="table-container center-div">

    <?php
    $servername = "localhost";
    $username = "root";
    $dbname = "marko_project_one_db";

    $conn = new mysqli($servername, $username, "", $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $company = $_POST["company"];
      $email = $_POST["email"];
      $phone = $_POST["phone"];
      $academyType = $_POST["academy_type"];

      $sql_insert_values = "INSERT INTO companies (fullname, company, email, phone, academy_type) VALUES ('$name', '$company', '$email', '$phone', '$academyType')";
      if ($conn->query($sql_insert_values) !== TRUE) {
        echo "Error inserting values: " . $conn->error;
      }

    }
    $sql_select_all = "SELECT * FROM companies";
    $result = $conn->query($sql_select_all);

    if ($result->num_rows > 0) {
      echo "<h1>Your form was submited sucessfully!</h1>";
      echo "<table border='1'>
                    <tr>
                        <th>Име</th>
                        <th>Компанија</th>
                        <th>Емаил</th>
                        <th>Телефон</th>
                        <th>Тип на студенти</th>
                    </tr>";

      while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["fullname"] . '</td>';
        echo '<td>' . $row["company"] . '</td>';
        echo '<td>' . $row["email"] . '</td>';
        echo '<td>' . $row["phone"] . '</td>';
        echo '<td>' . $row["academy_type"] . '</td>';
        echo '</tr>';
      }

      echo '</table>';
    }
    $result->close();
    $conn->close();
    ?>



  </div>
  <footer>
    <p>Изработено со &#128147; од студентите на Brainster</p>
  </footer>

  <script src="form.js"></script>
</body>

</html>