@if (count($attendances) == 0)
    <tr>
        <td colspan="4">
            <div class="userDatatable-content text-center">
                No data
            </div>
        </td>
    </tr>
@endif
@foreach ($attendances as $key => $value)
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
                {{ $value->Event->name }}
            </div>
        </td>
        <td>
            <div class="userDatatable-content">
                @if (count($value->Attendance) != 0)
                    <span class="media-badge color-white bg-success">Hadir</span>
                @else
                    <span class="media-badge color-white bg-danger">Tidak Hadir</span>
                @endif
            </div>
        </td>
    </tr>
@endforeach
