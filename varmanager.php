<?php 
/**
 * VarManager - Version 1.0
 *
 * Inspired to Variable Managment in JSON.
 *
 *
 * @author Alemalakra
 */

class VarManager {
	function __construct($File = "varmanager.data.php") {

		error_reporting(E_ALL);
		ini_set("display_errors", 1);

		$this->Encrypt = false;

		if (file_exists($File)) {
			$fp = fopen($File, 'r');
			$Content = fread($fp, 1024*1024);
			$Line = explode(PHP_EOL, $Content);
			if ($Line[0] == "<?php die(); ?>") {
				// Done
			} else {
				unlink($File);
				$fp = fopen($File, 'a');
				fwrite($fp, '<?php die(); ?>'.PHP_EOL.'{'.PHP_EOL.'    "VarManager": "1.0"'.PHP_EOL.'}');		
				// Done		
			}
		} else {
			$fp = fopen($File, 'a');
			fwrite($fp, '<?php die(); ?>'.PHP_EOL.'{'.PHP_EOL.'    "VarManager": "1.0"'.PHP_EOL.'}');
			// Done
		}

		$this->FileData = $File; // Save Name of File

	}
	function is_set($Variable) {

		$fp = fopen($this->FileData, 'r'); // Open File

		$Content = fread($fp, filesize($this->FileData));

		$Content = str_replace('<?php die(); ?>', '', $Content);

		$Array = json_decode($Content, true);

		if ($this->Encrypt == true) {
			$Variable = base64_encode($Variable);
		}

		if (isset($Array[$Variable])) {
			return true;
		} else {
			return false;
		}

	}
	function encryptAll() {

		$this->Encrypt = true;

	}
	function set($Name, $Value, $Rewrite = true) {

		$Name = strip_tags($Name);

		$Value = strip_tags($Value);

		$Name = str_replace('"', '', $Name);

		$Value = str_replace('"', '', $Value);

		$fp = fopen($this->FileData, 'r'); // Open File

		$Content = fread($fp, 1024*1024);

		$Content = str_replace('<?php die(); ?>', '', $Content);

		$Array = json_decode($Content, true);

		if ($this->is_set($Name)) {
			if ($Rewrite == true) {
				unset($Array[$Name]);

				if ($this->Encrypt == true) {
					$Value = base64_encode(utf8_encode($Value));
					$Name = base64_encode(utf8_encode($Name));
				}
				$Array[$Name] = utf8_encode($Value);

				$Json = json_encode($Array);

				$fp = fopen($this->FileData, 'w');

				fwrite($fp, '<?php die(); ?>'.PHP_EOL.$Json);

			}
		} else {

			if ($this->Encrypt == true) {
				$Value = base64_encode(utf8_encode($Value));
				$Name = base64_encode(utf8_encode($Name));
			}
			$Array[$Name] = utf8_encode($Value);

			$Json = json_encode($Array);

			$fp = fopen($this->FileData, 'w');

			fwrite($fp, '<?php die(); ?>'.PHP_EOL.$Json);

		}

	}
	function get($Name) {

		$fp = fopen($this->FileData, 'r');

		$Content = fread($fp, 1024*1024);

		$Content = str_replace('<?php die(); ?>', '', $Content);

		$Array = json_decode($Content, true);

		if ($this->Encrypt == true) {
			$Name = base64_encode($Name);
		}

		if (isset($Array[$Name])) {

			if ($this->Encrypt == true) {
				return utf8_decode(base64_decode($Array[$Name]));
			}
			return utf8_decode($Array[$Name]);

		} else {

			return "No Set";

		}

		fclose($fp);

	}
}

?>
