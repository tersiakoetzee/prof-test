<?php

// Function to generate a CSV file with a given number of records
function generateCSV($num_records) {
    // Arrays of possible names and surnames
    $names = ["Sean", "Sasha", "John", "Michael", "David", "Emma", "Sophia", "Olivia", "Ethan", "James", "Benjamin", "Aiden", "Lucas", "Mason", "Jackson", "Henry", "Jacob", "William", "Daniel", "Elijah"];
    $surnames = ["Pompeii", "Hall", "Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller", "Wilson", "Moore", "Taylor", "Anderson", "Thomas", "Jackson", "White", "Harris", "Martin", "Thompson", "Garcia"];

    // Open a file to write data (creates a new file or overwrites if exists)
    $file = fopen('output/output.csv', 'w');
    
    // Add the header row to the CSV
    fputcsv($file, ['Id', 'Name', 'Surname', 'Initials', 'Age', 'DateOfBirth']);
    
    $generatedData = []; // To track generated records and avoid duplicates

    // Loop through and generate the specified number of records
    for ($i = 1; $i <= $num_records; $i++) {
        do {
            // Randomly select a name and surname
            $name = $names[array_rand($names)];
            $surname = $surnames[array_rand($surnames)];
            $age = rand(18, 80); // Generate a random age
            $dob = date("d/m/Y", strtotime("-$age years")); // Calculate date of birth based on age
            $initials = strtoupper(substr($name, 0, 1)); // Get the first letter of the name
            
            // Create a unique key for the record to ensure no duplicates
            $key = $name . $surname . $age . $dob;
        } while (in_array($key, $generatedData)); // Repeat if the record already exists
        
        $generatedData[] = $key; // Store the generated record's unique key
        
        // Write the data row into the CSV
        fputcsv($file, [$i, $name, $surname, $initials, $age, $dob]);
    }

    // Close the file after writing
    fclose($file);
    
    echo "CSV file generated with $num_records records.\n"; // Output success message
}

?>

