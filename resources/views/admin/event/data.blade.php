<div class="table4  p-25 bg-white mb-30">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr class="userDatatable-header">
                    <th>
                        <span class="userDatatable-title">No</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Event Name</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Datetime</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Registration Link</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Attendance Link</span>
                    </th>
                    {{-- <th>
                        <span class="userDatatable-title float-right">Action</span>
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                @if (count($events) == 0)
                    <tr>
                        <td colspan="5">
                            <div class="userDatatable-content text-center">
                                No data
                            </div>
                        </td>
                    </tr>
                @endif
                @foreach ($events as $key => $value)
                    <tr>
                        <td>
                            <div class="userDatatable-content">
                                {{ $key + $events->firstitem() }}
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content">
                                {{ $value->name }}
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content">
                                {{ \Carbon\Carbon::parse($value->start_date)->format('d M Y') }}
                                {{ \Carbon\Carbon::parse($value->start_time)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($value->end_date)->format('d M Y') }}
                                {{ \Carbon\Carbon::parse($value->end_time)->format('H:i') }}
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content">
                                @if ($value->status == 'active')
                                    <a href="{{ route('events_register', ['name' => Helper::strReplace($value->name, ' ', '-'), 'token' => $value->token]) }}"
                                        target="_blank">Link
                                        Pendaftaran</a>
                                @else
                                    <s>Link Pendaftaran</s>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content">
                                @if ($value->status == 'active')
                                    <a href="{{ route('events_attendance', ['name' => Helper::strReplace($value->name, ' ', '-'), 'token' => $value->token]) }}"
                                        target="_blank">Link
                                        Kehadiran</a>
                                @else
                                    <s>Link Kehadiran</s>
                                @endif
                            </div>
                        </td>
                        {{-- <td>
                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                            <li>
                                <a href="#" class="view">
                                    <img src="{{ asset('icons/eye.svg') }}" width="16" alt=""></a>
                            </li>
                            <li>
                                <a href="{{ route('event_edit_view', $value->id) }}" class="edit">
                                    <img src="{{ asset('icons/edit.svg') }}" width="16" alt=""></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="remove" onclick="deleteData({{ $value->id }})">
                                    <img src="{{ asset('icons/trash-2.svg') }}" width="16" alt=""></a>
                            </li>
                        </ul>
                    </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
</div>
