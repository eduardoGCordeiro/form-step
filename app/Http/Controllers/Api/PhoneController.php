<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Phone;

class PhoneController extends Controller
{
    private function validator(array $data)
    {
        $validations =  [
            'mobile' => ['required', 'max:255'],
            'phone'  => ['required', 'max:255']
        ];

        $messages = [
            'mobile.required' => 'O campo celular é obrigatório.',
            'mobile.max'      => 'O campo celular deve conter no máximo 255 caracteres.',
            'phone.required'  => 'O campo telefone fixo desejado é obrigatório.',
            'phone.max'       => 'O campo telefone fixo desejado deve conter no máximo 255 caracteres.'
        ];


        $validator =  Validator::make($data, $validations, $messages);
        return $validator;
    }

    public function save(Request $request, User $item)
    {
        $this->validator(array_merge($request->all()))->validate();

        DB::beginTransaction();
        
        try {
            if (!$item->exists) {
                $item = new User;
            }

            if (!$item->phoneMobile->last()) {
                $phone_mobile = new Phone();
                $phone_mobile->number = $request->mobile;
                $phone_mobile->type_id = 1;
                $phone_mobile->user_id = $item->id;
                $phone_mobile->save();
            }

            if (!$item->phone->last()) {
                $phone = new Phone();
                $phone->number = $request->phone;
                $phone->type_id = 2;
                $phone->user_id = $item->id;
                $phone->save();
            }

            if ($item->phoneMobile->last()) {
                $item->phoneMobile->last()->number = $request->mobile;
                $item->phoneMobile->last()->save();
            }

            if ($item->phone->last()) {
                $item->phone->last()->number = $request->phone;
                $item->phone->last()->save();
            }

            $item->refresh();

            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return response()->json('Algo deu errado, tente novamente mais tarde!')->setStatusCode(500);
        }

        return response()->json(['phone_mobile' => $item->phoneMobile->last(), 'phone_phone' => $item->phone->last()]);
    }
}
