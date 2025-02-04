<ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index') }}">Посты</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.categories.index') }}">Категории</a>
    </li>
    @auth()
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">Админка</a>
        </li>
    @endauth
</ul>
