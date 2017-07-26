<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/admin/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="/admin/img/reverse-favicon.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>@yield('title')</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />
  <!--  Social tags      -->
  <meta name="keywords" content="">
  <meta name="description" content="">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="">
  <meta itemprop="description" content="">
  <meta itemprop="image" content="">
  <!-- Bootstrap core CSS     -->
  <link href="/admin/css/bootstrap.min.css" rel="stylesheet" />
  <!--  Material Dashboard CSS    -->
  <link href="/admin/css/material-dashboard.css" rel="stylesheet" />
  <link href="/admin/css/app.css" rel="stylesheet" />
  <!--  CSS for Demo Purpose, don't include it in your project     -->
  <link href="/admin/css/demo.css" rel="stylesheet" />
  <!-- For progress bars -->
  <link rel="stylesheet" href="/admin/css/materialize.css">
  <!--     Fonts and icons     -->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<body>
  <div class="wrapper">
    @include('sudo.includes.sidebar')
    @yield('content')
  </div>
</body>
<!--   Core JS Files   -->
<script src="/admin/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="/admin/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="/admin/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/admin/js/material.min.js" type="text/javascript"></script>
<script src="/admin/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="/admin/js/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="/admin/js/moment.min.js"></script>
<!--  Charts Plugin -->
<script src="/admin/js/chartist.min.js"></script>
<!--  Plugin for the Wizard -->
<script src="/admin/js/jquery.bootstrap-wizard.js"></script>
<!--  Notifications Plugin    -->
<script src="/admin/js/bootstrap-notify.js"></script>
<!--   Sharrre Library    -->
<script src="/admin/js/jquery.sharrre.js"></script>
<!-- DateTimePicker Plugin -->
<script src="/admin/js/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin -->
<script src="/admin/js/jquery-jvectormap.js"></script>
<!-- Sliders Plugin -->
<script src="/admin/js/nouislider.min.js"></script>
<!-- Select Plugin -->
<script src="/admin/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin    -->
<script src="/admin/js/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="/admin/js/sweetalert2.js"></script>
<!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="/admin/js/jasny-bootstrap.min.js"></script>
<!-- TagsInput Plugin -->
<script src="/admin/js/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="/admin/js/material-dashboard.js"></script>

