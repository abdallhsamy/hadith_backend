<nav class="h-12 px-4 flex items-center justify-between gap-4">

    <i data-feather="align-justify" class="text-primary"></i>

    <div class="flex items-center justify-between gap-4">
        <i data-feather="bell" class="text-xs text-[#475569]"></i>

        <img src="{{ auth()->user()->avatar }}" alt="user avatar"
             class="w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
    </div>
</nav>

