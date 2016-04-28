<?php
    $BLOGURL = "http://rainman.me";
    $USERNAME = "username";
    $PASSWORD = "password";

    function get_response($URL, $context) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $context);

        $response = curl_exec($ch);
        return $response;
    }

    $title = "sample title";
    $description = "sample content";
    $status = "publish";
    $url = 'sample-post';
    $categories = array('category' => array(1));
    $tags = array('key1', 'key2', 'key3');
    $thumbnail = 1;

    $content = array (
        'post_title' => $title,
        'post_content' => $description,
        'post_status' => $status,
        'post_name' => $url,
        'terms' => $categories,
        'post_thumbnail' => $thumbnail,
        'tags_input' => $tags
    );
    $request = xmlrpc_encode_request("wp.newPost", array(1, $USERNAME, $PASSWORD, $content), array('encoding' => 'UTF-8', 'escaping' => 'markup'));

    $xmlresponse = get_response($BLOGURL."/xmlrpc.php", $request);
    $response = xmlrpc_decode($xmlresponse);

    print_r($response);
    echo "\n";
?>
