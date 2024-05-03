<?php
//Connection Function
function connect_db($username, $password) {
    try {
        $dsn = "mysql:host=courses;dbname=z2003886";
        return new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

$username = 'z2003886';
$password = '2001Dec13';
$pdo = connect_db($username, $password);

//Free Queue Functiuon
function fetch_free_queue($pdo) {
    $query = "SELECT KFile.Song, Singer.SingerName, KFile.Version, Artist.ArtistName 
              FROM Queue 
              JOIN KFile ON Queue.KFileID = KFile.KFileID 
              JOIN Singer ON Queue.SingerID = Singer.SingerID 
              JOIN Song ON KFile.SongID = Song.SongID
              JOIN Artist ON Song.ArtistID = Artist.ArtistID";
    $st = $pdo->prepare($query);
    $st->execute();
    return $st->fetchAll(PDO::FETCH_ASSOC);
}

//Paid Queue Function
function fetch_paid_queue($pdo) {
    $query = "SELECT KFile.Song, Singer.SingerName, QueuePaid.Paid, KFile.Version, Artist.ArtistName 
              FROM QueuePaid 
              JOIN KFile ON QueuePaid.KFileID = KFile.KFileID 
              JOIN Singer ON QueuePaid.SingerID = Singer.SingerID 
              JOIN Song ON KFile.SongID = Song.SongID 
              JOIN Artist ON Song.ArtistID = Artist.ArtistID 
              ORDER BY QueuePaid.Paid DESC";
    $st = $pdo->prepare($query);
    $st->execute();
    return $st->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DJ Interface</title>
    <style>
    
        .top {
            color: green;
            text-align: center;
        }

        .queue-section {
            margin-bottom: 20px;
        }

        .queue-table {
            width: 100%;
            border-collapse: collapse;
        }

        .queue-table th, .queue-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .queue-table th {
            background-color: #f5f5f5;
            cursor: pointer;
        }

        
    </style>
</head>
<body>
    <h1 class="top">DJ Interface</h1>
    <button onclick="window.location.href = 'index.php';">Go back</button>

    <div class="queue-section">
        <h2>Free Queue</h2>
        <?php
            $rows = fetch_free_queue($pdo);
            echo "<table class='queue-table'>";
            echo "<thead><tr><th>#</th><th>Song</th><th>Artist</th><th>Singer</th><th>Version</th></tr></thead>";
            echo "<tbody>";
            $count = 1;
            foreach ($rows as $row) {
                echo "<tr><td>$count</td><td>{$row['Song']}</td><td>{$row['ArtistName']}</td><td>{$row['SingerName']}</td><td>{$row['Version']}</td></tr>";
                $count++;
            }
            echo "</tbody></table>";
        ?>
    </div>

    <div class="queue-section">
        <h2>Paid Queue</h2>
        <?php
            $rows = fetch_paid_queue($pdo);
            echo "<table class='queue-table'>";
            echo "<thead><tr><th>#</th><th>Song</th><th>Artist</th><th>Singer</th><th>Version</th><th>Paid</th></tr></thead>";
            echo "<tbody>";
            $count = 1;
            foreach ($rows as $row) {
                echo "<tr><td>$count</td><td>{$row['Song']}</td><td>{$row['ArtistName']}</td><td>{$row['SingerName']}</td><td>{$row['Version']}</td><td>\${$row['Paid']}</td></tr>";
                $count++;
            }
            echo "</tbody></table>";
        ?>
    </div>
</body>
</html>
