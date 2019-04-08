
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>enjelhutasoit.com: Registration Form</title>
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h1 id="title">Registration Form</h1>
  <div id="form-outer">
  <p id="description">Let me know how I can improve my blog <strong>enjelhutasoit.com</strong>.</p>
  <p>First, fill in your name, email, age, and job, then click <strong>Submit</strong> to register.</p>
  
  <form id="survey-form" method="post" action="index.php" enctype="multipart/form-data">  
    <div class="rowTab">
      <div class="labels">
        <label input type="text" name="name" id="name">* Name: </label>
      </div>
      <div class="rightTab">
        <input autofocus type="text" name="name" id="name" class="input-field" placeholder="Enter your name" required>
      </div>
    </div>
    
    <div class="rowTab">
      <div class="labels">
        <label input type="text" name="email" id="email">* Email: </label>
      </div>
      <div class="rightTab">
        <input type="email" name="email" id="email" class="input-field" required placeholder="Enter your email">
      </div>
    </div>
    <div class="rowTab">
      <div class="labels">
        <label input type="text" name="email" id="email">* Job: </label>
      </div>
      
      <div class="rightTab">
        <input type="text" name="job" id="job" class="input-field" required placeholder="Enter your job">
      </div>
    </div>
    
    <div class="rowTab">
      <div class="labels">
        <label input type="int" name="age" id="age" id="number-label" for="age">* Age: </label>
      </div>
      <div class="rightTab">
        <input type="number" name="age" id="number" min="1" max="125" class="input-field" placeholder="Age">

    
    <button class="submit" type="submit" name="submit" value="Submit">Submit</button> 
    <button class="submit" type="submit" name="load_data" value="Load Data">Load Data</button>
     
  </form>
    </div>
  
  
<?php
    $host = "<Nama server database Anda>";
    $user = "<Nama admin database Anda>";
    $pass = "<Password admin database And>";
    $db = "<Nama database Anda>";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
    if (isset($_POST['submit'])) {
        try {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $job = $_POST['job'];
            $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO Registration (name, email, job, date) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $job);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>People who are registered:</h2>";
                echo "<table>";
                echo "<tr><th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Job</th>";
                echo "<th>Date</th></tr>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['name']."</td>";
                    echo "<td>".$registrant['email']."</td>";
                    echo "<td>".$registrant['job']."</td>";
                    echo "<td>".$registrant['date']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
</body>
</html>
