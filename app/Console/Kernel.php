<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use DB;
use Storage;
use Log;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use \SoapClient;
use \SoapServer;
use \SoapHeader;
use \SimpleXML;
use \SimpleXMLElement;
use \App\WsseAuthHeader;
use Mail;
use App\Mail\CheckRefillment;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $schedule->call(function(){

        $sources = [1,2];
        foreach ($sources as $source) {
         $filename = '/admin/files/statuscard/statuscard-21-' . date('ymd') . '-0000' . $source . '.txt';
         $short_filename = 'statuscard-21-' . date('ymd') . '-0000' . $source . '.txt';
         $path = public_path() . '/admin/files/statuscard/' . $short_filename;
         $fp = fopen($path, 'w');

         $status_count = 0;
         if ($cards = DB::table('ETK_BLOCKLISTS')
          ->where('source', $source)
          ->where('is_loaded', 0)
          ->get()){
          foreach ($cards as $card) {
            $status_count++;
            $row = $card->chip . "\t" . $card->operation_type . "\r\n";
            fwrite($fp, $row);
          };
          fclose($fp);
          if (DB::table('ETK_STATUSCARDS')
            ->insert(['filename' => $filename,
              'status_count' => $status_count,
              'created_by' => 0])){
            DB::table('ETK_BLOCKLISTS')
          ->where('source', $source)
          ->where('is_loaded', 0)
          ->update(['is_loaded' => 1]);
            /**
             * LOAD FILE TO FTP
             */
            $ftp_file = fopen($path, 'r');
            Storage::disk('ftp-cott-blocklists')->put($short_filename, $ftp_file);
            fclose($ftp_file);
            /*
           * LOGGING THE BLOCKLIST EXPORT
           * 
            */
            $log = new \App\Log;
            $log->action_type = 8;
            $log->message = date('Y-m-d H:i:s') . " | Автоматическая выгрузка блок-листов на FTP. Выгружено записей: $status_count";
            $log->save();
          /**
           * 
           */
        }
      } 
    }  
  })->cron('20 18 * * *'); 

      $schedule->call(function(){
        /**START LOGGING
        **/
        $log = new \App\Log;
        $log->action_type = 9;
        /**
         * START COPY DATA
         */
        $current_date_string = date('Y-m-d H:i:s');
        $current_date = new \DateTime($current_date_string);
        date_sub($current_date, date_interval_create_from_date_string('1 month'));
        $month_ago = date_format($current_date, 'Y-m-d H:i:s');
        $buffer = DB::table('ETK_T_DATA')
                    ->where('DATE_OF', '<', $month_ago)
                    ->get();
        $transaction_count = 0;
        foreach ($buffer as $transaction){
          DB::table('ETK_T_DATA_ARCHIVE')->insert(['KIND' => $transaction->KIND, 
                'DATE_OF' => $transaction->DATE_OF,
                'EP_BALANCE' => $transaction->EP_BALANCE,
                'AMOUNT' => $transaction->AMOUNT,
                'TICKET_NUM' => $transaction->TICKET_NUM,
                'ID_ROUTE' => $transaction->ID_ROUTE,
                'CARD_SERIES' => $transaction->CARD_SERIES,
                'CARD_NUM' => $transaction->CARD_NUM,
                'INS_DATE' => $transaction->INS_DATE,
                'CPTT_ID' => $transaction->CPTT_ID
              ]);
          $transaction_count++;
        }
        /**
         * STOP COPY DATA
         */
        DB::table('ETK_T_DATA')
          ->where('DATE_OF', '<', $month_ago)
          ->delete();
          /*
         * STOP LOGGING
         * 
          */
        $log = new \App\Log;
        $log->action_type = 9;
        $log->message = date('Y-m-d H:i:s') . " | Автоматическая выгрузка в архив. Выгружено записей: $transaction_count";
        $log->save();
        /**
         * 
         */
  })->cron('0 3 * * *'); 



/**
 * SOAP REQUEST FOR TEST SERVICES
 */
    $schedule->call(function(){
      $receivers = ['ivanov@etk21.ru', 'mercile55@yandex.ru', 'transkarta@bk.ru', 'edinaya.karta@mail.ru','transkarta21@yandex.ru'];
      $client = new SoapClient('http://94.79.52.173:2180/SDPServer/SDPendpoints/SdpService.wsdl', array('soap_version'   => SOAP_1_1, 'trace' => true, 'location' => 'http://94.79.52.173:2180/SDPServer/SDPendpoints'));
      $params = array('agentId' => '1004', 
        'salepointId' => '1', 
        'version' => '1', 
        'sysNum' => '123612691', 
        'regionId' => 21, 
        'deviceId' => 'B2100009');
      $username = 'admin';
      $password = '1';
      $wsse_header = new WsseAuthHeader($username, $password);
      $client->__setSoapHeaders(array($wsse_header));
      try {
        $cardInfo = $client->__soapCall('CardInfo', array($params));
      } catch (Exception $e) {
        $log = new \App\Log;
        $log->action_type = 24;
        $log->message = date('Y-m-d H:i:s') . " | Непредвиденное исключение " . $e;
        $log->description = 1;
        $log->save();

        foreach ($receivers as $receiver) {
          Mail::to($receiver)->send(new CheckRefillment());
        }
        return redirect()->back();
      }
      if ($cardInfo->Result->resultCode == 0){
        $log = new \App\Log;
        $log->action_type = 24;
        $log->message = date('Y-m-d H:i:s') . " | Система работает в штатном режиме";
        $log->description = 0;
        $log->save();        
      } else {
        $log = new \App\Log;
        $log->action_type = 24;
        $log->message = date('Y-m-d H:i:s') . " | Некорректная работа системы";
        $log->description = 1;
        $log->save();    
        foreach ($receivers as $receiver) {
          Mail::to($receiver)->send(new CheckRefillment());
        }   
      }
    })->everyFiveMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
      require base_path('routes/console.php');
    }
  }
