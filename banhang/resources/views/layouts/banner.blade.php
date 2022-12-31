   @if ($shop != null)
       @if ($shop->hinh_banner != null)
           <section class="breadcrumb-section set-bg" data-setbg="{{ URL($shop->hinh_banner) }}">
           @else
            <section class="breadcrumb-section set-bg" data-setbg="{{ URL('assets/img/breadcrumb.jpg') }}">
       @endif
   @endif

   <div class="container">
       <div class="row">
           <div class="col-lg-12 text-center">
               <div class="breadcrumb__text nd-banner" id="nd-banner">
                 
               </div>
           </div>
       </div>
   </div>
   </section>
