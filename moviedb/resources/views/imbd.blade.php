<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://imdb-internet-movie-database-unofficial.p.rapidapi.com/search/inception",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: imdb-internet-movie-database-unofficial.p.rapidapi.com",
		"x-rapidapi-key: e1e35729f3msh632c29a6ed8fce5p120306jsn15147069dd8b"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}