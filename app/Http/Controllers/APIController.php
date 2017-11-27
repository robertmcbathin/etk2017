<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class APIController extends Controller
{
    protected function modifyToShortNumber($num){
        return substr_replace($num, '', 1,1);
    }

    protected function modifyToFullNumber($number){
      $card_num_part2 = substr($number,1,2);
      $card_num_part3  = substr($number,3,6);
      if ($card_num_part2 !== 99){ $prefix = '01'; } else {$prefix = '02';}
      $full_card_number = $prefix . $card_num_part2 . $card_num_part3;
      return $full_card_number;
    }

    public function postCheckCardRecoding(Request $request){
    	$card_number = $request->card_number;
    	if($card_number){
    		/**
    		 * CHECK LENGTH
    		 */
    		if (strlen($card_number) !== 9){
    			return response()->json([
            	    'status' => 'error',
            	    'errorCode' => '2',
            	    'errorText' => 'Неверная длина номера карты. Номер должен состоять из 9 цифр'
            	],200);	
    		}
    		/**
    		 * CHECK ON DIGITS
    		 */
    		if (!is_numeric($card_number)){
    		    return response()->json([
            	    'status' => 'error',
            	    'errorCode' => '3',
            	    'errorText' => 'Номер карты должен содержать только цифры'
            	],200);		
    		}
    		/**
    		 * PARSE ON SERIE AND NUM
    		 */
    		$serie = substr($card_number,1,2);
    		$num   = substr($card_number,3,6);
    		$full_number = $this->modifyToFullNumber($card_number);
    		/**
    		 * CHECK ON UEK SERIE
    		 */
    		if($serie == 99){
    		    return response()->json([
            	    'status' => 'error',
            	    'errorCode' => '4',
            	    'errorText' => 'Карты УЭК не поддерживаются'
            	],200);	    			
    		}
    		/**
    		 * CHECK OLD SB CARDS
    		 */
    		if (($serie == 99) && ($num <= 552331)){
    		    return response()->json([
            	    'status' => 'error',
            	    'errorCode' => '5',
            	    'errorText' => 'Устаревший тип карты БТК'
            	],200);	    			
    		}
    		/**
    		 * CHECK CARD ON EXISTING
    		 */
    		$card = DB::table('ETK_CARDS')
    					->where('num',$full_number)
    					->first();
    		if ($card){
    			if ($card->is_recoded == 0){
    		   		 return response()->json([
            		     'status' => 'error',
            		     'errorCode' => '6',
            		     'errorText' => 'Данная карта пока недоступна для пополнения онлайн'
            		 ],200);    				
    			} else {
    				return response()->json([
            		     'status' => 'success'
            		 ],200);
    			}
    		} else {
    		   	 return response()->json([
            	     'status' => 'error',
            	     'errorCode' => '7',
            	     'errorText' => 'Номер карты не существует. Проверьте правильность введенных данных'
            	 ],200);
    		}

    	} else {
    		return response()->json([
                'status' => 'error',
                'errorCode' => '1',
                'errorText' => 'Не задан номер карты'
            ],200);
    	}
    }
}
