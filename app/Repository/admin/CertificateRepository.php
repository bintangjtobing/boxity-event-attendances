<?php

namespace App\Repository\admin;

use App\Certificates;
use Exception;

class CertificateRepository
{
    function getSingleData($id) {
        $data = Certificates::with(['Participant', 'Event'])->find($id);
        return $data;
    }

    function getData($n) {
        $data = Certificates::with(['Participant', 'Event'])->orderBy('id', 'asc');
        return $data->paginate($n);
    }

    function updateStatus($participant_id) {
        $data = [
            'status' => 1,
        ];
        $certificate = Certificates::where('participant_id',$participant_id)->where('status', 0)->first();
        if ($certificate) {
            $certificate->update($data);
        }
    }

    function delete($id) {
        Certificates::where('id', $id)->delete();
    }
}
