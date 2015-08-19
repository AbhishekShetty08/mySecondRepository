<?php

class alert_redirect{
	
	var $message;
	var $redirect;	
		
	function moveWithAlert($message,$redirect){
		
		echo '<script type="text/javascript">
		    alert("'.$message.'");
           window.location = "'.$redirect.'"
      </script>';
		
		}// end of  moveWithAlert function
				
		function move($redirect){
			
			echo '<script type="text/javascript">
           window.location = "'.$redirect.'"
      </script>';
			
			}// end of move function
			
			function alert($message){

			echo '<script type="text/javascript">
           alert("'.$message.'");
      </script>';
			
			}// end of move function
			
	}// end of class 
	
	
	class uploader{
		
		function upload($file,$location){
			
			$file_name=basename($file["name"]);//get name of file
			$file_name = mt_rand().$file_name;// prepend random number to file name
			$uploadfile = $location.$file_name;
			move_uploaded_file($file['tmp_name'], $uploadfile); // move file to desired location
			return $file_name;
				
			}
			
		function upload_validate($file,$ext_array,$mime_array){
			
			$file_name=basename($file["name"]);
			$ext = explode(".", $file_name);
			if(in_array(end($ext),$ext_array)){
								
				if(in_array($file["type"],$mime_array)){
					
					
						
						return true; // everything right
						
						
					
					}else{
						
						echo '<script type="text/javascript">
							alert("Mime type not supported.");
      						</script>';
						return false; // Mime Type not supported
						
						}
				
				}else{
					
					echo '<script type="text/javascript">
							alert("File extension not supported.");
      						</script>';
					return false;// Extension not supported
					
					}								
				
			}
		
		}

?>