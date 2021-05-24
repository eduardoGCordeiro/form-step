<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    private function validator(array $data)
    {
        $validations =  [
            'name'                => ['required', 'max:255'],
            'birthday'            => ['required', 'max:255'],
        ];

        $messages = [
            'name.required'               => 'O campo nome é obrigatório.',
            'name.max'                    => 'O campo nome deve conter no máximo 255 caracteres.',
            'birthday.required'           => 'O campo data de nascimento desejado é obrigatório.',
            'birthday.max'                => 'O campo data de nascimento desejado deve conter no máximo 255 caracteres.',
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

            $request['birthday'] = \DateTime::createFromFormat('d/m/Y', $request->birthday);
            $item->fill($request->all());
            $item->save();

            $item->refresh();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json('Algo deu errado, tente novamente mais tarde!')->setStatusCode(500);
        }

        return response()->json($item);
    }

    public function details(Request $request)
    {
        try {
            $user = User::where('name', $request->name)->first();
            if (!$user) {
                return response()->json('');
            }

            if ($user) {
                $user->birthday = date_format(new \DateTime($user->birthday), 'd/m/Y');
                $data = [
                    'user'         => $user,
                    'address'      => $user->address ? $user->address->last() : '',
                    'phone_mobile' => $user->phoneMobile ? $user->phoneMobile->last() : '',
                    'phone_phone'  => $user->phone ? $user->phone->last() : '',
                ];

                return response()->json($data);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json('Algo deu errado, tente novamente mais tarde!')->setStatusCode(500);
        }

        return response()->json($item);
    }
}
