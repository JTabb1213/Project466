<?php //get a list of the kfiles upon loading the page so they can be used in the drop down menu later
    $songs = [];
    $username = 'z2003886';
    $password = '2001Dec13';
    try {
        $dsn = "mysql:host=courses;dbname=z2003886";
        $pdo = new PDO($dsn, $username, $password);
        $search = "SELECT * FROM KFile";
        $st = $pdo->prepare($search);
        $st->execute();
        $songs = $st->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    } 
?>

<html>
    <style>
        .top{
            color: green;
            text-align: center;
	    }
    </style>
    <head>
        <title>Queue</title>
        <link rel="stylesheet" href="queues.css">
        <link rel="stylesheet" href="buttons.css">
        <link rel="stylesheet" href="inputTextbox.css">
    </head>
    <body>
        <h1 class='top'>Queue</h1>
        <button class="button2" onclick="window.location.href = 'index.php';">Go back</button>
        <form method="post">
            <label for="signUpForQueue">To enter priority queue, you can pay (dollar amount only, no cents). Would you like to pay? Leave empty of type 0 if not</label>
            <input type="number" name="signUpForQueue" id="signUpForQueue">
            <br>

            <label for="enterFirstName">Enter first name:</label>
            <input type="text" name="enterFirstName" id="enterFirstName">
            <label for="enterLastName">Enter last name:</label>
            <input type="text" name="enterLastName" id="enterLastName">

            <br>

            <label for="selectSong">Select what song you want: </label>
            <select name="selectSong" id="selectSong">
                <?php
                    foreach($songs as $song) {
                        echo "<option value='".$song['Song']."'>".$song['Song']." version: ".$song['Version']."</option>";
                    }
                ?>
            </select>
            <br>
            <div class="bottomButtonContainer">
                <button class="btn btn-rect-to-round btn-rect-to-round--blue" type="submit" name="signUp">Sign up for queue</button>
            </div>
        </form>

        <div class="bottomButtonContainer">
            <form method="post">
                <button class="btn btn-rect-to-round btn-rect-to-round--blue" type="submit" name="viewQueueFree">View free queue</button>
            </form>

            <form method="post">
                <button class="btn btn-rect-to-round btn-rect-to-round--blue" type="submit" name="viewQueuePaid">View paid queue</button>
            </form>
        </div>
        <?php
            if(isset($_POST['viewQueueFree'])){
                $username = 'z2003886';
                $password = '2001Dec13';
                try {
                    $dsn = "mysql:host=courses;dbname=z2003886";
                    $pdo = new PDO($dsn, $username, $password);
                    //$search = "SELECT * FROM Queue;";
                    $search = "SELECT KFile.Song, Singer.SingerName, KFile.Version FROM Queue JOIN KFile ON Queue.KFileID = KFile.KFileID JOIN Singer ON Queue.SingerID = Singer.SingerID";
                    $res = $pdo->prepare($search);
                    $res->execute();
                    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
                    echo "<div>Free queue: </div>";
                    $count = 1;
                    foreach ($rows as $row){
                        echo "<div class='freeQueueList'>$count. {$row['Song']}, performed by: {$row['SingerName']}, Version: {$row['Version']}</div>";
                        echo "<br>";
                        $count++;
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                } 
            }

            if(isset($_POST['viewQueuePaid'])){
                $username = 'z2003886';
                $password = '2001Dec13';
                try {
                    $dsn = "mysql:host=courses;dbname=z2003886";
                    $pdo = new PDO($dsn, $username, $password);
                    $search = "SELECT KFile.Song, Singer.SingerName, QueuePaid.Paid, KFile.Version FROM QueuePaid JOIN KFile ON QueuePaid.KFileID = KFile.KFileID JOIN Singer ON QueuePaid.SingerID = Singer.SingerID GROUP BY QueuePaid.Paid DESC";
                    $res = $pdo->prepare($search);
                    $res->execute();
                    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
                    $rowCount = count($rows);
                    echo "<div>Paid queue: </div>";
                    $count = 1;
                    foreach ($rows as $row){
                        echo "<div class='paidQueueList'>$count. {$row['Song']}, performed by: {$row['SingerName']}, Version: {$row['Version']}, paid: $" . $row['Paid'] . "</div>";
                        echo "<br>";
                        $count++;
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                } 
            }

            if(isset($_POST['signUp'])){
                $username = 'z2003886';
                $password = '2001Dec13';
                try {
                    $dsn = "mysql:host=courses;dbname=z2003886";
                    $pdo = new PDO($dsn, $username, $password);
                    $firstName = $_POST['enterFirstName'];
                    $lastName = $_POST['enterLastName'];
                    if(empty($firstName) || empty($lastName)){
                        echo "<div class='firstLastNameError'>First or last name cannot be empty!</div>";
                        throw new Exception("First or last name cannot be empty!");
                    }
                    $paid = $_POST['signUpForQueue'];
                    $selectedSong = $_POST['selectSong'];
                    $name = $firstName . ' ' . $lastName;
                    $search = "SELECT * FROM Singer WHERE SingerName = ?";
                    $st = $pdo->prepare($search);
                    $st->execute([$name]);
                    $response = $st->fetch();
                    $rowCount = $st->rowCount();
                    if($rowCount === 0){
                        $insert = "INSERT INTO Singer (SingerName) VALUES (?);";
                        $stm = $pdo->prepare($insert);
                        $stm->execute([$name]);
                    }
                    
                    $search = "SELECT SingerID FROM Singer WHERE SingerName = ?";
                    $st = $pdo->prepare($search);
                    $st->execute([$name]);
                    $SingerID = $st->fetch();
                    
                    $search = "SELECT KFileID FROM KFile WHERE Song = ?";
                    $st = $pdo->prepare($search);
                    $st->execute([$selectedSong]);
                    $KFileIDSearch = $st->fetch();
                    if(empty($paid) || $paid === 0){
                        $insert = "INSERT INTO Queue (SingerID, KFileID) VALUES (?, ?)";
                        $st = $pdo->prepare($insert);
                        $st->execute([$SingerID['SingerID'], $KFileIDSearch['KFileID']]);                        
                        echo "<div>You have entered the queue!</div>";
                    } else if ($paid < 0){
                        echo "<div class='firstLastNameError'>Paid amount cannot be negative!</div>";
                        throw new Exception("Paid amount cannot be negative!");
                    } else{
                        $insert = "INSERT INTO QueuePaid (Paid, SingerID, KFileID) VALUES (?, ?, ?)";
                        $st = $pdo->prepare($insert);
                        $st->execute([$paid, $SingerID['SingerID'], $KFileIDSearch['KFileID']]);                        
                        echo "<div>You have entered the paid queue!</div>";
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                } 
            }
        ?>
    </body>
</html>
