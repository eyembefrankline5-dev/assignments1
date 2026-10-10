<?php
$host = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=hospital_db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Patients
    $pdo->exec("INSERT IGNORE INTO patients (id, first_name, last_name, gender, dob, phone, email, address) VALUES 
        (1, 'John', 'Doe', 'Male', '1985-04-12', '555-0101', 'john@example.com', '123 Main St'),
        (2, 'Mary', 'Johnson', 'Female', '1990-08-22', '555-0202', 'mary@example.com', '456 Oak Ave'),
        (3, 'David', 'Brown', 'Male', '1975-11-05', '555-0303', 'david@example.com', '789 Pine Rd')
    ");

    // Doctors
    $docHash1 = password_hash('pass123', PASSWORD_DEFAULT);
    $docHash2 = password_hash('pass123', PASSWORD_DEFAULT);
    $docHash3 = password_hash('pass123', PASSWORD_DEFAULT);
    
    $pdo->exec("INSERT IGNORE INTO doctors (id, full_name, specialization, email, password_hash, phone) VALUES 
        (1, 'Dr. Sarah Smith', 'Cardiology', 'smith@hospital.com', '$docHash1', '555-1111'),
        (2, 'Dr. Robert Williams', 'Neurology', 'williams@hospital.com', '$docHash2', '555-2222'),
        (3, 'Dr. Emily Adams', 'Pediatrics', 'adams@hospital.com', '$docHash3', '555-3333')
    ");

    // Appointments
    $pdo->exec("INSERT IGNORE INTO appointments (id, patient_id, doctor_id, appointment_date, status) VALUES 
        (1, 1, 1, '2026-09-17 10:00:00', 'Confirmed'),
        (2, 2, 2, '2026-09-18 14:30:00', 'Pending'),
        (3, 3, 3, '2026-09-19 09:15:00', 'Confirmed')
    ");

    // Medicines
    $pdo->exec("INSERT IGNORE INTO medicines (id, name, category, price, stock_quantity, expiry_date) VALUES 
        (1, 'Amoxicillin', 'Antibiotic', 15.50, 200, '2028-01-01'),
        (2, 'Lisinopril', 'Blood Pressure', 25.00, 150, '2027-06-15'),
        (3, 'Ibuprofen', 'Pain Relief', 8.99, 500, '2029-12-31')
    ");

    echo "Sample data seeded successfully!\n";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
