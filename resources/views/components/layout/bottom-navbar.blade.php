<div
    class="d-flex justify-content-between mt-auto w-full text-white p-2 rounded-top rounded-5 d-block d-md-none bg-purple"
    id="bottom-navbar"
>
    <a
        class="text-white"
        href="{{ route('home') }}"
    >
        <x-icons.home />
    </a>

    <a
        class="text-white"
        href="{{ route('search') }}"
    >
        <x-icons.search />
    </a>

    <a
        class="text-white"
        href="{{ route('people') }}"
    >
        <x-icons.people />
    </a>

    <a
        class="text-white"
        href="{{ route('saves') }}"
    >
        <x-icons.bookmark />
    </a>

    @auth
        <div class="nav-item dropdown">
            <a
                class="nav-link dropdown-toggle p-0 m-0"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="currentColor"
                    class="bi bi-circle-fill text-white"
                    viewBox="0 0 16 16"
                >
                    <circle
                        cx="8"
                        cy="8"
                        r="8"
                    />
                </svg>
            </a>
            <ul class="dropdown-menu">
                <li><a
                        class="dropdown-item text-dark"
                        href="{{ route('profile.show', ['profile' => auth()->user()->profile->username]) }}"
                    >Perfil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form
                        action="{{ route('logout') }}"
                        method="post"
                    >
                        @csrf
                        <button
                            class="dropdown-item text-dark"
                            href="#"
                        >Sair</button>
                    </form>
                </li>

            </ul>
        </div>
    @endauth

</div>
