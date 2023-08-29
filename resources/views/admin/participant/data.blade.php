@if (count($participants) == 0)
    <tr>
        <td colspan="5">
            <div class="userDatatable-content text-center">
                No data
            </div>
        </td>
    </tr>
@endif
@foreach ($participants as $key => $value)
    <tr>
        <td>
            <div class="userDatatable-content">
                {{ $value->participant_id }}
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                {{ $value->name }}
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                {{ $value->jabatan }}
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                {{ $value->instansi }}
            </div>
        </td>
        <td>
            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                {{-- <li>
                    <a href="#" class="view">
                        <img src="{{ asset('icons/eye.svg') }}" width="16" alt=""></a>
                </li> --}}
                <li>
                    <a href="{{ route('participant_edit_view', $value->participant_id) }}" class="edit">
                        <img src="{{ asset('icons/edit.svg') }}" width="16" alt=""></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="remove" onclick="deleteData('{{ $value->participant_id }}')">
                        <img src="{{ asset('icons/trash-2.svg') }}" width="16" alt=""></a>
                </li>
            </ul>
        </td>
    </tr>
@endforeach