<!-- For progress bars -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
<script type="text/javascript">
  app = {
    initCharts: function(){

      /* ----------==========    Rounded Line Chart initialization    ==========---------- */

      dataRoundedLineChart = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
        [12, 17, 7, 17, 23, 18, 38]
        ]
      };

      optionsRoundedLineChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 10
        }),
        axisX: {
          showGrid: false,
        },
        low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
            showPoint: false
          }

          var RoundedLineChart = new Chartist.Line('#roundedLineChart', dataRoundedLineChart, optionsRoundedLineChart);

          md.startAnimationForLineChart(RoundedLineChart);


          /*  **************** Straight Lines Chart - single line with points ******************** */

          dataStraightLinesChart = {
            labels: ['\'07','\'08','\'09', '\'10', '\'11', '\'12', '\'13', '\'14', '\'15'],
            series: [
            [10, 16, 8, 13, 20, 15, 20, 34, 30]
            ]
          };

          optionsStraightLinesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 0
            }),
            low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
            classNames: {
              point: 'ct-point ct-white',
              line: 'ct-line ct-white'
            }
          }

          var straightLinesChart = new Chartist.Line('#straightLinesChart', dataStraightLinesChart, optionsStraightLinesChart);

          md.startAnimationForLineChart(straightLinesChart);


          /*  **************** Coloured Rounded Line Chart - Line Chart  SBERBANK ******************** */


          dataColouredRoundedLineChart = {
            labels: days,
            series: amounts
          };

          optionsColouredRoundedLineChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 10
            }),
            axisY: {
              showGrid: true,
              offset: 40
            },
            axisX: {
              showGrid: false,
            },
            low: 0,
            high: 1000,
            showPoint: true,
            height: '300px'
          };


          var colouredRoundedLineChart = new Chartist.Line('#colouredRoundedLineChart', dataColouredRoundedLineChart, optionsColouredRoundedLineChart);

          md.startAnimationForLineChart(colouredRoundedLineChart);


          /*  **************** Coloured Rounded Line Chart - Line Chart ******************** */


          dataColouredBarsChart = {
            labels: days,
            series: cashierValues
          };

          optionsColouredBarsChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
              tension: 10
            }),
            axisY: {
              showGrid: true,
              offset: 40
            },
            axisX: {
              showGrid: false,
            },
            low: 0,
            high: 1000,
            showPoint: true,
            height: '300px'
          };


          var colouredBarsChart = new Chartist.Line('#colouredBarsChart', dataColouredBarsChart, optionsColouredBarsChart);

          md.startAnimationForLineChart(colouredBarsChart);



          /*  **************** Public Preferences - Pie Chart ******************** */

          var dataPreferences = {
            labels: ['62%','32%','6%'],
            series: [62, 32, 6]
          };

          var optionsPreferences = {
            height: '230px'
          };

          Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

          /*  **************** Simple Bar Chart - barchart ******************** */

          var dataSimpleBarChart = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
            [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]
            ]
          };

          var optionsSimpleBarChart = {
            seriesBarDistance: 10,
            axisX: {
              showGrid: false
            }
          };

          var responsiveOptionsSimpleBarChart = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
          ];

          var simpleBarChart = Chartist.Bar('#simpleBarChart', dataSimpleBarChart, optionsSimpleBarChart, responsiveOptionsSimpleBarChart);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(simpleBarChart);


        var dataMultipleBarsChart = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          series: [
          [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895],
          [412, 243, 280, 580, 453, 353, 300, 364, 368, 410, 636, 695]
          ]
        };

        var optionsMultipleBarsChart = {
          seriesBarDistance: 10,
          axisX: {
            showGrid: false
          },
          height: '300px'
        };

        var responsiveOptionsMultipleBarsChart = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function (value) {
              return value[0];
            }
          }
        }]
        ];

        var multipleBarsChart = Chartist.Bar('#multipleBarsChart', dataMultipleBarsChart, optionsMultipleBarsChart, responsiveOptionsMultipleBarsChart);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(multipleBarsChart);
      }
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        app.initCharts();
        app.initFormExtendedDatetimepickers();
      });
    </script>



