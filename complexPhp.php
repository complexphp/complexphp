<?php

	
	$a=array();
	$b=array();

	$servername = "localhost"; 
	$username = "root"; 
	$password = ""; 
	$dbname = "";
	$isComplex = true;

	$complex_engine = false;
	$reComplex_engine = false;

	$complexInfo = ["version" => "1.0", "connection"=>"true"];

	function complexPhp($x="")
	{
		global $complexInfo;
		if(array_key_exists($x,$complexInfo))
		{
			return $complexInfo[$x];
		}else
		{
			return "ComplexPhp Version 1.0";
		}
	}


	// Sql Functions
	

	function setDefaultConn($server="localhost", $un="root", $pwd="", $db="")

	{

		global $servername;
		global $username;
		global $password;
		global $dbname;

		$servername = $server;
		$username = $un;
		$password = $pwd;
		$dbname= $db;


		$connx = new mysqli($servername, $username, $password, $dbname);

		
		if ($connx->connect_error) {
		  die("Connection failed: " . $connx->connect_error);
		}





		
	}


	function fetch($sql, $fetch, $error="", $con="")
	{

		global $servername;
		global $username;
		global $password;
		global $dbname;



		if($con == ""){
			exitIF($dbname, "Database name is null, Use setDefaultConn() or newSqli() ");

			$conn = new mysqli($servername, $username, $password, $dbname);

		}else
		{
			$conn = $con;
		}
		
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  	


		  while($row = $result->fetch_assoc()) {

		  	


		  	

			$fetch($row);

		    
		  
		  }

		} 
		else 
		{


			if ($error != "") {
        		
        		$error();

    		}else
    		{
    			//echo "0 Results.";
    		}

		  

		}
	}

	function countRow($sql, $done="", $error="", $con="")
	{


		global $servername;
		global $username;
		global $password;
		global $dbname;



		if($con == ""){
			exitIF($dbname, "Database name is null, Use setDefaultConn() or newSqli() ");

			$conn = new mysqli($servername, $username, $password, $dbname);

		}else
		{
			$conn = $con;
		}
		
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		
		$result = $conn->query($sql);

		$numb_row = $result->num_rows;
		  	


		  

		  	


		  	

		if($done != "")
		{
			$done($numb_row);
		}	
		return $numb_row;
		
		    
		  
		  

		
		

		
	}

	function redirect($x)
	{
		header("Location: ".$x);
	}

	function ifTrue($x, $true="", $false="")
	{
		if($x == true)
		{
			if($true != "")
			{
				$true();
			}

			return true;

		}else
		{

			if($false != ""){

				$false();
			}
			return false;

		}
	}

	function continueFrom($x)
	{
		if($x != true)
		{
			exit();
		}
	}


	function sumRow($column, $table, $where="", $done="", $error="", $con="")
	{
		global $servername;
		global $username;
		global $password;
		global $dbname;



		if($con == ""){
			exitIF($dbname, "Database name is null, Use setDefaultConn() or newSqli() ");

			$conn = new mysqli($servername, $username, $password, $dbname);

		}else
		{
			$conn = $con;
		}
		
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		$ifWhere = "";
		
		if($where != "")
		{
			$ifWhere = "WHERE ".$where;
		}

		$sql = "SELECT * FROM $table ".$ifWhere;

		$result = $conn->query($sql);
		$count = 0;

		if ($result->num_rows > 0) {
		  	


		  while($row = $result->fetch_assoc()) {

		  		$count = ($count*1)+($row[$column]*1);
		  }
		}

		if($done != "")
		{
			$done($count);
		}

		return $count;



		
	}
	function sql($sql, $done="", $error="", $con="")
	{

		global $servername;
		global $username;
		global $password;
		global $dbname;
		
		if($con == ""){
			exitIF($dbname, "Database name is null, Use setDefaultConn() or newSqli() ");

			$conn = new mysqli($servername, $username, $password, $dbname);

		}else
		{
			$conn = $con;
		}
		
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		
	
		  	


		  if ($conn->query($sql) === TRUE) {
			
				if ($done != "") 
				{
	        		
		        		$done();

		    		
		    	}

		    	return true;
	    		
			} else {

			 	if ($error != "") {
        		
        		$sqliErorr = $conn->error;
	        		$error($sqliErorr);

	    		}

	    		return false;
			}


		 
		
	}

	$debug = false;

	function debugMode($x)
	{

			global $debug;
			if($x == true){
				$debug = true;	
			}
			
		
	}

	function complex($x)
	{
		global $complex_engine;

		if($x == true)
		{
			$complex_engine = true;

		}

		
	}

	function reComplex($x)
	{
		global $complex_engine;
		global $reComplex_engine;

		if($x == true)
		{
			$complex_engine = true;
			$reComplex_engine = true;
		}
	}

	function c($x)
	{
		global $a;
		global $debug;
		$str = "random:code";
		if($debug)
		{
			echo $x;
		}
		else{
		if(array_key_exists($x,$a))
		{
			echo $a[$x];
		}else
		{
			$rand =  randstr();
			$a[$x] = $rand;
			echo $rand;
			
		}
	}

	}
	function get_c($x)
	{
		global $a;
		global $debug;
		$str = "random:code";
		if($debug)
		{
			return $x;
		}else
		{
		if(array_key_exists($x,$a))
		{
			return $a[$x];
		}else
		{
			$rand =  randstr();
			$a[$x] = $rand;
			return $rand;
			
		}
	}

	}

	function get($x)
	{
		global $x;

		echo $x;
	}

	function db($x, $y="")
	{
		global $b;
		
		if($y == ""){

			if(array_key_exists($x,$b))
			{
				echo $b[$x];
			}else
			{
				$b[$x] = $y;
				echo $y;
				
			}
		}else
		{
			
			
				$b[$x] = $y;
				
				
			

		}

	}

	

	

	
	

	function e($x)
	{
		echo $x;

	}

	function randomToken($len, $abc="aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYz")
	{
		
		    $letters = str_split($abc);
		    $str = "";
		    for ($i=0; $i<=$len; $i++) {
		        $str .= $letters[rand(0, count($letters)-1)];
		    };
		    return $str;		
	}

	function randstr ($len=10, $abc="aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYz") {
		    $letters = str_split($abc);
		    $str = "";
		    for ($i=0; $i<=$len; $i++) {
		        $str .= $letters[rand(0, count($letters)-1)];
		    };
		    return $str;
	};

	function php($complex_filename) {

		global $complex_engine;
		global $reComplex_engine;

		$complex_toSave = false;

		$complex_isReal = false;

		if($complex_engine == true)
		{



			  	
			  if($reComplex_engine == true){

			  	//$complex_fp = fopen("complex_".$complex_filename, "wb");


				   	
				   $complexPhp_code = file_get_contents($complex_filename);
				   $complex_toSave = true;

			  }
			  else
			  {
				if(file_exists("complexFile_".$complex_filename) == false){


					//$complex_fp = fopen("complexFile_".$complex_filename, "wb");
				   	
				   $complexPhp_code = file_get_contents($complex_filename);
				   $complex_toSave = true;



				}else{
				    $complexPhp_code = file_get_contents("complexFile_".$complex_filename);

				    $complex_isReal = true;

				    @eval(str_replace('<?php if(isset($isComplex) != true){ exit();};?>', "", $complexPhp_code));
				    return false;

				}
			}

			

			
		}
		else
		{
			
			 $complexPhp_code = file_get_contents($complex_filename);
		}


			$complexPhp_mcode = "";

			$complexPhp_newCode = "";



		    $complexPhp_code_raw = $complexPhp_code;

		    $complexPhp_codeA = str_replace("'", "&apos_89280az", $complexPhp_code_raw);
		    $complexPhp_codeB = str_replace('"', "&quot_89280az", $complexPhp_codeA);
		    $complexPhp_codeC = str_replace('[[', "&#91;_89280az", $complexPhp_codeB);
		    $complexPhp_codeD = str_replace(']]', "&#93;_89280az", $complexPhp_codeC);
		    $complexPhp_nc_php = "";
		    $complexPhp_codeBA = $complexPhp_codeD;
		    //echo $complexPhp_codeBA;


		     foreach (getStringsBetween($complexPhp_codeBA, "<?php", "?>") as $complexPhp_vxx) {


		     		$complexPhp_php1 = str_replace('[', "&#91;_89280az",  $complexPhp_vxx);
				    $complexPhp_php2 = str_replace(']', "&#93;_89280az", $complexPhp_php1);
				    $complexPhp_php3 = str_replace("<?php?php", '<?php', $complexPhp_php2);
				    $complexPhp_vx_rawA = str_replace("<?php?php", '<?php', $complexPhp_vxx);

				   

				    


				    if($complexPhp_nc_php == ""){
				    	$complexPhp_codeBA =  str_replace($complexPhp_vx_rawA, $complexPhp_php3, $complexPhp_codeBA);
				    	$complexPhp_nc_php = $complexPhp_codeBA;
				    	// echo "1: ".$complexPhp_codeG." 2; ";
					}
					else
					{
						$complexPhp_codeBA =  str_replace($complexPhp_vx_rawA, $complexPhp_php3, $complexPhp_nc_php);
						$complexPhp_nc_php = $complexPhp_codeBA;
					}




				
		     }

		      
		   



		    foreach (getStringsBetween($complexPhp_codeBA) as $complexPhp_v) {
		  		
		    	
    				
				

		  		$complexPhp_x = $complexPhp_v;

		  		if($complexPhp_newCode == "")
		  		{
		  			$complexPhp_raw_code = $complexPhp_codeBA;
		  		}
		  		else
		  		{
		  			$complexPhp_raw_code = $complexPhp_newCode;	
		  		}


		  		

		  		$complexPhp_nophp = false;

		  		$complexPhp_oneVariable = false;

		  		if(strpos($complexPhp_x, "nophp;") == true){

		  			$complexPhp_nophp = true;
    			
				}

				if(strpos($complexPhp_x, "nophp,") == true){

					$complexPhp_nophp = true;
    		
				}

				if(strpos($complexPhp_x, ";") == false){

					$complexPhp_oneVariable = true;
    		
				}



				


					if($complexPhp_oneVariable == false)
					{
				  		
				  		$complexPhp_newXa = str_replace("&apos_89280az", "'",  $complexPhp_x);

				  		$complexPhp_newSec = str_replace("::", "&pqst;_89280az",  $complexPhp_newXa);

				  		$complexPhp_newXB = str_replace(": ", "&97203280",  $complexPhp_newSec);
				  		$complexPhp_newXbC = str_replace(":", "&97203280",  $complexPhp_newXB);

				  		$complexPhp_newYb = str_replace(";.", "&97203278",  $complexPhp_newXbC);

				  		$complexPhp_codeYYC = str_replace("&#91;_89280az", "&neg_bracket_s_88093", $complexPhp_newYb);
		    			$complexPhp_codeYYD = str_replace("&#93;_89280az", '&neg_bracket_s_88094', $complexPhp_codeYYC);





				  		
				  		

				  		
				  		$complexPhp_newYa = str_replace("&quot_89280az", '"',  $complexPhp_codeYYD);

				  		$complexPhp_u_finalChange = "";

				  		foreach (getStringsBetween($complexPhp_newYa, "&97203280", "&97203278") as $complexPhp_vx) {

				  			$complexPhp_getRaw = str_replace("&9720328097203280 ", "",  $complexPhp_vx);
				  			$complexPhp_getRawB = str_replace("&9720328097203280", "",  $complexPhp_getRaw);

				  			$complexPhp_getRawC = str_replace(" &97203278", "",  $complexPhp_getRawB);
				  			$complexPhp_getRawD = str_replace("&97203278", "",  $complexPhp_getRawC);


		  					//echo "<h1>".$complexPhp_getRawD."</h1>";
		  					
		  					$complexPhp_string = $complexPhp_getRawD; 
							$complexPhp_str_arr = explode (",", $complexPhp_string);  

							$complexPhp_innerString = "";
							foreach ($complexPhp_str_arr as $complexPhp_nd) {

							$complexPhp_raw_word = preg_replace('/\s/', '', $complexPhp_nd);
							
							

							if($complexPhp_raw_word[0] == "$")
							{
								if($complexPhp_innerString == ""){
									$complexPhp_innerString = $complexPhp_nd;
								}else
								{
									$complexPhp_innerString = $complexPhp_innerString.",".$complexPhp_nd;
								}
							}else
							{
								if($complexPhp_innerString == ""){
									$complexPhp_innerString = "'".ltrim($complexPhp_nd)."'";
								}else
								{
									$complexPhp_innerString = $complexPhp_innerString.","."'".ltrim($complexPhp_nd)."'";
								}
							}




							}

							
							$complexPhp_getOrignl = str_replace("&9720328097203280", "&97203280",  $complexPhp_vx);

							$complexPhp_mkComp = str_replace($complexPhp_getRawD, $complexPhp_innerString,  $complexPhp_getOrignl);

							//echo "$complexPhp_getRawD <br>";
							//echo "$complexPhp_innerString <br>";

							if($complexPhp_u_finalChange == ""){
								
								$complexPhp_finalChange = str_replace($complexPhp_getOrignl, $complexPhp_mkComp,  $complexPhp_newYa);

								$complexPhp_u_finalChange = $complexPhp_finalChange;
							}else
							{
								$complexPhp_finalChange = str_replace($complexPhp_getOrignl, $complexPhp_mkComp,  $complexPhp_u_finalChange);

								$complexPhp_u_finalChange = $complexPhp_finalChange;

							}

						


							//echo "<h2>green: $complexPhp_finalChange </h2>";

							


		  				}
		  				//echo $complexPhp_newSec;

		  				if($complexPhp_u_finalChange == "")
		  				{
		  					$complexPhp_u_finalChange = $complexPhp_newYa;
		  				}

				  		$complexPhp_newX = str_replace("&97203280", "(",  $complexPhp_u_finalChange);

		  				$complexPhp_newYb = str_replace("&97203278", ");",  $complexPhp_newX);

		  				$complexPhp_newYc = str_replace("&pqst;_89280az", ":",  $complexPhp_newYb);

		  				







		  				//echo "<h2>greenx: $complexPhp_newYc </h2>";


				  		$complexPhp_newY = $complexPhp_newYc;

				  		
}

else
		  	{
		  		$complexPhp_u_finalChange = "";
		  		
		  			$complexPhp_newXa = str_replace("&apos_89280az", "'",  $complexPhp_x);

		  			$complexPhp_newSec = str_replace("::", "&pqst;_89280az",  $complexPhp_newXa);
				  		

		  			$complexPhp_newXB = str_replace(": ", "&97203280",  $complexPhp_newSec);
				  	$complexPhp_newXbC = str_replace(":", "&97203280",  $complexPhp_newXB);

				  		

				  		$complexPhp_newXX = str_replace("&pqst;_89280az", ":",  $complexPhp_newXbC);

				  		
				  		$complexPhp_codeYYC = str_replace("&#91;_89280az", "&neg_bracket_s_88093", $complexPhp_newXX);
		    			$complexPhp_codeYYD = str_replace("&#93;_89280az", '&neg_bracket_s_88094', $complexPhp_codeYYC);

				  		$complexPhp_newYa = str_replace("&quot_89280az", '"',  $complexPhp_codeYYD);

				  		
				  		if(strpos($complexPhp_x, ":") == false){

				  		    $complexPhp_newYb = substr_replace( $complexPhp_newYa, ';', (strlen($complexPhp_newYa) - 1), 0 );
				  		}
				  		else
				  		{
				  			$complexPhp_newYb = substr_replace( $complexPhp_newYa, "&97203278", (strlen($complexPhp_newYa) - 1), 0 );	
				  		}
				  		foreach (getStringsBetween($complexPhp_newYb, "&97203280", "&97203278") as $complexPhp_vx) {

				  			$complexPhp_getRaw = str_replace("&9720328097203280 ", "",  $complexPhp_vx);
				  			$complexPhp_getRawB = str_replace("&9720328097203280", "",  $complexPhp_getRaw);

				  			$complexPhp_getRawC = str_replace(" &97203278", "",  $complexPhp_getRawB);
				  			$complexPhp_getRawD = str_replace("&97203278", "",  $complexPhp_getRawC);


		  					//echo "<h1>".$complexPhp_getRawD."</h1>";
		  					
		  					$complexPhp_string = $complexPhp_getRawD; 
							$complexPhp_str_arr = explode (",", $complexPhp_string);  

							$complexPhp_innerString = "";
							foreach ($complexPhp_str_arr as $complexPhp_nd) {

							$complexPhp_raw_word = preg_replace('/\s/', '', $complexPhp_nd);
							
							

							if($complexPhp_raw_word[0] == "$")
							{
								if($complexPhp_innerString == ""){
									$complexPhp_innerString = $complexPhp_nd;
								}else
								{
									$complexPhp_innerString = $complexPhp_innerString.",".$complexPhp_nd;
								}
							}else
							{
								if($complexPhp_innerString == ""){
									$complexPhp_innerString = "'".ltrim($complexPhp_nd)."'";
								}else
								{
									$complexPhp_innerString = $complexPhp_innerString.","."'".ltrim($complexPhp_nd)."'";
								}
							}




							}

							
							$complexPhp_getOrignl = str_replace("&9720328097203280", "&97203280",  $complexPhp_vx);

							$complexPhp_mkComp = str_replace($complexPhp_getRawD, $complexPhp_innerString,  $complexPhp_getOrignl);

							//echo "$complexPhp_getRawD <br>";
							//echo "$complexPhp_innerString <br>";

							if($complexPhp_u_finalChange == ""){
								
								$complexPhp_finalChange = str_replace($complexPhp_getOrignl, $complexPhp_mkComp,  $complexPhp_newYb);

								$complexPhp_u_finalChange = $complexPhp_finalChange;
							}else
							{
								$complexPhp_finalChange = str_replace($complexPhp_getOrignl, $complexPhp_mkComp,  $complexPhp_u_finalChange);

								$complexPhp_u_finalChange = $complexPhp_finalChange;

							}

							
							//echo "<h2>green: $complexPhp_finalChange </h2>";

							


		  				}
		  				//echo $complexPhp_newSec;

		  				if($complexPhp_u_finalChange == "")
		  				{
		  					$complexPhp_u_finalChange = $complexPhp_newYb;
		  				}


				  		$complexPhp_newX = str_replace("&97203280", "(",  $complexPhp_u_finalChange);

		  				$complexPhp_newYb = str_replace("&97203278", ");",  $complexPhp_newX);

		  				$complexPhp_newYc = str_replace("&pqst;_89280az", ":",  $complexPhp_newYb);

				  		

				  		$complexPhp_newY = $complexPhp_newYc;

		  			
		  	}

		  		


		  		
		  		





		  		//echo "<br><br><b>$complexPhp_x</b><br><b>$complexPhp_newX</b> <br>";


		  		


		  		$complexPhp_mcode = str_replace($complexPhp_x, $complexPhp_newY,  $complexPhp_raw_code);

		  		$complexPhp_newCode = $complexPhp_mcode;



		  		//echo $complexPhp_newCode;
		  		

		  		//echo $complexPhp_x; // {c:green;}

		  	
		  	







		  	

			}

			if($complexPhp_mcode == "")
			{
				$complexPhp_mcode = $complexPhp_codeBA;
			}
			



		    

			
		    $complexPhp_codeE = str_replace('[', "');", $complexPhp_mcode);
		    $complexPhp_codeEb = str_replace(']', "cmin('", $complexPhp_codeE);

		    $complexPhp_codeBB = str_replace("&neg_bracket_s_88093", "[", $complexPhp_codeEb);
			$complexPhp_codeF = str_replace("&neg_bracket_s_88094", "]",  $complexPhp_codeBB);

		    $complexPhp_nc = "";

		  

		    foreach (getStringsBetween($complexPhp_codeF, "<?php", "?>") as $complexPhp_vx) {



		   	$complexPhp_php1 = str_replace("&#91;_89280az", '[', $complexPhp_vx);
		    $complexPhp_php2 = str_replace("&#93;_89280az", ']', $complexPhp_php1);

		    

		    $complexPhp_php3 = str_replace("&apos_89280az", "'", $complexPhp_php2);
		    $complexPhp_php4 = str_replace("&quot_89280az", '"', $complexPhp_php3);
		    $complexPhp_php5 = str_replace("<?php?php", '<?php', $complexPhp_php4);


		 

		    $complexPhp_vx_raw = str_replace("<?php?php", '<?php', $complexPhp_vx);


		    if($complexPhp_nc == ""){
		    	$complexPhp_codeG =  str_replace($complexPhp_vx_raw, $complexPhp_php5, $complexPhp_codeF);
		    	$complexPhp_nc = $complexPhp_codeG;
		    	// echo "1: ".$complexPhp_codeG." 2; ";
			}
			else
			{
				$complexPhp_codeG =  str_replace($complexPhp_vx_raw, $complexPhp_php5, $complexPhp_nc);
				$complexPhp_nc = $complexPhp_codeG;
			}



		   // echo "1: ".$complexPhp_v." 2; ";

		   		//echo "Green:".$complexPhp_codeF;

			
		     
		    }

		    if($complexPhp_nc == "")
		    {
		    	$complexPhp_nc = $complexPhp_codeF;
		    }


		    $complexPhp_codeH = str_replace('<?php', "');", $complexPhp_nc);
		    $complexPhp_codeI = str_replace('?>', "cmin('", $complexPhp_codeH);

		    //echo "CODEF: ".$complexPhp_codeI;



		   

		    
		     

			//echo "cmin('".$complexPhp_codeI."');";
		    //echo

	global $debug;
	if($debug){

			$complex_FINALOUTPUT = "cmin('".$complexPhp_codeI."'); return true;";

	}else{
			$complex_FINALOUTPUT = cminify_html("cmin('".$complexPhp_codeI."'); return true;");
		}
		 try
			{
			     @eval($complex_FINALOUTPUT);
			}
			catch (ParseError $err)
			{
				$complex_debugCode = cminify_html(cmin("cmin('".$complexPhp_codeI."'); return true;", true));
				complexError($err." <br><br><b>File ($complex_filename):</b><br><br><textarea style='width: 100%; height: 100%; background: url(http://i.imgur.com/2cOaJ.png) no-repeat local white; padding-left: 35px; padding-top: 10px; border-color: rgb(204, 204, 204); margin: 0px;''>".$complex_debugCode."</textarea>");
			    //echo "YAY! ERROR CAPTURED: $err";
			}
		

		 if($complex_toSave == true)
		 {
		 		$complex_fp = fopen("complexFile_".$complex_filename, "wb");
				


				    fwrite($complex_fp, '<?php if(isset($isComplex) != true){ exit();};?>'.$complex_FINALOUTPUT);
				    fclose($complex_fp);
				
		 }

		   
		}
		//print_r(getStringsBetween($complexPhp_code));

		
		function getStringsBetween($str, $start='[', $end=']', $with_from_to=true){
			$arr = [];
		$last_pos = 0;
		$last_pos = strpos($str, $start, $last_pos);
		while ($last_pos !== false) {
		    $t = strpos($str, $end, $last_pos);
		    $arr[] = ($with_from_to ? $start : '').substr($str, $last_pos + 1, $t - $last_pos - 1).($with_from_to ? $end : '');
		    $last_pos = strpos($str, $start, $last_pos+1);
		}
		return $arr; 
		}


		function cmin($x, $y=false)
		{
			$x1 = str_replace('&#91;_89280az', "[", $x);
			$x2 = str_replace('&#93;_89280az', "]", $x1);

			
			$x3 = str_replace('&quot_89280az', '"', $x2);
			$x4 = str_replace('&apos_89280az', "'", $x3);

			if($y == false){
			echo $x4;
			}else
			{
				return $x4;
			}
		}




		function php_syntax_error($code){
			    if(!defined("CR"))
			        define("CR","\r");
			    if(!defined("LF"))
			        define("LF","\n") ;
			    if(!defined("CRLF"))
			        define("CRLF","\r\n") ;
			    $braces=0;
			    $inString=0;
			    foreach (token_get_all('<?php ' . $code) as $token) {
			        if (is_array($token)) {
			            switch ($token[0]) {
			                case T_CURLY_OPEN:
			                case T_DOLLAR_OPEN_CURLY_BRACES:
			                case T_START_HEREDOC: ++$inString; break;
			                case T_END_HEREDOC:   --$inString; break;
			            }
			        } else if ($inString & 1) {
			            switch ($token) {
			                case '`': case '\'':
			                case '"': --$inString; break;
			            }
			        } else {
			            switch ($token) {
			                case '`': case '\'':
			                case '"': ++$inString; break;
			                case '{': ++$braces; break;
			                case '}':
			                    if ($inString) {
			                        --$inString;
			                    } else {
			                        --$braces;
			                        if ($braces < 0) break 2;
			                    }
			                    break;
			            }
			        }
			    }
			    $inString = @ini_set('log_errors', false);
			    $token = @ini_set('display_errors', true);
			    ob_start();
			    $code = substr($code, strlen('<?php '));
			    $braces || $code = "if(0){{$code}\n}";
			    if (eval($code) === false) {
			        if ($braces) {
			            $braces = PHP_INT_MAX;
			        } else {
			            false !== strpos($code,CR) && $code = strtr(str_replace(CRLF,LF,$code),CR,LF);
			            $braces = substr_count($code,LF);
			        }
			        $code = ob_get_clean();
			        $code = strip_tags($code);
			        if (preg_match("'syntax error, (.+) in .+ on line (\d+)$'s", $code, $code)) {
			            $code[2] = (int) $code[2];
			            $code = $code[2] <= $braces
			                ? array($code[1], $code[2])
			                : array('unexpected $end' . substr($code[1], 14), $braces);
			        } else $code = array('syntax error', 0);
			    } else {
			        ob_end_clean();
			        $code = false;
			    }
			    @ini_set('display_errors', $token);
			    @ini_set('log_errors', $inString);
			    return $code;
}


