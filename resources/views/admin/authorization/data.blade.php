<div class="table4  p-25 bg-white mb-30">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr class="userDatatable-header">
                    <th scope="col-md" width="40%" class="text-center">Menu</th>
                    @foreach ($type as $i)
                        @if (ucwords($i->name) == 'view' ||
                                ucwords($i->name) == 'add' ||
                                ucwords($i->name) == 'edit' ||
                                ucwords($i->name) == 'delete')
                            <th class="text-center" scope="col" width="15%">
                                {{ __('lang.' . $i->name) }}</th>
                        @else
                            <th scope="col-md" class="text-center" width="15%">{{ ucwords($i->name) }}</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($menu as $m)
                    <tr>
                        <td class="text-center">
                            <div class="userDatatable-content">
                                {{ $m->name }}
                            </div>
                        </td>
                        @foreach ($type as $i)
                            <td class="text-center">
                                <div class="userDatatable-content">
                                    <input class="toast-top-center" type="checkbox" name="menu_tipe[]"
                                        value="{{ $m->id . '_' . $i->id }}"
                                        @foreach ($authorization as $j) @if ($j->module_id . '_' . $j->authorization_type_id == $m->id . '_' . $i->id) checked @else @endif @endforeach>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
