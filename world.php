<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
//$stmt = $conn->query("SELECT * FROM countries");

//$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$action = 'default';
if (isset($_GET['country'])) {
    $action = 'search_country';
}

switch ($action) {
    case 'search_country':
        $country = $_GET['country'];
        // Prepare the SQL statement with a placeholder for the country name
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        // Use '%' wildcards for partial matching, and bind the country name to the placeholder
        $country = "%$country%";
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        // Execute the prepared statement
        $stmt->execute();
        // Fetch the results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        break;

    default:
        // If 'country' GET variable is not set, select all countries
        $stmt = $conn->query("SELECT * FROM countries");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        break;
}
function generateTableRow($row) {
  return '<tr>'
       . '<td>' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '</td>'
       . '<td>' . htmlspecialchars($row['continent'], ENT_QUOTES, 'UTF-8') . '</td>'
       . '<td>' . htmlspecialchars($row['independence_year'], ENT_QUOTES, 'UTF-8') . '</td>'
       . '<td>' . htmlspecialchars($row['head_of_state'], ENT_QUOTES, 'UTF-8') . '</td>'
       . '</tr>';
}

// Assuming $results is already populated with the query results
$tableRows = array_map('generateTableRow', $results);

// Construct the full table
$table = '<table>'
     . '<tr>'
     . '<th>Country Name</th>'
     . '<th>Continent</th>'
     . '<th>Independence Year</th>'
     . '<th>Head of State</th>'
     . '</tr>'
     . implode("\n", $tableRows)
     . '</table>';

echo $table;

?>
<!-- <ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul> -->
