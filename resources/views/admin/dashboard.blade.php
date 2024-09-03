@extends('layouts.master')
@section('title')
Dashboard
@endsection
@section('css')
<link href="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<style>
   @media(max-width:500px){
   .page-title-box h4 {
   align-items: self-start;
   flex-direction: column;
   }
   }
</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Admin
@endslot
@slot('title')
Dashboard
@endslot
@slot('page_title')
<span class="dashboard-title">Dashboard</span>
@endslot
@endcomponent
<div class="row">
   <div class="col-xl-3 col-lg-4 col-md-12">
      <div class="mini-stats-wid card card-blue-bg dash-profit">

         <div class="card-body">
            <div class="d-flex">
               <div class="flex-grow-1">
                  <p class="text-white fw-medium">Total Subscriber</p>
                  <h4 class="mb-0 text-white"><span class="total_profit">10</span></h4>
               </div>
               <div class="avatar-md rounded-circle bg-primary align-self-center mini-stat-icon"
                 ><span class="avatar-title rounded-circle bg-primary bg-icon-blue"><i
                  class="bx bx bx-dollar font-size-24  text-blue"></i></span></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3 col-lg-4 col-md-12">
      <div class="card mb-3">
         <a href="#">
            <div class="card-body">
               <div class="commission-desc-icb">
                  <div class="commission-desc">
                     <div class="d-flex align-items-center space-between mb-2">
                        <h4 class="font-size-18 mb-0">Total Active Subscription</h4>
                     </div>
                     <div class="d-flex align-items-center space-between">
                        <h5 class="font-size-20 mb-0 txt-bold "><span class="ds_total_stat">10</span> <i class="fas fa-plus ms-1 text-success"></i></h5>
                     </div>

                  </div>
                  <div class="commission-icon">
                     <div class="d-flex align-items-center">
                        <div class="avatar-sm">
                           <span class="avatar-title rounded bg-violet-soft text-violet font-size-30">
                              <i class="bx bx-money"></i>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </div>
</div>
<div class="row mt-5">
</div>
@endsection
@section('script')
<script src="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
   $(document).ready(function() {
       $(function(){
       });
       $("body").on("click","#searchfilter",function(){
       });
       $("body").on("click","#searchclear, .all",function(){
       });
   });
   
</script>
@endsection