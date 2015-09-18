<?php 
$page_title = 'Browse the Prints';
include ('includes/header.php');
include ('includes/helperFunctions.php'); 
$sql = "SELECT prints.*,artists.artists_id,CONCAT_WS(' ', first_name, middle_name, last_name) AS artist FROM prints AS prints
        JOIN artists ON prints.artist_id = artists.artists_id WHERE prints.available = 1 ORDER BY prints.print_id ASC ";
if(isset($_GET['aid']) && is_numeric($_GET['aid'])){
    $aid = (int) $_GET['aid'];
    if ($aid > 0) {
        $sql = "SELECT prints.*,artists.artists_id,CONCAT_WS(' ', first_name, middle_name, last_name) AS artist FROM prints AS prints
                JOIN artists ON prints.artist_id = artists.artists_id WHERE prints.available = 1 AND artists.artists_id = $aid ORDER BY prints.print_id ASC ";	
    }
}
$conn = connection();
$results = returnResults($conn,$sql);
if(is_array($results)){
    echo '<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
        <tr>
                <td align="left" width="20%"><b>Artist</b></td>
                <td align="left" width="20%"><b>Print Name</b></td>
                <td align="left" width="20%"><b>Size</b></td>
                <td align="left" width="40%"><b>Description</b></td>
                <td align="right" width="20%"><b>Price</b></td>
        </tr>';
    foreach($results as $row){
        echo "\t<tr>
            <td align=\"left\"><a href=\"browse_prints.php?aid={$row['artist_id']}\">{$row['artist']}</a></td>
            <td align=\"left\"><a href=\"view_print.php?pid={$row['print_id']}\">{$row['print_name']}<br>";
            $image = getImage($row['file_path']);
            echo "<img src=\"{$image}\" alt=\"{$row['print_name']}\" height=\"42\" width=\"42\"/>";
        echo "</a></td>
            <td align=\"left\">".((is_null($row['size'])) ? '(No size available)' : $row['size'])."</td>
            <td align=\"left\">{$row['description']}</td>
            <td align=\"right\">\${$row['price']}</td>
        </tr>\n";
    }
    echo '</table>';
}else{
    echo "<div align=\"center\">{$results}</div>";
}
include ('includes/footer.php');