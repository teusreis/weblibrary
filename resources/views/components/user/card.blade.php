@props(['photo', 'username', 'name', 'email'])

<div {{ $attributes->merge(['class' => 'd-flex']) }}>
    <div
        style="width: 50px"
        class="me-2"
    >
        @if (!empty($photo))
            <img
                class="rounded-circle d-block mx-auto"
                src="{{ asset('storage/' . $photo) }}"
                width="100%"
                alt="profile pic"
            >
        @else
            <img
                class="rounded-circle d-block mx-auto profile-img"
                src="{{ asset('imgs/avatar.png') }}"
                width="25px"
                alt="profile pic"
            >
        @endif
    </div>

    <div class="d-flex flex-column justify-content-between ">
        <h3 class="h5 mb-0">
            <a
                href="{{ route('profile.show', $username) }}"
                class="text-dark text-decoration-none"
            >
                {{ $name }}
            </a>
        </h3>
        <p class="mb-0">{{ $email }}</p>
    </div>
</div>
