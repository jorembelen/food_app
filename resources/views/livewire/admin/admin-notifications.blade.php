<div>

    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-bell bx-tada"></i>
            <span class="badge bg-danger rounded-pill">{{ auth()->user()->unreadNotifications()->count() }}</span>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col text-center">
                        <h6 class="m-0" key="t-notifications"> Notifications </h6>
                    </div>

                </div>
            </div>
            <div data-simplebar style="max-height: 230px;">
                @forelse ($notifications as $notification)
                    @php
                        $user = \App\Models\User::find($notification->data['userId']);
                    @endphp
                    <a href="{{ $notification->data['url'] }}" class="text-reset notification-item" wire:click="read('{{ $notification->id }}')">
                        <div class="d-flex">
                            <img avatar="{{ $user->getFullName() }}"
                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $user->getFullName() }}</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1" key="t-simplified">{{ $notification->data['data'] }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">{{ $notification->created_at->diffForHumans() }}</span></p>
                                </div>
                            </div>
                        </div>
                    </a>

                @empty
                <p class="text-center"> You have no unread notification</p>
                @endforelse

            </div>
            @if ($notifications->count() > 0)
            <div class="p-2 border-top d-grid">
                <a class="btn btn-sm btn-link font-size-14 text-center" href="#" wire:click="readAll">
                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">Mark all as Read</span>
                </a>
            </div>
            @endif
        </div>
    </div>

</div>
