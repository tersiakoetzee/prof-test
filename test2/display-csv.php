<?php

$csvFile = 'output/output.csv'; 


if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    echo "<h1>CSV Data</h1>";
    echo "<table border='1'>"; // HTML table with borders

    // Loop through each row of the CSV file
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        echo "<tr>"; 
        foreach ($data as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";  // Output each cell in a table cell
        }
        echo "</tr>"; 
    }

    echo "</table>";  

    fclose($handle);
} else {
    echo "Error: Unable to open the file.";
}

// Back button to return to index.php
echo '<br><a href="index.php">Go Back</a>';
?>
