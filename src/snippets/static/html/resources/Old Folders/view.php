<? include "header.php"?>
    <section class="wrapper">
    	<div class="left">
        <? 
		if(!isset($_GET['id'])) {
			// Do something else, like enter a search through all your boards or something
			$shnipit_id = 1;
		} else {
			$shnipit_id = $_GET['id'];
		}
		
		$shnipit_id = escape($con, $shnipit_id);
	
		$result = mysqli_query($con, "SELECT `users`.`user`, `snippets`.`date`, `snippets`.`permalink`, `snippets`.`title`, `snippets`.`description`, `snippets`.`content`, `snippets`.`keywords`, `languages`.`language`, `snippets`.`private` FROM `snippets` LEFT JOIN `users` ON `snippets`.`user` = `users`.`id` LEFT JOIN `languages` ON `snippets`.`language` = `languages`.`id` WHERE `snippets`.`id` = '$shnipit_id';");
		
		if(mysqli_num_rows($result) == 0) {
			// No snippet found
		}
		
		while($fetch = mysqli_fetch_array($result)) {
			list($user, $date, $permalink, $title, $description, $content, $keywords, $language, $private) = $fetch;
		}
		?>
        
        <p>Snippet created by <?=$user?> at <?=$date?></p>
        <p>View Shnipit at <a href="http://www.shnip.it/<?=$permalink?>">www.shnip.it/<?=$permalink?></a></p>
        
        <pre class=<?="brush: " . $language . ";"?>><?=$content?></pre>
        
        <p>Language: <?=$language?></p>
        <p>Keywords: <?=$keywords?></p>
        
				<? if($private) {?><p>This snippet is private</p><? }?>
        
      	</pre>
      </div>
      <div class="right">
      	<h3><?=$title?></h3>
      	<p><?=$description?></p>
      </div>
      <div class="clear"></div>
    </section>
<? include "footer.php"?>