<div class="table4  p-25 bg-white mb-30">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr class="userDatatable-header">
                    <th>
                        <span class="userDatatable-title">No</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Participant Name</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Event Name</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Status</span>
                    </th>
                    <th>
                        <span class="userDatatable-title float-right">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($certificates) == 0)
                    <tr>
                        <td colspan="5">
                            <div class="userDatatable-content text-center">
                                No data
                            </div>
                        </td>
                    </tr>
                @endif
                @foreach ($certificates as $key => $value)
                    <tr>
                        <td>
                            <div class="userDatatable-content">
                                {{ $key + $certificates->firstitem() }}
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content">
                                {{ $value->Participant->name }}
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content">
                                {{ $value->Event->name }}
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content">
                                @switch($value->status)
                                    @case(1)
                                        <small class="badge badge-round badge-success badge-lg">Terikirim</small>
                                    @break

                                    @case(0)
                                        <small class="badge badge-round badge-danger badge-lg">Belum Terikirim</small>
                                    @break

                                    @default
                                @endswitch
                            </div>
                        </td>
                        <td>
                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                <li>
                                    <a href="{{ route('certificate_view', ['eventName' => $value->Event->name, 'qr_code' => $value->Participant->qr_code]) }}"
                                        target="_blank" class="view">
                                        <img src="{{ asset('icons/eye.svg') }}" width="16" alt=""></a>
                                </li>
                                <li>
                                    <a href="#" onclick="sendCertificate('{{ $value->participant_id }}')"
                                        class="edit">
                                        <img src="{{ asset('icons/send.svg') }}" width="16" alt=""></a>
                                </li>
                                {{-- <li>
                                <button class="btn btn-sm btn-default btn-warning"
                                    onclick="sendCertificate('{{ $value->participant_id }}')" type="button">
                                    <i class="la la-send"></i> Send Certificate
                                </button>
                            </li> --}}
                            </ul>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            {{ $certificates->links() }}
        </div>
    </div>
</div>
