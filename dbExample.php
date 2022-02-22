<?php

////////////////////////////////////
#MySQLi Object-Oriented Example DB

#The i in MySQLi Stands for Improved
////////////////////////////////////

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "MyDB";

//Create connection
$connection = mysqli($servername, $username, $password);

//Check if the connection was successful
if($connection->connect_error)
{
    die("Connection failed: ".$connection->connect_error);
}
echo "Connection was successful";

//Create the DB:
$sqlDB = "Create Database MyDB";
if($connection->query($sqlDB) === TRUE){
    echo "Database MyDB successfully created";
} else {
    echo "Database MyDB failed in its creation: ".$connection->error;
}

//sql create the DB Table:

$sql = "CREATE TABLE Clients (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    middlename VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAUL CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

//SQL insert into table
$sql = "INSERT INTO Clients (firstname, middlename, lastname, email)"
VALUES ('','','','');

//SQL Selection into the table Values
$sql = "SELECT firstname, middlename, lastname, email FROM Clients ORDER BY lastname";
$result = $connection->query($sql);

//Delete data from the  DB
if ($connection->query($sql)===TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: ".$sql ."<br>" .$connection->error;
}

//Validate the connection with the main server
if($connection->query($sql)===TRUE) {
    $last_id = $connection->insert_id;
    echo "New record created successfully. Last inserted ID is: "
    . $last_id;
} else {
    echo "Error: ".$sql ."<br>" .$connection->error;
}

//Update each time a record is created or added
if ($connection->multi_query($sql)===TRUE){
    echo "New record created successfully";
} else {
    echo "Error: ".$sql ."<br>" .$connection->error;
}

//Check for each VALUE set in each row of the table
if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        echo "id: " .$row["id"] . " - Name: ". $row["firstname"] . " ".$row["middlename"] . " ".$row["lastname"] . "<br>";
    }
} else {
    echo "0 results in your query";
}

$stmt = connection->prepare("INSERT INTO Clients(firstname, middlename, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);

$firstname = "John";
$lastname = "Doe";
$email = "john@example.com";
$stmt->execute();

$firstname = "Mary";
$lastname = "Moe";
$email = "mary@example.com";
$stmt->execute();

$firstname = "Julie";
$lastname = "Dooley";
$email = "julie@example.com";
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$connection->close();
?>