<?php

   # Add your RSS feed here
   $rss = simplexml_load_file('https://ekuriren.se/rss/lokalt');

   function contains($str, array $arr)
   {
       foreach($arr as $a) {
           if (stripos($str,$a) !== false) return true;
       }
       return false;
   }

   # $filterarray contains keywords to filter by, posts with titles containing these will be skipped
   $filterarray = array("försäljningen av", "nya ägare", "har bytt ägare", "kvadratmeter stort", "kvadratmeter sålt", "köpt huset på", "sålt för", "sålt till", "ny ägare", "ny butik", "butik lägger ner", "nytt företag", "nytt konstultföretag", "nytt bolag", "firma startad", "firma startar");
   
   header('Content-type: text/xml');

   echo '<rss version="2.0"><channel><title>' . $rss->channel->title . '</title><link>https://www.ekuriren.se/</link><description/>';

   foreach ($rss->channel->item as $item) {
      # $item->title can be changed if you want to filter some other field
      if (!contains($item->title, $filterarray)) { 
         echo "<item><title>" . $item->title . "</title>";
         echo "<description>" . $item->description . "</description>";
         echo "<pubDate>" . $item->pubDate . "</pubDate></item>";
      }
   }

   echo "</channel></rss>";

?>
