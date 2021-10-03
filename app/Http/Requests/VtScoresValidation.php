<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

//*************************************************************
// Rule
//1.  use App\Http\Requests\VtScoresValidation; //Add Controller
//2.  public function store( VtScoresValidation $request ){ //example
//*************************************************************

class VtScoresValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //[ *1. default=false ]
    }
    
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //[ *2. Validation rule description location ]
        return [
				"event_id" => "required|integer", //integer('event_id')
				"athlete_id" => "required|integer", //integer('athlete_id')
				"team_id" => "required|integer", //integer('team_id')
				"member_flag" => "required|integer", //integer('member_flag')
				"d_score" => "required|numeric", //float('d_score')
				"e_score" => "required|numeric", //float('e_score')
				"nd_score" => "required|numeric", //float('nd_score')

            ];
        }
    
        //[ *3. Set Validation message (*Optional) ]
        //Be sure to use [messages] for the Function name.
        //[Ja]https://readouble.com/laravel/6.x/ja/validation-php.html
        public function messages(){
            return [
                //"email.required"  => "メールアドレスを入力してください",
                //"email.max"       => "**文字以下で入力してください",
            ];
        }
    
    }



