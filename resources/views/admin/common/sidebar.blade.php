<aside class="sidebar-wrapper">
    <div class="sidebar sidebar-collapse" id="sidebar">
        <div class="sidebar__menu-group">
            <ul class="sidebar_nav">
                <li class="menu-title">
                    <span>Main menu</span>
                </li>
                @foreach (Helper::getAdminMenu() as $item)
                    @if (empty($item->Modules))
                        <li>
                            <a href="{{ '/' . $item->route }}" class="@if (strtolower($item->route) == strtolower(Helper::getCurrentUrlAdmin())) active @endif">
                                <span data-feather="{{ $item->icon }}" class="nav-icon"></span>
                                <span class="menu-text">{{ $item->name }}</span>
                            </a>
                        </li>
                    @else
                        @php
                            $check = Helper::getCurrentUrlAdmin() == 'admins' || Helper::getCurrentUrlAdmin() == 'roles' || Helper::getCurrentUrlAdmin() == 'authorizations';
                        @endphp
                        <li class="has-child @if ($check == true) open @endif">
                            <a href="#" class="@if ($check == true) active @endif">
                                <span data-feather="{{ $item->icon }}" class="nav-icon"></span>
                                <span class="menu-text">{{ $item->name }}</span>
                                <span class="toggle-icon"></span>
                            </a>
                            <ul>
                                @foreach ($item->Modules as $i)
                                    <li>
                                        <a class="{{ Helper::getCurrentUrlAdmin() == $item->route ? 'active' : '' }}"
                                            href="{{ '/' . $i->route }}">
                                            {{ $i->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</aside>
