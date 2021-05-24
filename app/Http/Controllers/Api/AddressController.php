<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AddressController extends Controller
{
    private function validator(array $data)
    {
        $validations =  [
            'state'    => ['required', 'max:255'],
            'city'     => ['required', 'max:255'],
            'street'   => ['required', 'max:255'],
            'number'   => ['required', 'max:255'],
            'zip_code' => ['required', 'max:255'],
        ];

        $messages = [
            'state.required'    => 'O campo estado é obrigatório.',
            'state.max'         => 'O campo estado deve conter no máximo 255 caracteres.',
            'city.required'     => 'O campo cidade é obrigatório.',
            'city.max'          => 'O campo cidade deve conter no máximo 255 caracteres.',
            'street.required'   => 'O campo rua é obrigatório.',
            'street.max'        => 'O campo rua deve conter no máximo 255 caracteres.',
            'number.required'   => 'O campo número é obrigatório.',
            'number.max'        => 'O campo número deve conter no máximo 255 caracteres.',
            'zip_code.required' => 'O campo CEP é obrigatório.',
            'zip_code.max'      => 'O campo CEP deve conter no máximo 255 caracteres.'
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

            if (!$item->address->last()) {
                $address = new Address();
                $address->fill($request->all());
                $address->user_id = $item->id;
                $address->save();
            }

            if ($item->address->last()) {
                $item->address->last()->fill($request->all());
                $item->address->last()->save();
            }

            $item->refresh();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json('Algo deu errado, tente novamente mais tarde!')->setStatusCode(500);
        }

        return response()->json($item->address->last());
    }
}
