<?php

// Function to generate a CSV file with a given number of records
function generateCSV($num_records) {
    // Arrays of possible names and surnames
    $names = ["Sean", "Sasha", "John", "Michael", "David", "Emma", "Sophia", "Olivia", "Ethan", "James", "Benjamin", "Aiden", "Lucas", "Mason", "Jackson", "Henry", "Jacob", "William", "Daniel", "Elijah","Tersia"];
    $surnames = ["Pompeii", "Hall", "Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller", "Wilson", "Moore", "Taylor", "Anderson", "Thomas", "Jackson", "White", "Harris", "Martin", "Thompson", "Garcia"];

    $file = fopen('output/output.csv', 'w');
    
    // Add the header row to the CSV, only including DateOfBirthISO
    fputcsv($file, ['Id', 'Name', 'Surname', 'Initials', 'Age', 'Date Of Birth']);
    
    $generatedData = []; // Track generated records to avoid duplicates

    // Loop through and generate the specified number of records
    for ($i = 1; $i <= $num_records; $i++) {
        do {
            // Randomly select a name and surname
            $name = $names[array_rand($names)];
            $surname = $surnames[array_rand($surnames)];
            $age = rand(18, 80); // Generate a random age
            
            // Calculate date of birth in ISO format for MongoDB
            $dobISO = date("Y-m-d", strtotime("-$age years")); // ISO format for MongoDB
            $initials = strtoupper(substr($name, 0, 1)); // Get the first letter of the name
            
            // Create a unique key for the record to ensure no duplicates
            $key = $name . $surname . $age . $dobISO;
        } while (in_array($key, $generatedData)); // Repeat if the record already exists
        
        $generatedData[] = $key; // Store the generated record's unique key
        
        // Write the data row into the CSV, excluding the non-ISO date
        fputcsv($file, [$i, $name, $surname, $initials, $age, $dobISO]);
    }

    fclose($file);
    
    echo "CSV file generated with $num_records records.\n"; // Output success message
}



