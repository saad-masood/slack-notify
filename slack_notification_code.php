<?php 
    if (!function_exists('curl_request')) {
        /**
         * Return response after sending a curl request
         * @param  string $url , string $data, boolean $is_post, array $headers, boolean $auth
         * @return array
         */
        function curl_request($url, $data = null, $is_post = false, $headers = null, $auth = false)
        {

            $curl = curl_init($url);
            if (!empty($headers) || $headers != null) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            }
            if ($auth) {
                curl_setopt($curl, CURLOPT_USERPWD, $auth);
            }
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($curl, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
            if ($is_post) {
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }

            $output = curl_exec($curl);
            $header_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            return ['header_code' => $header_code, 'body' => $output];
        }
    }
    $webhook_url = "INSERT SLACK WEBHOOK";
    $payload =  [

        "attachments" => [
            [
                "mrkdwn_in" => ["text"],

                "color" => "#47d147",

                "title" => "Report  : "
            ],
            [
                "fields" => [
                    [
                        "title" => "Sales",
                        "value" => "6565654",
                        "short" => false
                    ],
                ],
                "color" => "#47d147",
                "title" => "Total sales"
            ],
            
        ]
    ];

    $status = curl_request(

        $webhook_url,

        @json_encode($payload),

        true,

        ['Content-type: application/json']
    );

    dump($status);

?>
