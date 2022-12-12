@props(['message', 'photo', 'username', 'name', 'email'])

<div {{ $attributes->merge(['class' => 'p-2 border-bottom']) }}>
    <div>
        {{ $message }}
    </div>

    <x-user.card
        class="my-2 border-b"
        :photo="$photo"
        :username="$username"
        :name="$name"
        :email="$email"
    />
</div>
