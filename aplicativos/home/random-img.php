<?php
function random_img(){
	$rndnum = rand(0, 9);

	switch ($rndnum) {
		case 0:
			$img = "http://farm4.static.flickr.com/3642/3585850272_2acbf50734.jpg";
			$nomemini = "mini-rik";
        	break;
		case 1:
			$img = "http://farm4.static.flickr.com/3361/3585051647_0f33d965c7.jpg";
			$nomemini = "mini-luciano";
      	break;
		case 2:
			$img = "http://farm4.static.flickr.com/3661/3585856544_3683eca0c2.jpg";
			$nomemini = "mini-leo";
        	break;		
		case 3:
			$img = "http://farm4.static.flickr.com/3316/3585855394_d27bbbcc03.jpg";
			$nomemini = "mini-talita";
        	break;
		case 4:
			$img = "http://farm4.static.flickr.com/3380/3585853936_60a938e287.jpg";
			$nomemini = "mini-julia cabral";
        	break;
		case 5:
			$img = "http://farm4.static.flickr.com/3568/3585045837_710a4c7919.jpg";
			$nomemini = "mini-ju";
        	break;
		case 6:
			$img = "http://farm4.static.flickr.com/3391/3585041927_bb7513e514.jpg";
			$nomemini = "mini-gigi";
        	break;
		case 7:
			$img = "http://farm4.static.flickr.com/3622/3585846520_db4cd6afea.jpg";
			$nomemini = "mini-bispo";
        	break;
		case 8:
			$img = "http://farm4.static.flickr.com/3660/3585844696_c45f008b49.jpg";
			$nomemini = "mini-samanta";
      	break;
		case 9:
			$img = "http://farm4.static.flickr.com/3662/3585842972_55ac115e3f.jpg";
			$nomemini = "mini-rodrigo (jacaré banguela)";
        	break;
	}
	echo "<img class='alignright' style='float:right;' src='$img' alt='$nomemini' />";
	echo "<br/><p style='float:right;color:#ccc;'>$nomemini</p>";
//echo $img;
//echo $nomemini;
}
?>