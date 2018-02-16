<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Mail;
use Session;
use \SoapClient;
use \SoapServer;
use \SoapHeader;
use Carbon\Carbon;
use App\Question;
use \App\WsseAuthHeader;

class SiteController extends Controller
{
    public function getIndexPage(){
    	$articles = DB::table('ETK_ARTICLES')
       ->orderBy('created_at', 'desc')
       ->take(3)
       ->get();
       Carbon::setLocale('ru');
       foreach ($articles as $article) {
          $non_formatted_date = new Carbon($article->created_at);
          $date = $non_formatted_date->diffForHumans();
          $article->created_at = $date;
      }
      return view('index',[
          'articles' => $articles
          ]);
  }
  public function getAboutPage(){
   return view('pages.about');
}
public function getLawPage(){
    return view('pages.law');
}
public function getStaticArticlesPage(){
    return view('pages.static_articles.static_articles');
}
public function getNewsPage(){
   $articles = DB::table('ETK_ARTICLES')
   ->where('published', '=', 1)
   ->orderBy('created_at', 'desc')
   ->paginate(9);
   Carbon::setLocale('ru');
    	/**
    	 * Make a human-readable date
    	 */
    	foreach ($articles as $article) {
    		$non_formatted_date = new Carbon($article->created_at);
    		$date = $non_formatted_date->format('j/m/Y');
    		$article->created_at = $date;
    	}
    	/**
    	 * 
    	 */
    	return view('pages.news',[
    		'articles' => $articles
    		]);
    }
    public function getArticle($id){
      /**
       * GET ARTICLE
       * @var [type]
       */
    	$article = DB::table('ETK_ARTICLES')
       ->where('id', $id)
       ->where('published', '1')
       ->first();
             /**
       * INCREASE VIEWS COUNT
       * @var [type]
       */
      DB::table('ETK_ARTICLES')
        ->where('id',$id)
        ->update(['views' => ++$article->views]);
       $links = DB::table('ETK_ARTICLE_INNER_LINKS')
                  ->where('article_id', '=', $id)
                  ->get();
       Carbon::setLocale('ru');
       $non_formatted_date = new Carbon($article->created_at);
       $date = $non_formatted_date->format('j/m/Y');
       $article->created_at = $date;
       return view('pages.article',[
          'article' => $article,
          'links' => $links
          ]);
   }
   public function getDepositPointsPage(){
    return view('pages.deposit-points');
   }
   public function getSellPointsPage(){
       return view('pages.sale-points');
   }
   public function getDepositPointsListPage(){
    return view('pages.deposit-points-list');
   }
   public function getSellPointsListPage(){
       return view('pages.sale-points-list');
   }
   public function getHowToRefillPage(){
       return view('pages.how_to_refill');
   }
   public function getHowToRefillSberbankPage(){
       return view('pages.how_to_refill_sberbank');
   }
    /**
     * CARDS
     */
    public function getEwalletPage(){
        $cards = DB::table('ETK_CARD_TYPES')
        ->where('type',1)
        ->get();
        return view('pages.ewallet',[
            'cards' => $cards
            ]);
    }
    public function getTravelCardsPage(){
        $cards = DB::table('ETK_CARD_TYPES')
        ->where('type',2)
        ->get();
        return view('pages.travel_cards',[
            'cards' => $cards
            ]);
    }
    public function getSbercardPage(){
        $cards = DB::table('ETK_CARD_TYPES')
        ->where('type',3)
        ->get();
        return view('pages.sbercard',[
            'cards' => $cards
            ]);
    }
    public function getCard($id){
        $card = DB::table('ETK_CARD_TYPES')
        ->where('id', $id)
        ->first();
        return view('pages.card',[
            'card' => $card
            ]);
    }
    public function getCardsPage(){
        $cards = DB::table('ETK_CARD_TYPES')
        ->get();
        return view('pages.cards',[
            'cards' => $cards
            ]);
    }
    /**
     * 
     */
    public function getContactsPage(){
        return view('pages.contacts');
    }

