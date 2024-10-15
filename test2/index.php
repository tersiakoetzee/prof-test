<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'num_records' is set and is a valid number
    if (isset($_POST['num_records']) && is_numeric($_POST['num_records'])) {
        $num_records = intval($_POST['num_records']); // Get the number of records as an integer
        include 'generate-csv.php'; // Include the file that generates the CSV
        generateCSV($num_records); // Call the function to generate CSV with the specified number of records
    } else {
        echo "Please enter a valid number."; // Error message if input is invalid
    }
}
?>

<!-- HTML form for submitting the number of records -->
<form action="index.php" method="POST">
    <label for="num_records">Number of Records:</label>
    <input type="number" name="num_records" min="1" required>
    <button type="submit">Generate CSV</button>
</form>

