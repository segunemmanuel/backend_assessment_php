<!DOCTYPE html>
 <html>
 

 <form method="post">
     <input type="text" name="link">
     <input type="submit" name="submit">
 </form>
      





<?php

if(isset($_POST['submit'])){

$link=$_POST['link'];



function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$html = file_get_contents_curl($link);

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');
$nodess = $doc->getElementsByTagName('head');
$nodesss = $doc->getElementsByTagName('body');


//get and display what you need:
$title = $nodes->item(0)->nodeValue;
$description = $nodess->item(0)->nodeValue;
$keywords = $nodesss->item(0)->nodeValue;


$metas = $doc->getElementsByTagName('meta');

for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'keywords')
        $keywords = $meta->getAttribute('content');
}

echo "<h1> Title: $title </h1>". '<br/><br/>';
echo "Description: $description". '<br/><br/>';
echo "Keywords: $keywords";

}


?>