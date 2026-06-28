<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-danger']) }}
    style="background:#DC2626;color:white;padding:8px 16px;border-radius:6px;font-weight:600;border:none;cursor:pointer">
    {{ $slot }}
</button>