<!--<script>
  $('#card_number').on('', function(){
    if ($('#card_number').val().length > 5) {
        /**
         * SHOW PRELOADERS
         */
        preloaderTrips = '<div class=\"progress\" id=\"trips-preloader\"><div class=\"indeterminate\"></div></div>';
        preloaderInfo = '<div class=\"progress\" id=\"info-preloader\"><div class=\"indeterminate\"></div></div>';
        preloaderRefills = '<div class=\"progress\" id=\"refills-preloader\"><div class=\"indeterminate\"></div></div>';
        $('#refills-preloader').replaceWith(preloaderRefills);
        $('#info-preloader').replaceWith(preloaderInfo);
        $('#trips-preloader').replaceWith(preloaderTrips);
        /**
         * GET DATA
         */
        $.ajax({
          method: 'POST',
          url: url,
          data: { 
            num: $('#card_number').val(),
            serie: $('#card_serie').val(), 
            _token: token}
        })
        .done(function(msg){
          console.log(JSON.stringify(msg));
          if ((msg['message']) == 'error'){

          };
          if ((msg['message']) == 'success'){
            if (msg['data'].length == 0){
                html = '<h3 id=\"operations-results-none\" class=\"text-center\">Нет результатов</h3>';
                htmlNull = '<tbody id=\"operations-results\"></tbody>';
                $('#operations-results-none').replaceWith(html);
                $('#operations-results').replaceWith(htmlNull);
                html = '<h3 id=\"operations-results-none\"></h3>';

                balanceHtml = '<b id=\"current-balance\">' + msg.balance + ' р</b>';
                stateHtml = '<b id=\"current-state\">' + msg.state + '</b>';
                lastOperationHtml = '<b id=\"current-last-operation\">' + msg.last_operation + '</b>';

                $('#current-balance').replaceWith(balanceHtml);
                $('#current-state').replaceWith(stateHtml);
                $('#current-last-operation').replaceWith(lastOperationHtml);
                switch (msg.card_state) {
                    case 1:
                blockButtonHtml = '<div id=\"block-action\">' +
                                  '<form method=\"POST\" action=\"{{ route('sudo.block-card.post') }}\">' +
                                  '<input type=\"hidden\" id=\"serie\" value=\"' + $('#card_serie').val() + '\" name=\"card_serie\">' +
                                  '<input type=\"hidden\" value=\"' + $('#card_number').val() + '\" name=\"card_number\">' +
                                  '<input type=\"hidden\" value=\"02\" name=\"to_state\">' +
                                  '{{ csrf_field() }}' + 
                                  '<button type=\"submit\" class=\"btn btn-danger\" id=\"block-button\">Добавить в блок-лист<div class=\"ripple-container\"></div></button>' +
                                  '</form>' +
                                  '</div>'; 
                                  break;
                    case 3 :                
                blockButtonHtml = '<div id=\"block-action\">' +
                                  '<form method=\"POST\" action=\"{{ route('sudo.block-card.post') }}\">' +
                                  '<input type=\"hidden\" id=\"serie\" value=\"' + $('#card_serie').val() + '\" name=\"card_serie\">' +
                                  '<input type=\"hidden\" value=\"' + $('#card_number').val() + '\" name=\"card_number\">' +
                                  '<input type=\"hidden\" value=\"04\" name=\"to_state\">' +
                                  '{{ csrf_field() }}' + 
                                  '<button type=\"submit\" class=\"btn btn-danger\" id=\"block-button\">Разблокировать<div class=\"ripple-container\"></div></button>' +
                                  '</form>' +
                                  '</div>';  
                                  break;
                }
                $('#block-action').replaceWith(blockButtonHtml);

                preloaderTripsNull = '<div id=\"trips-preloader\"></div>';
                $('#trips-preloader').replaceWith(preloaderTripsNull);
                preloaderRefillsNull = '<div id=\"refills-preloader\"></div>';
                $('#refills-preloader').replaceWith(preloaderRefillsNull);
                preloaderInfoNull = '<div id=\"info-preloader\"></div>';
                $('#info-preloader').replaceWith(preloaderInfoNull);

                 /**
                 * [htmlTrips description]
                 * 
                 */
                htmlTrips = '<tbody id=\"trips-results\">';
                for (var i = 0; i <= msg['trips'].length - 1; i++) {
                    htmlTrips += "<tr><td>" + msg.trips[i].DATE_OF + "</td><td>" + msg.trips[i].ID_ROUTE + "</td><td class=\"text-right\">"  + msg.trips[i].AMOUNT + "</td><td class=\"text-right\">" + msg.trips[i].EP_BALANCE + "</td></tr>";
                }
                htmlTrips += '</tbody>';
                $('#trips-results').replaceWith(htmlTrips);
                preloaderTripsNull = '<div id=\"trips-preloader\"></div>';
                $('#trips-preloader').replaceWith(preloaderTripsNull);
            } else {
                html = '<tbody id=\"operations-results\">';
                htmlNull = '<h3 id=\"operations-results-none\"></h3>';
                for (var i = 0; i <= msg['data'].length - 1; i++) {
                    if (msg.data[i].terminal_number == 'SELLING'){
                        html += "<tr><td>" + msg.data[i].card_number + "</td><td>" + msg.data[i].transaction_number + "</td><td><span class='material-icons'>shopping_cart</span> Продажа</td><td class=\"text-right\">"  + msg.data[i].value + "</td><td class=\"text-right\">"  + msg.data[i].transaction_date + "</td></tr>";
                    } else 
                    html += "<tr><td>" + msg.data[i].card_number + "</td><td>" + msg.data[i].transaction_number + "</td><td>"  + msg.data[i].terminal_number + "</td><td class=\"text-right\">"  + msg.data[i].value + "</td><td class=\"text-right\">"  + msg.data[i].transaction_date + "</td></tr>";
                }
                html += '</tbody>';
                $('#operations-results-none').replaceWith(htmlNull);
                $('#operations-results').replaceWith(html);
                preloaderRefillsNull = '<div id=\"refills-preloader\"></div>';
                $('#refills-preloader').replaceWith(preloaderRefillsNull);
                /**
                 * [htmlTrips description]
                 * 
                 */
                htmlTrips = '<tbody id=\"trips-results\">';
                for (var i = 0; i <= msg['trips'].length - 1; i++) {
                    htmlTrips += "<tr><td>" + msg.trips[i].DATE_OF + "</td><td>" + msg.trips[i].ID_ROUTE + "</td><td class=\"text-right\">"  + msg.trips[i].AMOUNT + "</td><td class=\"text-right\">" + msg.trips[i].EP_BALANCE + "</td></tr>";
                }
                htmlTrips += '</tbody>';
                $('#trips-results').replaceWith(htmlTrips);
                preloaderTripsNull = '<div id=\"trips-preloader\"></div>';
                $('#trips-preloader').replaceWith(preloaderTripsNull);

                balanceHtml = '<b id=\"current-balance\">' + msg.balance + ' р</b>';
                stateHtml = '<b id=\"current-state\">' + msg.state + '</b>';
                lastOperationHtml = '<b id=\"current-last-operation\">' + msg.last_operation + '</b>';

                $('#current-balance').replaceWith(balanceHtml);
                $('#current-state').replaceWith(stateHtml);
                $('#current-last-operation').replaceWith(lastOperationHtml);
                switch (msg.card_state) {
                    case 1:
                blockButtonHtml = '<div id=\"block-action\">' +
                                  '<form method=\"POST\" action=\"{{ route('sudo.block-card.post') }}\">' +
                                  '<input type=\"hidden\" id=\"serie\" value=\"' + $('#card_serie').val() + '\" name=\"card_serie\">' +
                                  '<input type=\"hidden\" value=\"' + $('#card_number').val() + '\" name=\"card_number\">' +
                                  '<input type=\"hidden\" value=\"02\" name=\"to_state\">' +
                                  '{{ csrf_field() }}' + 
                                  '<button type=\"submit\" class=\"btn btn-danger\" id=\"block-button\">Добавить в блок-лист<div class=\"ripple-container\"></div></button>' +
                                  '</form>' +
                                  '</div>'; 
                                  break;
                    case 2 :                
                blockButtonHtml = '<div id=\"block-action\">' +
                                  '<form method=\"POST\" action=\"{{ route('sudo.block-card.post') }}\">' +
                                  '<input type=\"hidden\" id=\"serie\" value=\"' + $('#card_serie').val() + '\" name=\"card_serie\">' +
                                  '<input type=\"hidden\" value=\"' + $('#card_number').val() + '\" name=\"card_number\">' +
                                  '<input type=\"hidden\" value=\"04\" name=\"to_state\">' +
                                  '{{ csrf_field() }}' + 
                                  '<button type=\"submit\" class=\"btn btn-danger\" id=\"block-button\">Разблокировать<div class=\"ripple-container\"></div></button>' +
                                  '</form>' +
                                  '</div>';  
                                  break;
                }
                $('#block-action').replaceWith(blockButtonHtml); 
                if ($('#card_serie').val().length < 2){
                    $('#block-button').attr('disabled','disabled');
                }; 
                preloaderInfoNull = '<div id=\"info-preloader\"></div>';
                $('#info-preloader').replaceWith(preloaderInfoNull);
                /**
                 * HIDE PRELOADERS
                 */
            }
            html = '<tbody id=\"operations-results\"></tbody>';
        };
    });
    } else {
        $('#block-button').attr('disabled','disabled');    }
});
</script>  -->



