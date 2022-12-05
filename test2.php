<?php
if($_POST){
    $limit = 6;
    $keyword = $_POST['search'];
    $apikey = 'AIzaSyAWQlfF14yjAXjIKLKraCy9z5njE2rh-eE'; 
    $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=' . $limit . '&key=' . $apikey;


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response, true);
    $items = json_decode(json_encode($data), true);
    
    foreach ($data['items'] as $item){
        $videoId = $item['id']['videoId'];
        $videoTitle = $item['snippet']['title'];
        $videoDescription = $item['snippet']['description'];
        
?>
 
 <iframe width="420" height="345" src="https://www.youtube.com/embed/<?php echo $videoId;?>">
</iframe>
Title: <?php echo $videoTitle; ?>
Description: <?php echo $videoDescription; ?>

<?php
    }
    



}
    
?>




<!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- The form -->
<form class="example" action="" method="post" enctype="multipart/form-data">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>