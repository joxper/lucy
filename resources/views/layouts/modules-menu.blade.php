@if ($count)
    <li class="heading"><h3 class="uppercase">{{ strtoupper(trans('lucy.word.modules')) }}</h3></li>
    @foreach ($menus as $menu)
        <li{!! (Request::is((empty($menu->url) ? snake_case($menu->name) : $menu->url).'*')) ? ' class="active"' : '' !!}>
            <a href="/{!! empty($menu->url) ? snake_case($menu->name) : $menu->url !!}" title="{{ $menu->name }}">
                <i class="fa {{ $menu->icon }}"></i> <span>{{ $menu->name }}</span>
            </a>
        </li>
    @endforeach
@endif