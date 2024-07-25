<?php
$openbekenpm_cfg 			= parse_ini_file( "/boot/config/plugins/openbekenpm/openbekenpm.cfg" );
$openbekenpm_device_ip		= isset($openbekenpm_cfg['DEVICE_IP']) ? $openbekenpm_cfg['DEVICE_IP'] : "";
$openbekenpm_use_pass		= isset($openbekenpm_cfg['DEVICE_USE_PASS']) ? $openbekenpm_cfg['DEVICE_USE_PASS'] : "false";
$openbekenpm_device_user	= isset($openbekenpm_cfg['DEVICE_USER']) ? $openbekenpm_cfg['DEVICE_USER'] : "";
$openbekenpm_device_pass	= isset($openbekenpm_cfg['DEVICE_PASS']) ? $openbekenpm_cfg['DEVICE_PASS'] : "";
$openbekenpm_costs_price	= isset($openbekenpm_cfg['COSTS_PRICE']) ? $openbekenpm_cfg['COSTS_PRICE'] : "0.0";
$openbekenpm_costs_unit		= isset($openbekenpm_cfg['COSTS_UNIT']) ? $openbekenpm_cfg['COSTS_UNIT'] : "EUR";


if ($openbekenpm_device_ip == "") {
	die("OpenBeken Device IP missing!");
}

$Url = "http://" . $openbekenpm_device_ip . "/cm?";

if ($openbekenpm_use_pass == 1) {
	if ($openbekenpm_device_user == "") {
		die("OpenBeken username missing!");
	}
	if ($openbekenpm_device_pass == "") {
		die("OpenBeken password missing!");
	}

	$Url = $Url . "user=" . $openbekenpm_device_user . "&password=" . $openbekenpm_device_pass . "&";
}

$Url = $Url . "cmnd=Status%208";

$datajson = file_get_contents($Url);
$data = json_decode($datajson, true);

$json = array(
		'Power' => $data['StatusSNS']['ENERGY']['Power'],
		'ApparentPower' => $data['StatusSNS']['ENERGY']['ApparentPower'],
		'ReactivePower' => $data['StatusSNS']['ENERGY']['ReactivePower'],
		'Factor' => $data['StatusSNS']['ENERGY']['Factor'],
		'Voltage' => $data['StatusSNS']['ENERGY']['Voltage'],
		'Current' => $data['StatusSNS']['ENERGY']['Current'],
		'Total' => $data['StatusSNS']['ENERGY']['ConsumptionTotal'],
		'Yesterday' => $data['StatusSNS']['ENERGY']['Yesterday'],
		'Today' => $data['StatusSNS']['ENERGY']['ConsumptionLastHour'],
		'Costs_Price' => $openbekenpm_costs_price,
		'Costs_Unit' => $openbekenpm_costs_unit
	);

header('Content-Type: application/json');
echo json_encode($json);
?>
