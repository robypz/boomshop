<div class="mt-1">
    <div>
        <i class="bi bi-bell-fill position-relative notification-bell text-primary fs-4" aria-expanded="true" data-bs-toggle="offcanvas" id="btn-notification"
            data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">

        </i>
        @if ($count)
            <span class="position-absolute translate-middle badge rounded-pill bg-dark">
                {{ $count }}
                <span class="visually-hidden text-black">unread messages</span>
            </span>
        @endif
    </div>


    <div class="offcanvas offcanvas-start sidebar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-primary" id="offcanvasScrollingLabel">Notificaciones</h5>
            <i type="button" class="bi bi-x-lg" data-bs-dismiss="offcanvas" aria-label="Close"></i>
        </div>
        <div class="offcanvas-body">
            @foreach ($notifications as $notification)
                <div class="recharge-data {{ !$notification->read_at ? 'unread-notification' : 'notification' }} mb-2"
                    wire:click="read('{{ $notification->id }}')">
                    <a href="{{ $notification->data['url'] }}">
                        <div class="p-3">
                            <p class="text-justify boom-color-lightgray">{{ $notification->data['message'] }}</p>
                            <p class="boom-color-lightgray text-end">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>



</div>
