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
                    {{-- <th>
                        <span class="userDatatable-title float-right">Action</span>
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                @if (count($events) == 0)
                    <tr>
                        <td colspan="3">
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
                                {{ $value->start_date }} | {{ $value->start_time }} until {{ $value->end_date }} |
                                {{ $value->end_time }}
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content">
                                @if ($value->status == 'active')
                                    <a href="{{ route('events_register', ['name' => Helper::strReplace($value->name, ' ', '-')]) }}"
                                        target="_blank">Link
                                        Pendaftaran</a>
                                @else
                                    <s>Link Pendaftaran</s>
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
    </div>
</div>
