
<!doctype html>
<html lang="en">
@include('admin.layouts.partials.head')

  <!--begin::Body-->
    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

     @include('admin.layouts.partials.header') 

       @include('admin.layouts.partials.sidebar') 

      

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
      
            @yield('content')
            
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

      @include('admin.layouts.partials.footer') 
      
    </div>
    <!--end::App Wrapper-->
     @include('admin.layouts.partials.klikkanan') 
     @include('admin.layouts.partials.popup') 
     @include('admin.layouts.partials.script') 
     @stack('scripts')
  </body>
  <!--end::Body-->
</html>
