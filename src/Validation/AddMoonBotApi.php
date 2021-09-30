<?PHP

namespace CryptaEve\Seat\MoonBot\Validation;

use Illuminate\Foundation\Http\FormRequest;

class AddMoonBotApi extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'corporations' => 'required|array',
            'corporations.*' => 'integer|exists:corporation_infos,corporation_id'
        ];
    }
}

