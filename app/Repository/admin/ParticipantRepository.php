<?php

namespace App\Repository\admin;

use Exception;
use Carbon\Carbon;
use App\Events;
use Illuminate\Support\Str;
use App\Participants;

class ParticipantRepository
{
    function getSingleParticipantByToken($token) {
        $data = Participants::where('qr_code', $token)->pluck('qr_code_file_name')->first();
        //return route not found kalau tidak ada data
        if (!$data) {
            return null;
        }
        $data = explode('/', $data, 7);
        $data = $data[6];
        return $data;
    }

    function getSingleEventByToken($token) {
        $data = Participants::where('qr_code', $token)->pluck('event_id')->first();
        //return route not found kalau tidak ada data
        if (!$data) {
            return null;
        }
        $event = Events::find($data);
        return $event;
    }

    function getEvent() {
        $data = Events::get();
        return $data;
    }

    function getSingleData($id) {
        $data = Participants::where('participant_id',$id)->first();
        return $data;
    }

    function getData($n) {
        $search = request('search');
        $data = Participants::orderBy('participant_id', 'asc');
        if ($search) {
            $data = $data->where('name', 'like', '%' . $search . '%');
        }
        return $data->paginate($n);
    }

    function add() {
        do {
            $qr_code = Str::random(10);
            $count = Participants::where('qr_code', $qr_code)->count();
        } while ($count > 0);

        $latestParticipant = Participants::latest()->first();
        if ($latestParticipant) {
            $lastNumber = intval(substr($latestParticipant->participant_id, 1));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $newParticipantId = 'P' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        $data = [
            'participant_id' => $newParticipantId,
            'event_id' => request('event_id'),
            'name' => request('name'),
            'jabatan' => request('jabatan'),
            'no_hp' => request('no_hp'),
            'email' => request('email'),
            'instansi' => request('instansi'),
            'alamat_instansi' => request('alamat_instansi'),
            'tanggal_kedatangan' => Carbon::parse(request('date-range-from')),
            'penginapan' => request('penginapan'),
            'tanggal_kembali' => Carbon::parse(request('date-range-to')),
            'qr_code' => $qr_code,
        ];
        $participant = Participants::create($data);
        if ($participant == true) {
            $message = [
                'status' => true,
                'token' => $data['qr_code'],
                'phone_number' => $data['no_hp'],
                'email' => $data['email'],
                'participant_id' => $data['participant_id']
            ];
        } else {
            $message = [
                'status' => false,
            ];
        }
        return $message;

    }

    function update($id) {
        $data = [
            'event_id' => request('event_id'),
            'name' => request('name'),
            'jabatan' => request('jabatan'),
            'no_hp' => request('no_hp'),
            'email' => request('email'),
            'instansi' => request('instansi'),
            'alamat_instansi' => request('alamat_instansi'),
            'tanggal_kedatangan' => Carbon::parse(request('date-range-from')),
            'penginapan' => request('penginapan'),
            'tanggal_kembali' => Carbon::parse(request('date-range-to')),
        ];
        Participants::where('participant_id',$id)->first()->update($data);
    }

    function delete($id) {
        Participants::where('participant_id',$id)->first()->delete();
    }

    function import($arr) {
        $latestParticipant = Participants::latest()->first();
        if ($latestParticipant) {
            $lastNumber = intval(substr($latestParticipant->participant_id, 1));
        } else {
            $lastNumber = 0;
        }

        foreach ($arr as $key => $value) {
            do {
                $qr_code = Str::random(10);
                $count = Participants::where('qr_code', $qr_code)->count();
            } while ($count > 0);

            $newNumber = $lastNumber + 1;
            $newParticipantId = 'P' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

            if ($key == 0) {
                continue;
            }

            Participants::create([
                'participant_id' => $newParticipantId,
                'event_id' => 1,
                'name' => $value['nama'],
                'jabatan' => $value['jabatan'],
                'no_hp' => $value['no_hp'] ?? '-',
                'instansi' => $value['instansi'],
                'alamat_instansi' => $value['alamat_instansi'],
                'tanggal_kedatangan' => Carbon::parse($value['tanggal_kedatangan']),
                'penginapan' => $value['penginapan'],
                'tanggal_kembali' => Carbon::parse($value['tanggal_kembali']),
                'qr_code' => $qr_code,
                'created_at' => $value['created_at'],
            ]);
            $lastNumber = $newNumber;
        }
    }
}
