@props(['id', 'cover', 'title', 'description', 'publishedDate' => null, 'isLikedByUser' => false, 'isSavedByUser' => false, 'user' => null])

<div {{ $attributes->merge(['class' => 'py-2']) }}>
    <img
        src="{{ asset('storage/' . $cover) }}"
        alt=""
        width="100%"
        class="d-block rounded"
    >

    <div class="my-3 py-1 d-flex justify-content-between align-items-center">
        <h3 class="my-auto">
            <a
                href="{{ route('post.show', $id) }}"
                class="text-decoration-none text-dark"
            >
                {{ $title }}
            </a>
        </h3>

        <div class="d-flex">
            <form
                action="{{ route('post.like', $id) }}"
                method="post"
                class="me-2"
            >
                @csrf
                <button class="border-0 m-0 p-0">
                    <x-icons.heart
                        :isLiked="$isLikedByUser"
                        class="submit-icon"
                    />
                </button>
            </form>

            <form
                action="{{ route('post.save', $id) }}"
                method="post"
            >
                @csrf
                <button class="border-0 m-0 p-0">
                    <x-icons.bookmark :isSaved="$isSavedByUser" />
                </button>
            </form>

        </div>
    </div>

    <p class="post-card-description">
        {{ $description }}
    </p>


    <div class="d-flex justify-content-between align-items-center">
        @if ($user)
            <x-user.card
                class="my-2"
                :photo="$user->profile->photo"
                :username="$user->profile->username"
                :name="$user->name"
                :email="$user->email"
            />
        @endif

        <p>
            {{ $publishedDate ?? '' }}
        </p>
    </div>
</div>


<script></script>
