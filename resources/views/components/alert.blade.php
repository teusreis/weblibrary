@props(['message'])

<div
    class="alert alert-success alert-dismissible fade show alert-card"
    role="alert"
>
    {{ $message }}
    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
    ></button>
</div>
