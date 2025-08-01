
        <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
                </a>
            </li>
            <li>
                <h5><a class="nav-link"  href="{{ route('reseller.dashboard') }}"> Dashboard</a></h5>
            </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                
            <!-- bagian notifikasi outbox_reseller -->
            <li class="nav-item dropdown">
                
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-chat-text"></i>
                    @if($outboxUnreadCount > 0)
                        <span class="navbar-badge badge text-bg-danger">{{ $outboxUnreadCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    @forelse($outboxUnreadList as $msg)
                        <a href="#" class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title" style="white-space:normal; word-break:break-word;">
                                        {{ $msg->keterangan ?? '---' }}
                                        <span class="float-end fs-7 text-danger">
                                            <i class="bi bi-star-fill"></i>
                                        </span>
                                    </h3>
                                    <p class="fs-7 pesan-singkat" data-id="{{ $msg->id }}" style="white-space:normal; word-break:break-word; cursor:pointer;">
                                        {{ $msg->pesan }}
                                        <span class="text-primary baca-detail" style="display:none;">... baca</span>
                                    </p>
                                    <p class="fs-7 text-secondary mb-0">
                                        <i class="bi bi-clock-fill me-1"></i>
                                        {{ \Carbon\Carbon::parse($msg->created_at)->format('d-M-Y H:i:s') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        @if (!$loop->last)
                            <div class="dropdown-divider"></div>
                        @endif
                    @empty
                        <div class="dropdown-item text-center text-secondary">
                            Tidak ada notifikasi baru
                        </div>
                    @endforelse

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('inbox-reseller.index') }}" class="dropdown-item dropdown-footer">Lihat semua pesan</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('inbox-reseller.markAllRead') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="dropdown-item dropdown-footer text-center" style="width:100%;text-align:left;">Tandai sudah dibaca semua</button>
                    </form></div> 
            </li>

           <!-- bagian pengumuman -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    @if($pengumumanUnreadCount > 0)
                        <span class="navbar-badge badge text-bg-warning">{{ $pengumumanUnreadCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">
                        <b>{{ $pengumumanUnreadCount }}</b> info pengumuman
                    </span>
                    <div class="dropdown-divider"></div>
                    @forelse($pengumumanUnreadList as $info)
                    <a href="javascript:void(0)" class="dropdown-item lihat-pengumuman" data-id="{{ $info->id }}">
                        <i class="bi"></i>
                        <b>{{ $info->judul }}</b>
                        <span class="float-end text-secondary fs-7">{{ $info->created_at->diffForHumans() }}</span>
                        <p class="mb-0" style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                            {{ $info->isi }}
                            <span class="text-primary">...klik untuk baca</span>
                        </p>
                    </a>
                    <div class="dropdown-divider"></div>
                @empty
                    <div class="dropdown-item text-center text-secondary">
                        Tidak ada pengumuman baru
                    </div>
                @endforelse
                    <a href="{{ route('pengumuman.index') }}" class="dropdown-item dropdown-footer">lihat semua pengumuman</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>

            <!-- bagian profil -->
            @php
                $reseller = auth()->guard('reseller')->user();
            @endphp
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img
                        src="{{ $reseller->link_foto_profile ? asset('storage/' . $reseller->link_foto_profile) : asset('member-assets/assets/img/user2-160x160.jpg') }}"
                        class="user-image rounded-circle shadow"
                        alt="User Image"
                    />
                    <span class="d-none d-md-inline">{{ $reseller->kode }} - {{ $reseller->nama }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img
                            src="{{ $reseller->link_foto_profile ? asset('storage/' . $reseller->link_foto_profile) : asset('member-assets/assets/img/user2-160x160.jpg') }}"
                            class="rounded-circle shadow"
                            alt="User Image"
                        />
                        <p>
                            {{ $reseller->kode }} - {{ $reseller->nama }}
                            <small>Terdaftar sejak {{ \Carbon\Carbon::parse($reseller->created_at)->translatedFormat('M. Y') }}</small>
                        </p>
                    </li>
                    <li class="user-body">
                        <div class="row">
                            <div class="col-4 text-center">
                                <a href="{{ url('member-area/') }}">Transaksi</a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="{{ route('inbox-reseller.index') }}">Inbox</a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="{{ route('outbox-reseller.index') }}">Outbox</a>
                            </div>
                        </div>
                    </li>
                    <li class="user-footer d-flex justify-content-between">
                        <a href="{{ url('member-area/profile/') }}" class="btn btn-default btn-flat">Profile</a>
                        <form action="{{ route('reseller.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-flat">Log out</button>
                        </form>
                    </li>
                </ul>
            </li>
            </ul>
        </div>
        </nav>