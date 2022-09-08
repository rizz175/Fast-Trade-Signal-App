;

<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-sm-6 col-xl-3" id="cross_rate">
        <div class="card card-body bg-blue-400 has-bg-image">
            <div class="media">
                <div class="media-body" >
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">Currency Cross Rates</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-stats-dots icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-xl-3" id="fx_currency">
        <div class="card card-body bg-danger-400 has-bg-image">
            <div class="media">
                <div class="media-body">
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">Cryptocurrency Rates Widget</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-stats-dots icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3" id="cr_currency">
        <div class="card card-body bg-success-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-calendar icon-3x opacity-75"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">ICO Calendar</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3" id="ec_calender">
        <div class="card card-body bg-indigo-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-calendar22 icon-3x opacity-75"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0"></h3>
                    <span class="text-uppercase font-size-xs">Echonomic Calender</span>
                </div>
            </div>
        </div>
    </div>
</div>


<iframe id="cross_rate_show" style='display:none' src="https://www.widgets.investing.com/live-currency-cross-rates?theme=darkTheme&cols=bid,prev,high,low,change,changePerc,time&pairs=1,3,2,4,7,5,8,6,9,10,49,11,13,16,47,51,58,50,53,15,12,52,48,55,54,18" width="100%" height="600" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe>


<iframe id="fx_currency_show" style='display:none' src="https://www.widgets.investing.com/crypto-currency-rates?theme=darkTheme&cols=bid,last,prev,high,low,change,changePerc,time&pairs=945629,997650,1031068,1130879,1071025,1179277,1073899,1075256,1161143,1070910,1070677,1057870,1070392,1070463,1155982,1062033,1056828,1070432,1060635,1122515,1070887,1070982,1089397,1093970,1179791,1142178,1070872,1118146,1118121,1070628" width="100%" height="600" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe>

<iframe id="cr_currency_show" style='display:none' src="https://www.widgets.investing.com/ico-calendar?theme=darkTheme" width="100%" height="600" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe>

<iframe id="ec_calender_show" style='display:none' src="https://sslecal2.investing.com?columns=exc_flags,exc_currency,exc_importance,exc_actual,exc_forecast,exc_previous&category=_employment,_economicActivity,_inflation,_credit,_centralBanks,_confidenceIndex,_balance,_Bonds&importance=1,2,3&features=datepicker,timezone,timeselector,filters&countries=25,32,6,72,17,35,43,12,63,4,5&calType=day&timeZone=63&lang=1" width="650" height="467" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).on('click','#cross_rate',function(e){
         e.preventDefault();
         $('#cross_rate_show').show();
         $('#fx_currency_show').hide();
         $('#cr_currency_show').hide();
         $('#ec_calender_show').hide();
        });
        $(document).on('click','#fx_currency',function(e){
         e.preventDefault();
         $('#cross_rate_show').hide();
         $('#fx_currency_show').show();
         $('#cr_currency_show').hide();
         $('#ec_calender_show').hide();
        });
        $(document).on('click','#cr_currency',function(e){
         e.preventDefault();
         $('#cross_rate_show').hide();
         $('#fx_currency_show').hide();
         $('#cr_currency_show').show();
         $('#ec_calender_show').hide();
        });
        $(document).on('click','#ec_calender',function(e){
         e.preventDefault();
         $('#cross_rate_show').hide();
         $('#fx_currency_show').hide();
         $('#cr_currency_show').hide();
         $('#ec_calender_show').show();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\signal\resources\views/dashboard.blade.php ENDPATH**/ ?>