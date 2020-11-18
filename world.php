<?php
header('Access-Control-Allow-Origin: *'); 
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country=$_GET['country'];
$context=$_GET['context'];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if ($context=='none'){
  $stmt = $conn->query("SELECT * FROM countries WHERE NAME LIKE '%$country%'");
}else if($context=='cities'){
  $stmt = $conn->query("SELECT cities.name,cities.district,cities.population FROM countries JOIN cities ON countries.code=cities.country_code WHERE countries.name LIKE '%$country%'");

}
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php  if($context=='none'){ ?>
  <table >
    <thead>
      <tr>
        <th>Name </th>
        <th >Continent </th>
        <th>Independence </th>
        <th>Head Of State </th>
      </tr>
    </thead> 
  <?php foreach ($results as $row): ?>
    <tbody>
      <tr>
        <td> <?= $row['name']; ?></td>
        <td> <?= $row['continent'] ?></td>
        <td> <?= $row['independence_year'] ?></td>
        <td> <?= $row['head_of_state'] ?></td>
      </tr>
    </tbody>
  <?php endforeach; ?>
<?php }else if ($context=='cities'){ ?>
    <table>
    <thead>
      <tr>
        <th>Name </th>
        <th>District </th>
        <th>Population </th>
      </tr>
    </thead> 
  <?php foreach ($results as $row): ?>
    <tbody>
      <tr>
        <td> <?= $row['name']; ?></td>
        <td> <?= $row['district'] ?></td>
        <td> <?= $row['population'] ?></td>
      </tr>
    </tbody>
  <?php endforeach; ?>
<?php }?>
  </table>