<script>
  $('.operations-handler').on('keyup', function(){
    if ($('#card_number').val().length > 5) { 
  /**
  * SHOW PRELOADERS
  */
  preloaderTrips = '<div class=\"progress\" id=\"trips-preloader\"><div class=\"indeterminate\"></div></div>';
  preloaderInfo = '<div class=\"progress\" id=\"info-preloader\"><div class=\"indeterminate\"></div></div>';
  preloaderRefills = '<div class=\"progress\" id=\"refills-preloader\"><div class=\"indeterminate\"></div></div>';
  $('#refills-preloader').replaceWith(preloaderRefills);
  $('#info-preloader').replaceWith(preloaderInfo);
  $('#trips-preloader').replaceWith(preloaderTrips);
  /**
   * GET DATA
   */
   $.ajax({
    method: 'POST',
    url: url,
    data: { 
      num: $('#card_number').val(),
      serie: $('#card_serie').val(), 
      _token: token}
    })
   .done(function(msg){
    console.log(JSON.stringify(msg));
    if ((msg['message']) == 'error'){
      console.log('Произошла ошибка');
    };
    if ((msg['message']) == 'success'){
      /**
       * LOAD CARD DATA
       */
       balanceHtml = '<b id=\"current-balance\">' + msg.balance + ' р</b>';
       stateHtml = '<b id=\"current-state\">' + msg.state + '</b>';
       lastOperationHtml = '<b id=\"current-last-operation\">' + msg.last_operation + '</b>';
       curIsDouble = '<b id=\"cur-is-double\">' + msg.cur_is_double + '</b>';
       if (msg.double_cards !== null){
        doublicates = '<b id=\"card-double-info\">';
          for (var i = 0; i <= msg['double_cards'].length - 1; i++) {
          doublicates += i +'.)' + msg.double_cards[i].series + ' ' + msg.double_cards[i].num + ' ' + msg.double_cards[i].chip + ' ' + msg.double_cards[i].ep_balance_fact + 'р. ' + msg.double_cards[i].date_of_travel_doc_kind_last + '<br>';
       } doublicates += '</b>';
       } else doublicates = '<b id=\"card-double-info\">Повторных карт нет</b>';
       $('#current-balance').replaceWith(balanceHtml);
       $('#current-state').replaceWith(stateHtml);
       $('#current-last-operation').replaceWith(lastOperationHtml);
       $('#cur-is-double').replaceWith(curIsDouble);
       $('#card-double-info').replaceWith(doublicates);
       switch (msg.card_state) {
        case 1:
        blockButtonHtml = '<div id=\"block-action\">' +
        '<form method=\"POST\" action=\"{{ route('sudo.block-card.post') }}\">' +
        '<input type=\"hidden\" id=\"serie\" value=\"' + $('#card_serie').val() + '\" name=\"card_serie\">' +
        '<input type=\"hidden\" value=\"' + $('#card_number').val() + '\" name=\"card_number\">' +
        '<input type=\"hidden\" value=\"02\" name=\"to_state\">' +
        '{{ csrf_field() }}' + 
        '<button type=\"submit\" class=\"btn btn-danger\" id=\"block-button\">Добавить в блок-лист<div class=\"ripple-container\"></div></button>' +
        '</form>' +
        '</div>'; 
        blockInfoHtml = '<b id=\"card-block-info\"></b>'; 
        $('#card-block-info').replaceWith(blockInfoHtml);      
        break;
        case 2:
        blockButtonHtml = '<div id=\"block-action\">' +
        '<form method=\"POST\" action=\"{{ route('sudo.block-card.post') }}\">' +
        '<input type=\"hidden\" id=\"serie\" value=\"' + $('#card_serie').val() + '\" name=\"card_serie\">' +
        '<input type=\"hidden\" value=\"' + $('#card_number').val() + '\" name=\"card_number\">' +
        '<input type=\"hidden\" value=\"04\" name=\"to_state\">' +
        '{{ csrf_field() }}' + 
        '<button type=\"submit\" class=\"btn btn-danger\" id=\"block-button\">Убрать из блок-листа<div class=\"ripple-container\"></div></button>' +
        '</form>' +
        '</div>'; 
        blockInfoHtml = '<b id=\"card-block-info\">' + msg.blockedBy + '('+ msg.blockDate + ')' + '</b>'  
        $('#card-block-info').replaceWith(blockInfoHtml);      
        break;
        case 3 :                
        blockButtonHtml = '<div id=\"block-action\">' +
        '<form method=\"POST\" action=\"{{ route('sudo.block-card.post') }}\">' +
        '<input type=\"hidden\" id=\"serie\" value=\"' + $('#card_serie').val() + '\" name=\"card_serie\">' +
        '<input type=\"hidden\" value=\"' + $('#card_number').val() + '\" name=\"card_number\">' +
        '<input type=\"hidden\" value=\"04\" name=\"to_state\">' +
        '{{ csrf_field() }}' + 
        '<button type=\"submit\" class=\"btn btn-danger\" id=\"block-button\">Разблокировать<div class=\"ripple-container\"></div></button>' +
        '</form>' +
        '</div>';
        blockInfoHtml = '<b id=\"card-block-info\">' + msg.blockedBy + '('+ msg.blockDate + ')' + '</b>'  
        $('#card-block-info').replaceWith(blockInfoHtml);
        break;
        case 4:
        blockButtonHtml = '<div id=\"block-action\">' +
        '<form method=\"POST\" action=\"{{ route('sudo.block-card.post') }}\">' +
        '<input type=\"hidden\" id=\"serie\" value=\"' + $('#card_serie').val() + '\" name=\"card_serie\">' +
        '<input type=\"hidden\" value=\"' + $('#card_number').val() + '\" name=\"card_number\">' +
        '<input type=\"hidden\" value=\"02\" name=\"to_state\">' +
        '{{ csrf_field() }}' + 
        '<button type=\"submit\" class=\"btn btn-danger\" id=\"block-button\">Добавить в блок-лист<div class=\"ripple-container\"></div></button>' +
        '</form>' +
        '</div>'; 
        blockInfoHtml = '<b id=\"card-block-info\"></b>'; 
        $('#card-block-info').replaceWith(blockInfoHtml);      
        break;
      };
      $('#block-action').replaceWith(blockButtonHtml);      
      preloaderInfoNull = '<div id=\"info-preloader\"></div>';
      $('#info-preloader').replaceWith(preloaderInfoNull);
      /**
       * END OF LOAD CARD DATA
       */
      /**
       * LOAD REFILLS DATA
       */
       if (msg['data'].length > 0){
        html = '<tbody id=\"operations-results\">';
        htmlNull = '<h3 id=\"operations-results-none\"></h3>';
        for (var i = 0; i <= msg['data'].length - 1; i++) {
          if (msg.data[i].terminal_number == 'SELLING'){
            html += "<tr><td>" + msg.data[i].card_number + "</td><td>" + msg.data[i].transaction_number + "</td><td><span class='material-icons'>shopping_cart</span> Продажа</td><td class=\"text-right\">"  + msg.data[i].value + "</td><td class=\"text-right\">"  + msg.data[i].transaction_date + "</td></tr>";
          } else 
          html += "<tr><td>" + msg.data[i].card_number + "</td><td>" + msg.data[i].transaction_number + "</td><td>"  + msg.data[i].terminal_number + "</td><td class=\"text-right\">"  + msg.data[i].value + "</td><td class=\"text-right\">"  + msg.data[i].transaction_date + "</td></tr>";
        }
        html += '</tbody>';
        $('#operations-results-none').replaceWith(htmlNull);
        $('#operations-results').replaceWith(html);
        preloaderRefillsNull = '<div id=\"refills-preloader\"></div>';
        $('#refills-preloader').replaceWith(preloaderRefillsNull);        
      } else {
        html = '<h3 id=\"operations-results-none\" class=\"text-center\">Нет результатов</h3>';
        htmlNull = '<tbody id=\"operations-results\"></tbody>';
        $('#operations-results-none').replaceWith(html);
        $('#operations-results').replaceWith(htmlNull);
        html = '<h3 id=\"operations-results-none\"></h3>';
      }
      /**
       * END REFILLS DATA
       */
      /**
       * LOAD CARD DATA
       */
       htmlTrips = '<tbody id=\"trips-results\">';
       for (var i = 0; i <= msg['trips'].length - 1; i++) {
        htmlTrips += "<tr><td>" + msg.trips[i].DATE_OF + "</td><td><img src=\"/images/icons/" + msg.trips[i].transport_type + ".png\" style=\"height:32px !important; width:32px !important;\">" + msg.trips[i].name + "</td><td class=\"text-right\">"  + msg.trips[i].AMOUNT + "</td><td class=\"text-right\">" + msg.trips[i].EP_BALANCE + "</td></tr>";
      }
      htmlTrips += '</tbody>';
      $('#trips-results').replaceWith(htmlTrips);
      preloaderTripsNull = '<div id=\"trips-preloader\"></div>';
      $('#trips-preloader').replaceWith(preloaderTripsNull);
      /**
       * END OF LOAD CARD DATA
       */
     };
   });
if ($('#card_serie').val().length == 2){
  $('#block-button').removeAttr('disabled');
  $('#serie').val($('#card_serie').val());
} else $('#block-button').attr('disabled','disabled');
};
});
</script>
</html>