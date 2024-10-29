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
  <div class="form-section">
    <h1>Вработи Студенти</h1>

    <?php

    $servername = "localhost";
    $username = "root";
    $dbname = "marko_project_one_db";

    $conn = new mysqli($servername, $username, "");

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql_create_db) !== TRUE) {
      echo "<h2 class='error_db'>Error creating database: " . $conn->error . "</h2>\n";
    }
    $conn->select_db($dbname);

    $sql_create_table = "CREATE TABLE IF NOT EXISTS companies (
          id INT(6) AUTO_INCREMENT PRIMARY KEY,
          fullname VARCHAR(30) NOT NULL,
          company VARCHAR(30) NOT NULL,
          email VARCHAR(50) NOT NULL,
          phone VARCHAR(50) NOT NULL,
          academy_type VARCHAR(50) NOT NULL
        )";
    if ($conn->query($sql_create_table) !== TRUE) {
      echo "<h2 class='error_db'>Error creating table companies: " . $conn->error . "</h2>\n";
    }

    function tableExists($conn, $tableName)
    {
      $sql = "SHOW TABLES LIKE '$tableName'";
      $result = $conn->query($sql);

      return ($result->num_rows > 0);
    }

    $tableName = "academy_type";

    if (!tableExists($conn, $tableName)) {
      $sql_create_table = "CREATE TABLE academy_type (
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        academy_type VARCHAR(50) NOT NULL
      )";
      if ($conn->query($sql_create_table) !== TRUE) {
        echo "<h2 class='error_db'>Error creating table of academies: " . $conn->error . "</h2>\n";
      }

      $sql_insert_values = "INSERT INTO academy_type (academy_type) VALUES ('Студент на маркетинг'), ('Студент на програмирање'), ('Студент на data science'), ('Студент на дизајн')";
      if ($conn->query($sql_insert_values) !== TRUE) {
        echo "Error inserting values in academy_type: " . $conn->error;
      }
    }


    ?>

    <form id="form" action="./process_form.php" method="post">
      <div class="form-wrapper">
        <div class="form-container">
          <div class="input-wrap">
            <label for="name">Име и презиме</label>
            <input type="text" id="name" name="name" placeholder="Вашето име и презиме" />
            <div class="error-msg" id="name-error">Внесете валиднo име!</div>
          </div>
        </div>
        <div class="form-container">
          <div class="input-wrap">
            <label for="company">Име на компанија</label>
            <input type="text" id="company" name="company" placeholder="Име на вашата компанија" />
            <div class="error-msg" id="company-error">
              Внесете валидно име на комапнија!
            </div>
          </div>
        </div>
        <div class="form-container">
          <div class="input-wrap">
            <label for="email">Контакт имејл</label>
            <input type="email" id="email" name="email" placeholder="Контакт имејл на вашата компанија" />
            <div class="error-msg" id="email-error">
              Внесете валидна email адреса!
            </div>
          </div>
        </div>
        <div class="form-container">
          <div class="input-wrap">
            <label for="phone">Контакт телефон</label>
            <input type="tel" id="phone" name="phone" placeholder="Контакт телефон на вашата компанија" />
            <div class="error-msg" id="phone-error">
              Внесете валиден телефонски број!
            </div>
          </div>
        </div>
        <div class="form-container">
          <div class="input-wrap">
            <label for="academy_type">Тип на студенти</label>
            <?php
            $sql_select_all = "SELECT * FROM academy_type";
            $result = $conn->query($sql_select_all);

            if (mysqli_num_rows($result) > 0) {
              echo "<select name='academy_type' id='academy-type'>
                          <option value='default' selected disabled hidden>
                            <b>Одберете тип на студент</b>
                          </option>";
              while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['academy_type'] . "'>" . $row['academy_type'] . "</option>";
              }
              echo "</select>";
            }
            $result->close();
            $conn->close();
            ?>
            <div class="error-msg" id="student-error">
              Одберете тип на студент!
            </div>
          </div>
        </div>
        <div class="form-container center-div">
          <div class="input-wrap">
            <button type="submit" class="btn">ИСПРАТИ</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <footer>
    <p>Изработено со &#128147; од студентите на Brainster</p>
  </footer>

  <script src="form.js"></script>
</body>

</html>