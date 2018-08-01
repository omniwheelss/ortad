<?php
	/*
	Check SMS alert
	*/
	function triggerSMSAlertForDevices($Data){
		$Results = null;
		// Formating Data
		list($Format_Type,$Protocol_Version,$IMEI,$Date_Stamp,$Live_Data,$GPS_Status,$Latitude,$Longitude,$Altitude,$Speed,$Direction,$Odometer,$GPS_Move_Status,$External_Battery_Volt,$Internal_Battery_Percent,$GSM_Signal,$Unused,$Alert_Msg_Code,$Sensor_Interface,$IGN,$Analog_Input1,$Digital_Input1,$Output1,$Sequence_No,$Check_Sum)=explode (",",$Data);
		$Mysql_Query = "call spSelSMSAlertByIMEI('".$IMEI."')";
		$Mysql_Query_Result = mysql_query($Mysql_Query) or die(mysql_error());
		$Row_Count = mysql_num_rows($Mysql_Query_Result);
		if($Row_Count >=1){
			while($Result_Array = mysql_fetch_array($Mysql_Query_Result)){
				$SMS_Alert_Name = $Result_Array['sms_alert_name'];
				$Mobile_Number = $Result_Array['send_mobile'];
				$Firstname = $Result_Array['firstname'];
				$Vehicle_No = $Result_Array['vehicle_no'];
				$SMS_Template = $Result_Array['template_content'];
				$Device_Command = $Result_Array['device_command'];
				echo "---".$IGN;
				switch($SMS_Alert_Name){
					case 'speed_alert':
						if($Speed > 60){
							$Results = formatSMSAlert($Firstname, $Vehicle_No, $Speed,$Date_Stamp, $SMS_Template,$Device_Command, $Mobile_Number);
						}
					break;	
					case 'engine_on_alert':
					case 'engine_off_alert':echo "Seeni";
						if($IGN == 1){
							$Results = formatSMSAlert($Firstname, $Vehicle_No, $Speed,$Date_Stamp, $SMS_Template,$Device_Command, $Mobile_Number);
						}
						else if($IGN == 0){
							$Results = formatSMSAlert($Firstname, $Vehicle_No, $Speed,$Date_Stamp, $SMS_Template,$Device_Command, $Mobile_Number);
						}
					break;	
					default:
					break;
				}
			}	
		}	
		return $Results;
	}
	
	
	/*
	Check SMS alert
	*/
	function formatSMSAlert($Firstname, $Vehicle_No, $Speed,$Date_Stamp, $SMS_Template,$Device_Command, $Mobile_Number){
		$Results = null;	//[VEHICLE_NUMBER] has running at [SPEED] 
		// For SMS
		$SMS_Template = str_replace('[USER_NAME]', $Firstname, $SMS_Template);
		$SMS_Template = str_replace('[VEHICLE_NUMBER]', $Vehicle_No, $SMS_Template);
		$SMS_Template = str_replace('[SPEED]', $Speed, $SMS_Template);

		// For Device_Command	//$IPCFG,<DEVCMD: SMS=[MOBILE_NUMBER],[MESSAGE] >
		$Device_Command_Template = str_replace('[MOBILE_NUMBER]', $Mobile_Number, $Device_Command);
		$Device_Command_Template = str_replace('[MESSAGE]', $SMS_Template, $Device_Command_Template);
		
		return trim($Device_Command_Template);
	}
?>