<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <ul class="nav nav-tabs mt-3" id="border-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="border-profile-tab" data-toggle="tab" href="#transactions" role="tab" aria-controls="border-profile" aria-selected="false"><i class="fa fa-list"></i> Transferencias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="border-home-tab" data-toggle="tab" href="#own-accounts" role="tab" aria-controls="border-home" aria-selected="true"><i class="fa fa-bank"></i> Cuentas Propias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="border-profile-tab" data-toggle="tab" href="#third-party-accounts" role="tab" aria-controls="border-profile" aria-selected="false"><i class="fa fa-address-book-o"></i> Cuentas de terceros</a>
                    </li>
                </ul>
                <div class="tab-content mb-4" id="border-tabsContent">
                    <div class="tab-pane fade show active" id="transactions" role="tabpanel" aria-labelledby="border-contact-tab">

                    </div>
                    <div class="tab-pane fade" id="own-accounts" role="tabpanel" aria-labelledby="border-home-tab">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="py-2">Mis Cuentas</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped mb-4">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Cuenta</th>
                                                <th>Estado</th>
                                                <th>Fondos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ownAccounts as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->account }}</td>
                                                <td>
                                                    @if($item->status == "active")
                                                    <span class="badge badge-success"> Activa </span>
                                                    @else
                                                    <span class="badge badge-danger"> Inactiva </span>
                                                    @endif
                                                </td>
                                                <td>{{ is_null($item->value) ? 0 : $item->value }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <h4 class="py-2">Transferir entre mis cuentas</h4>
                                <!-- Session Feedback -->
                                <x-auth-session-status class="mb-4" :status="session('feedback')" />
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                @if($insufficientOwnAccounts) <div class="mb-4 font-medium text-red-600">Ops, No hay suficientes cuentas propias!
                                </div>@endif
                                <form method="POST" action="{{ url('transacciones-bancarias/cuentas-propias') }}">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="account_origin">Cuenta de origen</label>
                                        <select class="form-control" id="account_origin" name="account_origin" @if($insufficientOwnAccounts) disabled @endif>
                                            @foreach($ownAccounts as $item)
                                            @if($item->status == "active")
                                            <option value="{{ $item->id }}">Cuenta: {{ $item->account }} - Disponible: {{ $item->value ? $item->value : 0 }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="account_destination">Cuenta de destino</label>
                                        <select class="form-control" id="account_destination" name="account_destination" @if($insufficientOwnAccounts) disabled @endif>
                                            @foreach($ownAccounts as $item)
                                            @if($item->status == "active")
                                            <option value="{{ $item->id }}">{{ $item->account }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="transaction">Monto</label>
                                        <input id="transaction" type="number" name="transaction" placeholder="Ingrese el monto a tranferir" class="form-control" required @if($insufficientOwnAccounts) disabled @endif>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        @if(!$insufficientOwnAccounts)
                                        <x-button class="ml-3">
                                            {{ __('Transferir') }}
                                        </x-button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="third-party-accounts" role="tabpanel" aria-labelledby="border-profile-tab">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="py-2">Mis Cuentas</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped mb-4">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Cuenta</th>
                                                <th>Estado</th>
                                                <th>Fondos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ownAccounts as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->account }}</td>
                                                <td>
                                                    @if($item->status == "active")
                                                    <span class="badge badge-success"> Activa </span>
                                                    @else
                                                    <span class="badge badge-danger"> Inactiva </span>
                                                    @endif
                                                </td>
                                                <td>{{ is_null($item->value) ? 0 : $item->value }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <h4 class="py-2">Transferir a cuentas de terceros</h4>
                                <!-- Session Feedback -->
                                <x-auth-session-status class="mb-4" :status="session('feedback')" />
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                @if($insufficientThirdPartyAccounts) <div class="mb-4 font-medium text-red-600">Ops, No hay suficientes cuentas propias!
                                </div>@endif
                                <form method="POST" action="{{ url('transacciones-bancarias/cuentas-propias') }}">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="account_origin">Cuenta de origen</label>
                                        <select class="form-control" id="account_origin" name="account_origin" @if($insufficientOwnAccounts) disabled @endif>
                                            @foreach($ownAccounts as $item)
                                            @if($item->status == "active")
                                            <option value="{{ $item->id }}">Cuenta: {{ $item->account }} - Disponible: {{ $item->value ? $item->value : 0 }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="account_destination">Cuenta de destino</label>
                                        <select class="form-control" id="account_destination" name="account_destination" @if($insufficientThirdPartyAccounts) disabled @endif>
                                            @foreach($thirdPartyAccounts as $item)
                                            <option value="{{ $item->id }}">{{ $item->account }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="transaction">Monto</label>
                                        <input id="transaction" type="number" name="transaction" placeholder="Ingrese el monto a tranferir" class="form-control" required @if($insufficientThirdPartyAccounts) disabled @endif>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        @if(!$insufficientThirdPartyAccounts)
                                        <x-button class="ml-3">
                                            {{ __('Transferir') }}
                                        </x-button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>