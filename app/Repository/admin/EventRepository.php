<?php

namespace App\Repository\admin;

use Exception;
use App\Events;
use App\Participants;
use Carbon\Carbon;
use Illuminate\Support\Str;

class EventRepository
{
    function getSingleData($id) {
        $data = Events::find($id);
        return $data;
    }

    function getData($n) {
        $search = request('search');
        $data = Events::orderBy('id', 'asc');
        if ($search) {
            $data = $data->where('name', 'like', '%' . $search . '%');
        }
        return $data->paginate($n);
    }

    function add() {
        $request_start_time = request('start_time');
        $request_end_time = request('end_time');
        $start_date = Carbon::parse(request('date-range-from'))->format('Y-m-d');
        $end_date = Carbon::parse(request('date-range-to'))->format('Y-m-d');

        // Membuat instansi Carbon dari nilai yang diterima dengan format yang sesuai
        $carbonStartTime = Carbon::createFromFormat('g : i A', $request_start_time);
        $carbonEndTime = Carbon::createFromFormat('g : i A', $request_end_time);

        // Menggunakan format 'H:i:s' untuk memformat waktu
        $start_time = $carbonStartTime->format('H:i:s');
        $end_time = $carbonEndTime->format('H:i:s');
        $datetime = Carbon::parse(request('date-range-from') . ' ' . $start_time)->format('Y-m-d H:i:s');
        if ($datetime < Carbon::now()->format('Y-m-d H:i:s')) {
            return [
                'status' => false,
                'message' => 'Date start must be greater than today'
            ];
        }
        // Generate unique token
        $token = Str::random(32); // Menghasilkan token acak dengan panjang 32 karakter
        // Periksa keunikan token
        while (Events::where('token', $token)->exists()) {
            $token = Str::random(32);
        }
        $data = [
            'name' => request('name'),
            'location' => request('location'),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'token' => $token,
            'status' => request('status')
        ];
        Events::create($data);
    }

    function update($id) {
        $request_start_time = request('start_time');
        $request_end_time = request('end_time');
        $start_date = Carbon::parse(request('date-range-from'))->format('Y-m-d');
        $end_date = Carbon::parse(request('date-range-to'))->format('Y-m-d');

        // Membuat instansi Carbon dari nilai yang diterima dengan format yang sesuai
        $carbonStartTime = Carbon::createFromFormat('g : i A', $request_start_time);
        $carbonEndTime = Carbon::createFromFormat('g : i A', $request_end_time);

        // Menggunakan format 'H:i:s' untuk memformat waktu
        $start_time = $carbonStartTime->format('H:i:s');
        $end_time = $carbonEndTime->format('H:i:s');
        $datetime = Carbon::parse(request('date-range-from') . ' ' . $start_time)->format('Y-m-d H:i:s');
        if ($datetime < Carbon::now()->format('Y-m-d H:i:s')) {
            return [
                'status' => false,
                'message' => 'Date start must be greater than today'
            ];
        }
        $data = [
            'name' => request('name'),
            'location' => request('location'),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => request('status')
        ];
        Events::find($id)->update($data);
    }

    function delete($id) {
        Events::find($id)->delete();
    }

    function getSingleEvent($token) {
        $data = Events::where('token', $token)->first();
        return $data;
    }

    function processRegister($token) {
        $event = Events::where('token', $token)->first();
        $participants = Participants::whereHas('Event', function($event) use($token) {
            $event->where('token', $token);
        });

        //check email sudah ada atau belum
        if (count($participants->where('email', request('email'))->get()) > 0) {
            return [
                'status' => false,
                'message' => 'You Email already registered for this event'
            ];
        }

        //check phone sudah ada atau belum
        if (count($participants->where('phone', request('phone'))->get()) > 0) {
            return [
                'status' => false,
                'message' => 'You Phone number already registered for this event'
            ];
        }

        $participants = $participants->get();

        //check event masih aktif atau tidak
        if ($event->status != 'active') {
            return [
                'status' => false,
                'message' => 'Event is not active'
            ];
        }

        if (count($participants) != 0) {
            return [
                'status' => false,
                'message' => 'You have already registered for this event'
            ];
        }

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
            'instansi' => request('instansi'),
            'alamat_instansi' => request('alamat_instansi'),
            'tanggal_kedatangan' => Carbon::parse(request('date-range-from')),
            'penginapan' => request('penginapan'),
            'tanggal_kembali' => Carbon::parse(request('date-range-to')),
            'qr_code' => $qr_code,
        ];
        Participants::create($data);

        return [
            'status' => true,
            'message' => 'Registration success',
            'token' => $qr_code
        ];
    }
}
