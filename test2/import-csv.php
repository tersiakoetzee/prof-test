<?php

function importCSV($filePath) {

    $db = new SQLite3('sqlite/database.db');

    // Creating a table if it does not exist
    $db->exec("CREATE TABLE IF NOT EXISTS csv_import (
        Id INTEGER PRIMARY KEY, 
        Name TEXT, 
        Surname TEXT, 
        Initials TEXT, 
        Age INTEGER, 
        DateOfBirth TEXT)");

    if (($handle = fopen($filePath, 'r')) !== FALSE) {
        fgetcsv($handle); 
        
        // Loop through the rows in the CSV file
        while (($row = fgetcsv($handle)) !== FALSE) {
            // SQL insert statement
            $stmt = $db->prepare("INSERT INTO csv_import (Id, Name, Surname, Initials, Age, DateOfBirth) VALUES (?, ?, ?, ?, ?, ?)");
            // Bind the CSV data to the SQL statement
            $stmt->bindValue(1, $row[0], SQLITE3_INTEGER);
            $stmt->bindValue(2, $row[1], SQLITE3_TEXT);
            $stmt->bindValue(3, $row[2], SQLITE3_TEXT);
            $stmt->bindValue(4, $row[3], SQLITE3_TEXT);
            $stmt->bindValue(5, $row[4], SQLITE3_INTEGER);
            $stmt->bindValue(6, $row[5], SQLITE3_TEXT);
            $stmt->execute(); // Execute the SQL query
        }

        fclose($handle); 
        echo "CSV file imported successfully.\n"; // Output success message

        // Count the number of records imported
        $result = $db->query("SELECT COUNT(*) AS count FROM csv_import");
        $row = $result->fetchArray();
        echo "Total records imported: " . $row['count'] . "\n"; // Output record count
    } else {
        echo "Failed to open the CSV file.\n"; // Error message if file fails to open
    }
}

?>
