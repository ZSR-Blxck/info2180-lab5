<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

filter_var($_GET['country'],FILTER_SANITIZE_STRING);
$country= $_GET['country'];

if(isset($country)==true && isset($_GET['context'])==false){
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $dataTable = '<div>
            <table style="padding: 20px; margin: auto; width:80%;">
                <thead style= "text-align:left;">
                    <tr style= "font-size: 13px;font-family: Gill-Sans;">
                    <th>Name</th>  
                    <th>Continent</th>
                    <th>Indepence</th>
                    <th>Head of State</th>
                    </tr>
              </thead>';
            
                foreach ($results as $row)
                {
                   $dataTable .=  '<tr style="font-family: Gill-sans; font-size: 13px;"><td>'. $row['name'] . '</td><td>' . $row['continent'] .'</td><td>' . $row['independence_year'] .'</td><td>' . $row['head_of_state'] .'</td></tr>';
                }
                $dataTable .= '</tbody></table></div>'; 
                echo $dataTable;
    }
    elseif(isset($country)==true && isset($_GET['context'])==true){
  $stmt = $conn->query("SELECT cities.name, cities.district,cities.population FROM countries INNER JOIN cities ON countries.code = cities.country_code WHERE countries.name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $dataTable = '<div>
            <table style="padding: 20px; margin: auto; width:80%;">
                <thead style= "text-align:left;">
                    <tr style= "font-size: 13px;font-family: Gill-Sans;">
                    <th>Name</th>  
                    <th>District</th>
                    <th>Population</th>
                    </tr>
              </thead>';
            
                foreach ($results as $row)
                {
                   $dataTable .=  '<tr style="font-family: Gill-sans; font-size: 13px;"><td>'. $row['name'] . '</td><td>' . $row['district'] .'</td><td>' . $row['population'] .'</td></tr>';
                }
                $dataTable .= '</tbody></table></div>'; 
                echo $dataTable;
    }
    else{
      echo 'Whoa There, Please check input';
    }
?>
