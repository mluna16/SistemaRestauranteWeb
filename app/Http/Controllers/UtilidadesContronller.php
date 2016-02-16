<?php namespace SistemaRestauranteWeb\Http\Controllers;

use SistemaRestauranteWeb\Http\Requests;
use SistemaRestauranteWeb\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UtilidadesContronller extends Controller {

	public function sendPush($idCode,$array)
    {
        $fields = array
        (
            "registration_ids" 	=> [$idCode],
            'data'			=> $array
        );
        $headers = array
        (
            'Authorization: key= AIzaSyCbvPlV1JjnVC3f0_o13EJnsDEQv4jYvCo',
            'Content-Type: application/json'
        );
        $data_string = json_encode($fields);

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string );
        $result = curl_exec($ch );
        curl_close( $ch );

        return $result;

    }
}