function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}




function cminify_html($input) {

	
	
    if(trim($input) === "") return $input;
    // Remove extra white-space(s) between HTML attribute(s)
    $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
        return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
    }, str_replace("\r", "", $input));
    // Minify inline CSS declaration(s)
    if(strpos($input, ' style=') !== false) {
        $input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
            return '<' . $matches[1] . ' style=' . $matches[2] . cminify_css($matches[3]) . $matches[2];
        }, $input);
    }
    if(strpos($input, '</style>') !== false) {
      $input = preg_replace_callback('#<style(.*?)>(.*?)</style>#is', function($matches) {
        return '<style' . $matches[1] .'>'. cminify_css($matches[2]) . '</style>';
      }, $input);
    }
    if(strpos($input, '</script>') !== false) {
      $input = preg_replace_callback('#<script(.*?)>(.*?)</script>#is', function($matches) {
        return '<script' . $matches[1] .'>'. cminify_js($matches[2]) . '</script>';
      }, $input);
    }

    return preg_replace(
        array(
            // t = text
            // o = tag open
            // c = tag close
            // Keep important white-space(s) after self-closing HTML tag(s)
            '#<(img|input)(>| .*?>)#s',
            // Remove a line break and two or more white-space(s) between tag(s)
            '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
            '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
            '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
            '#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
            '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
            '#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
            // Remove HTML comment(s) except IE comment(s)
            '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
        ),
        array(
            '<$1$2</$1>',
            '$1$2$3',
            '$1$2$3',
            '$1$2$3$4$5',
            '$1$2$3$4$5$6$7',
            '$1$2$3',
            '<$1$2',
            '$1 ',
            '$1',
            ""
        ),
    $input);
}

// CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
function cminify_css($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
        ),
        array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2'
        ),
    $input);
}

// JavaScript Minifier
function cminify_js($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
            // Remove white-space(s) outside the string and regex
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
            // Remove the last semicolon
            '#;+\}#',
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
            '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
            // --ibid. From `foo['bar']` to `foo.bar`
            '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
        ),
        array(
            '$1',
            '$1$2',
            '}',
            '$1$3',
            '$1.$3'
        ),
    $input);
}


function complexError($x)
{
	echo '<div style="padding: 20px;background: #f44336;color: white;font-family: sans-serif;font-size: 17px;">Error ComplexPHP: '.$x.'</div>';
    		
    		exit();
}
function exitIF($x, $er, $y="")
	{
		if($x==$y) 
		{
			echo '<div style="padding: 20px;background: black;color: white;font-family: sans-serif;font-size: 17px;">Error ComplexPHP: '.$er.'</div>';
    		
    		exit();
  		}
  		
	}


	  function convertBytes($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}


?>