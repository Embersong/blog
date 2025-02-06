<ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index') }}">Посты</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.categories.index') }}">Категории</a>
    </li>
    @guest
    @else
        @if (Auth::user()->is_admin)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">Админка</a>
            </li>
        @endif
    @endguest
</ul>
