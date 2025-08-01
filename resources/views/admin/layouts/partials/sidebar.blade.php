<!--begin::Sidebar-->
<aside class="app-sidebar bg-dark-subtle" data-bs-theme="dark">
  <div class="sidebar-brand">
    <a href="/dashboard" class="brand-link">
      <img src="{{ asset('member-assets/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
      <span class="brand-text fw-light">Candy Pulsa</span>
    </a>
  </div>

  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        
        <!-- Inbox Prosesor -->
        <li class="nav-item d-flex justify-content-between align-items-center px-2">
          <a href="#" class="nav-link d-flex align-items-center">
            <i class="nav-icon bi bi-inbox me-2"></i>
            <p class="mb-0">Inbox Prosesor</p>
          </a>
          <div class="form-check form-switch">
            <input class="form-check-input inbox-switch" type="checkbox" id="switchInboxProsesor" {{ $settings['inbox_proses'] == 1 ? 'checked' : '' }}>
          </div>
        </li>

        <!-- Trx Prosesor -->
        <li class="nav-item d-flex justify-content-between align-items-center px-2">
          <a href="#" class="nav-link d-flex align-items-center">
            <i class="nav-icon bi bi-cpu me-2"></i>
            <p class="mb-0">Trx Prosesor</p>
          </a>
          <div class="form-check form-switch">
            <input class="form-check-input trx-switch" type="checkbox" id="switchTrxProsesor" {{ $settings['trx_prosessor'] == 1 ? 'checked' : '' }}>
          </div>
        </li>

        <!-- Modul IP -->
        <li class="nav-item d-flex justify-content-between align-items-center px-2">
          <a href="#" class="nav-link d-flex align-items-center">
            <i class="nav-icon bi bi-hdd-network me-2"></i>
            <p class="mb-0">Modul IP</p>
          </a>
          <div class="form-check form-switch">
            <input class="form-check-input ip-switch" type="checkbox" id="switchModulIp" {{ $settings['trx_ip'] == 1 ? 'checked' : '' }}>
          </div>
        </li>

        <!-- Setting -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-gear-fill"></i>
            <p>Setting <i class="nav-arrow bi bi-chevron-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-diagram-3"></i><p>Parsing ke Provider</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-arrow-repeat"></i><p>Respon dari Provider</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-shield-exclamation"></i><p>Daftar Hitam</p></a></li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-sliders"></i>
                <p>Parameter</p>
              </a>
            </li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-code-slash"></i><p>Format Request</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-chat-left-text"></i><p>Format Balasan</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-reply-fill"></i><p>Auto Respon</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-tools"></i><p>Lain - Lain</p></a></li>
          </ul>
        </li>

        <!-- Produk -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-box-fill"></i>
            <p>Produk <i class="nav-arrow bi bi-chevron-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-search"></i><p>HLR</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-cart4"></i><p>Produk</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-ticket-perforated"></i><p>Voucher Fisik</p></a></li>
          </ul>
        </li>

        <!-- Member -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-person-lines-fill"></i>
            <p>Member <i class="nav-arrow bi bi-chevron-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="{{ route('admin.reseller.index') }}" class="nav-link"><i class="bi bi-people-fill"></i><p>Reseller</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-send"></i><p>Pengirim</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-diagram-3"></i><p>Jaringan Downline</p></a></li>
          </ul>
        </li>

        <!-- Bank -->
        <li class="nav-item menu-parent" data-parent-type="bank">
          <a href="#" class="nav-link context-parent-trigger">
            <i class="nav-icon bi bi-bank"></i>
            <p>Bank</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-circle"></i><p>Contoh BCA</p></a></li>
          </ul>
        </li>

        <!-- Supplier -->
        <li class="nav-item menu-parent" data-parent-type="supplier">
          <a href="#" class="nav-link context-parent-trigger">
            <i class="nav-icon bi bi-plugin"></i>
            <p>Supplier <i class="nav-arrow bi bi-chevron-right ms-2"></i></p>
          </a>
          <ul class="nav nav-treeview">
          </ul>
        </li>

        <!-- WhatsApp Center -->
        <li class="nav-item menu-parent" data-parent-type="wa">
          <a href="#" class="nav-link context-parent-trigger">
            <i class="nav-icon bi bi-whatsapp"></i>
            <p>WhatsApp Center <i class="nav-arrow bi bi-chevron-right ms-2"></i></p>
          </a>
          <ul class="nav nav-treeview">
         
          </ul>
        </li>

        <!-- Transaksi -->
        <li class="nav-item {{ request()->is('admin/transaksi*') || request()->is('admin/inbox*') || request()->is('admin/outbox*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('admin/transaksi*') || request()->is('admin/inbox*') || request()->is('admin/outbox*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-arrow-left-right"></i>
            <p>
              Transaksi
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link {{ request()->is('admin/transaksi') ? 'active' : '' }}">
                <i class="bi bi-cash-stack nav-icon"></i>
                <p>Transaksi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#}" class="nav-link {{ request()->is('admin/inbox') ? 'active' : '' }}">
                <i class="bi bi-inbox-fill nav-icon"></i>
                <p>Inbox</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link {{ request()->is('admin/outbox') ? 'active' : '' }}">
                <i class="bi bi-send-check nav-icon"></i>
                <p>Outbox</p>
              </a>
            </li>
          </ul>
        </li>


        <!-- Mutasi -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-currency-exchange"></i>
            <p>Mutasi <i class="nav-arrow bi bi-chevron-right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-person-bounding-box"></i><p>Mutasi Saldo Member</p></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-briefcase"></i><p>Mutasi Saldo Suplier</p></a></li>
          </ul>
        </li>

        <!-- setting web -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-gear"></i>
            <p>
              Setting Web
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="bi bi-globe"></i>
                <p>Landing Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="bi bi-people-fill"></i>
                <p>Reseller Area</p>
              </a>
            </li>
          </ul>
        </li>


        <!-- Logout -->
        <li class="nav-item">
          <form action="#" method="POST">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-start">
              <i class="nav-icon bi bi-box-arrow-right"></i>
              <p>Logout</p>
            </button>
          </form>
        </li>

        <!-- Log Sistem -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-list-task me-2"></i>
            <p>Log Sistem</p>
          </a>
        </li>

        

      </ul>
    </nav>
  </div>
</aside>
<!--end::Sidebar-->
