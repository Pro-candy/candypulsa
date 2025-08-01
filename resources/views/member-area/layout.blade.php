<!doctype html>
<html lang="en">
  <head>
    {{-- GANTI: Panggil partial head --}}
    @include('member-area.partial.head')
  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
      @include('member-area.partial.header')
      @include('member-area.partial.sidebar')

      <main class="app-main">
        @yield('content')
      </main>

      @include('member-area.partial.footer')
    </div>
    @include('member-area.partial.popup-modal')
    @include('member-area.partial.script')
    @stack('scripts')
  </body>
</html>