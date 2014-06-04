<?php
class zip2citystate 
{ 
    public function lookup($zip, $format) 
	{
		//lookup zip code from 3rd party API
		$raw_data = file_get_contents('http://pagetrackr.com/api_tools/ziplookup.php?zip='.$zip); 
		if($format == "txt" OR $format == "")
		{
			header('Content-Type: text/plain');
			return $raw_data;
		}
		else if($format == "xml" || $format == "json")
		{
			$data_arr = explode("|",$raw_data);
			if($format == "xml")
			{
				header('Content-Type: text/xml');
				echo "<?xml version='1.0' encoding='UTF-8'?>";
				echo "<data>";	
				if($raw_data == "invalid zip code")
				{
					echo "<error>".$data_arr[0]."</error>";
				}
				else
				{
					echo "<city>".$data_arr[0]."</city>";
					echo "<state>".$data_arr[1]."</state>";
					echo "<zip>".$data_arr[2]."</zip>";
				}
				echo "</data>";
			}
			if($format == "json")
			{
				header('Content-Type: application/json');
				if($raw_data == "invalid zip code")
				{
					$data = array("error" => "invalid zip code"); 
				}
				else
				{
					$data = array("city" => $data_arr[0], "state" => $data_arr[1], "zip" => $data_arr[2]);               
				}
				return json_encode($data);             
			}
		}
		else
		{
			header('Content-Type: text/plain');
			return "invalid format - ".$format;
		}
    }
}
?>