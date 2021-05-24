@extends('layout.main')

@section('js')
    <script src="{{asset('js/jquery-mask.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/jquery-mask-init.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/modules/user/form.blade.js')}}"></script>
@endsection

@section('content')
                <!-- STEP 1-->

                <div class="row" id="step_1">
                    <div class="col-12">
                        <div class="row mb-4 alert alert-primary" role="alert">
                            <div class="col-10">
                                Dados do usuário 
                            </div>
                            <div class="col-2 text-right">
                                <span class="badge badge-pill badge-primary">1 de 3</span>
                            </div>
                        </div>

                        <!-- USUÁRIO-->
                        <input type="text" hidden id="user" value="{{$user ? $user->id : ''}}">

                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="user_name">Nome *</label>
                                <input type="text" name="user_name" class="form-control" id="user_name" aria-describedby="Nome" value="{{$user->name ? $user->name : ''}}">
                                <div id="invalid_user_name" class="invalid-feedback"></div>
                            </div>

                            <div class="col-3 form-group">
                                <label for="user_birthday">Nascimento *</label>
                                <input type="text" data-toggle="input-mask" data-mask-format="00/00/0000" name="user_birthday" class="form-control" id="user_birthday" aria-describedby="Nome" value="{{$user->birthday ? date_format(new DateTime($user->birthday), 'd/m/Y') : ''}}">
                                <div id="invalid_user_birthday" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <a href="{{route('user.home')}}" class="btn btn-secondary">Cancelar</a>
                                <button type="button" class="btn btn-primary next_steps" value="step_1">Continuar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 2-->
                <div class="row" id="step_2" hidden>
                    <div class="col-12">
                        <div class="row mb-4 alert alert-primary" role="alert">
                            <div class="col-10">
                                Endereço do usuário 
                            </div>
                            <div class="col-2 text-right">
                                <span class="badge badge-pill badge-primary">2 de 3</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1 form-group">
                                <label for="address_state">Estado</label>
                                <input type="text" data-toggle="input-mask" data-mask-format="AA" name="address_state" class="form-control" id="address_state" aria-describedby="Estado" value="{{ $address ? $address->state ? $address->state : '' : ''}}">
                                <div id="invalid_address_state" class="invalid-feedback"></div>
                            </div>

                            <div class="col-3 form-group">
                                <label for="address_city">Cidade *</label>
                                <input type="text" name="address_city" class="form-control" id="address_city" aria-describedby="Cidade" value="{{ $address ? $address->city ? $address->city : '' : ''}}">
                                <div id="invalid_address_city" class="invalid-feedback"></div>
                            </div>

                            <div class="col-4 form-group">
                                <label for="address_street">Rua *</label>
                                <input type="text" name="address_street" class="form-control" id="address_street" aria-describedby="Rua" value="{{ $address ? $address->street ? $address->street : '' : ''}}">
                                <div id="invalid_address_street" class="invalid-feedback"></div>
                            </div>

                            <div class="col-2 form-group">
                                <label for="address_number">Número *</label>
                                <input type="text" data-toggle="input-mask" data-mask-format="000000000" name="address_number" class="form-control" id="address_number" aria-describedby="Número" value="{{ $address ? $address->number ? $address->number : '' : ''}}">
                                <div id="invalid_address_number" class="invalid-feedback"></div>
                            </div>

                            <div class="col-2 form-group">
                                <label for="address_zip_code">CEP *</label>
                                <input type="text" data-toggle="input-mask" data-mask-format="99999-999" name="address_zip_code" class="form-control" id="address_zip_code" aria-describedby="CEP" value="{{ $address ? $address->zip_code ? $address->zip_code : '' : ''}}">
                                <div id="invalid_address_zip_code" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-secondary previous_steps" value="step_1">Voltar</button>
                                <button type="button" class="btn btn-primary next_steps" value="step_2">Continuar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 3-->
                <div class="row" id="step_3" hidden>
                    <div class="col-12">
                        <div class="row mb-4 alert alert-primary" role="alert">
                            <div class="col-10">
                                Contatos do usuário 
                            </div>
                            <div class="col-2 text-right">
                                <span class="badge badge-pill badge-primary">3 de 3</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 form-group">
                                <label for="phone_mobile">Celular *</label>
                                <input type="text" data-toggle="input-mask" data-mask-format="(99) 99999-9999" name="phone_mobile" class="form-control" id="phone_mobile" aria-describedby="Celular" value="{{$phone_mobile ? $phone_mobile->number ? $phone_mobile->number : '' : ''}}">
                                <div id="invalid_phone_mobile" class="invalid-feedback"></div>
                            </div>

                            <div class="col-5 form-group">
                                <label for="phone_phone">Telefone fixo *</label>
                                <input type="text" data-toggle="input-mask" data-mask-format="(99) 99999-9999" name="phone_phone" class="form-control" id="phone_phone" aria-describedby="Telefone fixo" value="{{$phone ? $phone->number ? $phone->number : '' : ''}}">
                                <div id="invalid_phone_phone" class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-secondary previous_steps" value="step_2">Voltar</button>
                                <button type="button" href="" class="btn btn-primary next_steps" value="step_3">Finalizar</button>
                            </div>
                        </div>
                    </div>
                </div>
@endsection