<?php

$result = array();
$result['success'] = false;
$result['error_message'] = Registry::load('strings')->went_wrong;
$result['error_key'] = 'something_went_wrong';

if (role(['permissions' => ['super_privileges' => 'core_settings']])) {
    $noerror = true;

    $result['success'] = false;
    $result['error_message'] = Registry::load('strings')->invalid_value;
    $result['error_key'] = 'invalid_value';
    $result['error_variables'] = [];

    if (!isset($data['purchase_code']) || empty($data['purchase_code'])) {
        $result['error_variables'][] = ['purchase_code'];
        $noerror = false;
    }

    if ($noerror) {

        $purchase_code = $data['purchase_code'];

        $ch = curl_init();
        $url = "https://baevox.com/modules/purchase_validation/";

        $postData = array(
            'purchase_code' => $purchase_code,
            'site_url' => Registry::load('config')->site_url,
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $noerror = false;
            $result['error_message'] = 'Unable to connect to the Server';
        }

        curl_close($ch);

        if ($noerror) {

            $result['error_message'] = 'Invalid Purchase Code';
            $result['error_key'] = 'invalid_purchase_code';

            if (!empty($response)) {
                $variables = json_decode($response);

                if (!empty($variables)) {
                    if (isset($variables->license)) {
                        $license_info_file = 'assets/cache/license_record.cache';
                        file_put_contents($license_info_file, $response);

                        $configFile = 'include/config.php';
                        $currentConfig = file_get_contents($configFile);
                        copy($configFile, 'include/config_backup_copy.php');

                        if (isset($variables->extended_license)) {
                            $newLine = "\n\$config->pro_version = 'pro';\n";
                            $pattern = '/(\$db_error_mode\s*=\s*PDO::ERRMODE_SILENT\s*;)/';

                            if (preg_match($pattern, $currentConfig, $matches, PREG_OFFSET_CAPTURE)) {
                                $position = $matches[0][1];
                                $newConfig = substr_replace($currentConfig, $newLine, $position, 0);
                                file_put_contents($configFile, $newConfig);
                            }
                        } else {
                            $pattern = '/\n\s*\$config->pro_version\s*=\s*\'pro\'\s*;/';
                            $newConfig = preg_replace($pattern, '', $currentConfig);
                            file_put_contents($configFile, $newConfig);
                        }

                        $result = array();
                        $result['success'] = true;
                        $result['todo'] = 'refresh';
                    }
                }
            }
        }

    }
}

?>