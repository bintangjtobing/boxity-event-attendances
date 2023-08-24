<?php

namespace App\Traits;

trait WablasTrait
{
    public static function sendText($no_hp, $isi_pesan, $type_user)
    {
        $kumpulan_data = [];
        $pesan = $isi_pesan;
        $data['phone'] = $no_hp;
        $data['message'] = $pesan;
        $data['secret'] = false;
        $data['retry'] = false;
        $data['isGroup'] = false;
        array_push($kumpulan_data, $data);
        $curl = curl_init();
        $token = env('SECURITY_TOKEN_WABLAS');
        $payload = [
            "data" => $kumpulan_data
        ];
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                "Content-Type: application/json"
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($curl, CURLOPT_URL,  env('DOMAIN_SERVER_WABLAS') . "/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);
        if ($type_user == "user") {
            switch ($result) {
                case true:
                    return $message = [
                        'message' => 'BERHASIL',
                        'description' => 'Pesan Berhasil dikirim ke nomor ' . $no_hp,
                        'status' => true,
                    ];
                    break;

                default:
                return $message = [
                    'message' => 'GAGAL',
                    'description' => 'Periksa kembali SECURITY_TOKEN_WABLAS dan DOMAIN_SERVER_WABLAS',
                    'status' => false,
                ];
                    break;
            }
        }
    }
}