    public function getFaqPage(){
        $questions = DB::table('ETK_QUESTIONS')
        ->where('answer', '!=', '')
        ->orderBy('updated_at')
        ->get();
        return view('pages.faq',[
            'questions' => $questions
            ]);
    }
    public function getAskPage(){
        return view('pages.ask');
    }
    public function getPrivacyPage(){
      return view('pages.privacy');
    }
    public function getEulaPage(){
      return view('pages.eula');
    }
    public function getConditionsPage(){
        return view('pages.conditions');
    }
    public function getWantedPage(){
        return view('pages.wanted');
    }
    public function getAboutOnlinePage(){
        return view('pages.about_online');
    }
    public function getSbolInstructionPage(){
        return view('pages.instructions.sbol');
    }
    public function postQuestion(Request $request){
        $this->validate($request,[
            'name' => 'required|min:1|max:100',
            'email' => 'required|min:1|max:100',
            'content' => 'required|min:1',
            'g-recaptcha-response' => 'required|captcha'
            ]);
        $name = $request['name'];
        $email = $request['email'];
        $content = $request['content'];
        /**
         * INSERT INTO DB
         * @var Question
         */
        $question = new Question;
        $question->name = $name;
        $question->email = $email;
        $question->content = $content;
        if ($question->save())
        {
            Mail::send('emails.question',
              ['name' => $name,
              'email' => $email,
              'content' => $content],
              function ($m){
                $m->from('no-reply@etk21.ru', 'ETK21.RU');
                $m->to('questions@etk21.ru')->subject('Новый вопрос с сайта');
            });
            Session::flash('ok', 'Ваше сообщение отправлено');
            return redirect()->back();
        }
    }

    /**
     * [getPaymentOkPage description]
     * @return [type] [description]
     */
    public function postNotifyAboutPayment(Request $request){
      $Order_ID = $request->Order_ID;
      $Status = $request->Status;
      $Signature = $request->Signature;

      $order = DB::table('ETK_ORDERS')
                  ->where('order_name', $Order_ID)
                  ->first();

      DB::table('ETK_ORDERS')
        ->where('order_name', $Order_ID)
        ->update([
          'payment_status' => $Status,
          'signature' => $Signature
          ]);
      if (($Status == 'authorized') || ($Status == 'paid')){
        /**
         * ОПЛАТА ПРОШЛА УСПЕШНО
         * @var [type]
         */
        if ($order->rewrite_status == 1){
  return response('ok', 200)
                ->header('Content-Type', 'text/plain');
        } elseif ($order->rewrite_status == 0) {
        /**
         * POST TRANSACTION
         */
        try {
          $client = new SoapClient('http://94.79.52.173:2180/SDPServer/SDPendpoints/SdpService.wsdl', array('soap_version'   => SOAP_1_1, 'trace' => true, 'location'   => 'http://94.79.52.173:2180/SDPServer/SDPendpoints'));
          $params = array('agentId' => '1002', 
            'salepointId' => '1', 
            'version' => '1', 
            'sessionId' => $order->session_id,
            'tariffId' => $order->tariff_id,
            'paymentSum' => ($order->payment_to_card*100),
            'paymentInfo' => 'Тест'
          );
          $username = 'admin';
          $password = '1';
          $wsse_header = new WsseAuthHeader($username, $password);
          $client->__setSoapHeaders(array($wsse_header));
          $paymentInfo = $client->__soapCall('CardPayment', array($params)); 
          /**
           * UPDATE DB
           */
          DB::table('ETK_ORDERS')
            ->where('order_name', $Order_ID)
            ->update([
              'rewrite_status' => 1
              ]);
        } catch (Exception $e) {
  return response('ok', 200)
                ->header('Content-Type', 'text/plain');
        }
  return response('ok', 200)
                ->header('Content-Type', 'text/plain');
        }
      } else{
        /**
         * ОПЛАТА НЕ ПРОИЗВЕДЕНА
         */
  return response('ok', 200)
                ->header('Content-Type', 'text/plain');
      }


    }


    /**
     * NOTIFICATIONS
     */
    

    public function getPaymentOkPage($Order_ID){
      return view('pages.payment_ok',[
        'Order_ID' => $Order_ID
      ]);
    }

    public function getPaymentFailPage($Order_ID = null){
      return view('pages.payment_fail');
    }
}
