<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

//*************************************************************
// Rule
//1.  use App\Http\Requests\AthletesValidation; //Add Controller
//2.  public function store( AthletesValidation $request ){ //example
//*************************************************************

class AthletesValidation extends FormRequest
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
				"team_id" => "required|integer", //integer('team_id')
				"athlete_name" => "nullable|max:511", //string('athlete_name',511)->nullable()

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



