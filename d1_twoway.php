<?php
/**

 * Parses Device Data from URI and sending to Windows Server using Soap 
 *
 * @package		DEMO
 * @subpackage	Libraries
 * @category	API
 * @author		Seeni Dev Team
 */

	//Getting the data from Server
	if(empty($_REQUEST['data'])){
			echo "<div>Parameter is empty</div>";
			exit;
	}

	//Variable declaration
	$Debug = null;
	$LogPath = "/tmp/gps";
	$Log_Prefix = "";
	
	//Setting up log file
	if(isset($_REQUEST['data'])){
		
		//For debug
		if(isset($_REQUEST['debug'])){
			$Debug = $_REQUEST['debug'];
		}
		
		$Data = $_REQUEST['data'];
		HTTP_API_Func($Data,$LogPath,$Log_Prefix,$Debug);
	}	

	
	function HTTP_API_Func($Data,$LogPath,$Log_Prefix,$Debug){

		try{
			$Command = ", \<Get.ip\>";
			echo "\$IPCFG".$Command."";
		}
		catch(Exception $e){
			ErrorLog_Creation($e,$LogPath,'ErrorLog');
		}
	}	
?>


