<?php

$gauthkey = 'ENTER API KEY HERE'; // https://developers.google.com/sheets/api/guides/authorizing#APIKey

$params = array();
foreach($_GET as $key => $value) {
    $params[$key] = $value;
}
function getDataFromGoogleSheets($params) {
    global $gauthkey;

    $api_key = isset($params['api_key']) ? $params['api_key'] : $gauthkey;
    $id = isset($params['id']) ? $params['id'] : '';
    $sheet = isset($params['sheet']) ? $params['sheet'] : '';
    $query = isset($params['q']) ? $params['q'] : '';
    $useIntegers = isset($params['integers']) ? $params['integers'] : true;
    $showRows = isset($params['rows']) ? $params['rows'] : true;
    $showColumns = isset($params['columns']) ? $params['columns'] : true;
    
    if (!$id) {
        return 'You must provide a sheet ID';
    }
    if (!$sheet) {
        return 'You must provide a sheet name';
    }

    $url = 'https://sheets.googleapis.com/v4/spreadsheets/' . $id . '/values/' . $sheet . '?key=' . $api_key;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if (!$response) {
        return 'Error retrieving data';
    }

    if ($httpcode === 200) {
        $data = json_decode($response, true);
        $responseObj = array();
        $rows = array();
        $columns = array();

        if (isset($data['values'])) {
            $headings = $data['values'][0];

            for ($i = 1; $i < count($data['values']); $i++) {
                $entry = $data['values'][$i];
                $newRow = array();
                $queried = !$query;
                for ($j = 0; $j < count($entry); $j++) {
                    $name = $headings[$j];
                    $value = $entry[$j];
                    if ($query) {
                        if (strpos(strtolower($value), strtolower($query)) !== false) {
                            $queried = true;
                        }
                    }
                    if (array_key_exists($name, $params)) {
                        $queried = false;
                        if (strtolower($value) === strtolower($params[$name])) {
                            $queried = true;
                        }
                    }
                    if ($useIntegers === true && is_numeric($value)) {
                        $value = (int)$value;
                    }
                    $newRow[$name] = $value;
                    if ($queried === true) {
                        if (!array_key_exists($name, $columns)) {
                            $columns[$name] = array();
                            array_push($columns[$name], $value);
                        } else {
                            array_push($columns[$name], $value);
                        }
                    }

                }
                if ($queried === true) {
                    array_push($rows, $newRow);
                }
            }
            if ($showColumns === true) {
                $responseObj['columns'] = $columns;
            }
            if ($showRows === true) {
                $responseObj['rows'] = $rows;
            }
            return $responseObj;
        } else {
            return 'No data found';
        }
    } else {
        return 'Error retrieving data';
    }
}

$data = getDataFromGoogleSheets($params);

print_r($data);

    
?>