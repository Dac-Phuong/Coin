<!-- Responsive Datatable -->
<div>
    <h4 class="py-3 mb-2" wire:poll.15s>
        <span class="text-muted fw-light">{{ __('Investment Manage') }} /</span> {{ __('List Investment') }}
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">{{ __('List Investment') }}</h5>
        </div>
        <div class="col-md-2 w-100 justify-content-between my-2 mr-3 d-flex px-4">
            <div class="d-flex m-0">
                <div>
                    <div class="d-flex align-items-center">
                        <p class="m-0" style="width: 120px;font-weight: 600">{{ __('From date') }}</p>
                        <input type="date" class="form-control" value="{{ $from_date }}"
                            wire:model.live="from_date" style="max-width: 240px">
                    </div>
                </div>
                <div class="">
                    <div class="d-flex align-items-center">
                        <p class="m-0" style="width: 160px;padding: 0 20px;font-weight: 600">{{ __('To date') }}
                        </p>
                        <input type="date" class="form-control" value="{{ $to_date }}" wire:model.live="to_date"
                            style="max-width: 240px">
                    </div>
                </div>
            </div>
            <div class="input-group input-group-merge w-20">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                    placeholder="{{ __('Search...') }}" aria-label="Search..." aria-describedby="basic-addon-search31"
                    fdprocessedid="pjzbzc">
            </div>
        </div>
        <div class="table-responsive text-nowrap p-3 mb-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>{{ __('Coin type') }}</th>
                        <th>{{ __('Name plan') }}</th>
                        <th>{{ __('Profit') }} (%)</th>
                        <th>{{ __('Sender') }}</th>
                        <th>{{ __('Deposit amount') }}</th>
                        <th>{{ __('Sending method') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Sent date') }}</th>
                        <th style="width:80px">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($list_deposit) > 0)
                        @foreach ($list_deposit as $key => $deposit)
                            <tr class="odd cursor-pointer">
                                <td data-kt-action="update" data-id={{ $deposit->id }} data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update">{{ ++$key }}</td>
                                <td data-kt-action="update" data-id={{ $deposit->id }} data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update">{{ $deposit->name_coin }}</td>
                                <td data-kt-action="update" data-id={{ $deposit->id }} data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update">{{ $deposit->plan_name }}</td>
                                <td data-kt-action="update" data-id={{ $deposit->id }} data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update">{{ $deposit->profit }}%</td>
                                <td data-kt-action="update" data-id={{ $deposit->id }} data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update">{{ $deposit->investor_name }}</td>
                                <td data-kt-action="update" data-id={{ $deposit->id }} data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update">${{ $deposit->amount }}</td>
                                <td data-kt-action="update" data-id={{ $deposit->id }} data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update"
                                    class="{{ $deposit->type_payment == 0 ? 'text-danger' : 'text-primary' }}">
                                    {{ $deposit->type_payment == 0 ? 'Processor' : 'Account Balance' }}</td>
                                <td data-kt-action="update" data-id={{ $deposit->id }} data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update"
                                    class="{{ $deposit->status == 0 ? 'text-primary' : ($deposit->status == 1 ? 'text-warning' : ($deposit->status == 2 ? 'text-success' : 'text-danger')) }}">
                                    {{ $deposit->status == 0 ? 'Pending' : ($deposit->status == 1 ? 'Running' : ($deposit->status == 2 ? 'Success' : 'Cancel')) }}
                                </td>
                                <td data-kt-action="update" data-id={{ $deposit->id }} data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_update">{{ $deposit->created_at }}</td>

                                <td>
                                    @if ($deposit->status == 0)
                                        <div class="d-flex">
                                            <button wire:click="updateStatus({{ $deposit->id }})"
                                                data-bs-dismiss="modal" aria-label="Close"
                                                class="dt-button add-new btn btn-primary ms-2 waves-effect waves-light "
                                                type="button">
                                                {{ __('Confirm') }}
                                            </button>
                                            <button wire:click="cancel({{ $deposit->id }})" data-bs-dismiss="modal"
                                                aria-label="Close"
                                                class="dt-button add-new btn btn-danger ms-2 waves-effect waves-light"
                                                type="button">
                                                {{ __('Cancel') }}
                                            </button>
                                        </div>
                                    @elseif($deposit->status == 1)
                                        <button wire:click="cancel({{ $deposit->id }})" data-bs-dismiss="modal"
                                            aria-label="Close"
                                            class="dt-button add-new btn btn-danger ms-2 waves-effect waves-light"
                                            type="button">
                                            {{ __('Cancel') }}
                                        </button>
                                    @elseif($deposit->status == 2)
                                        <button disabled data-bs-dismiss="modal" aria-label="Close"
                                            class="dt-button add-new btn btn-success ms-2 waves-effect waves-light"
                                            type="button">
                                            {{ __('Success') }}
                                        </button>
                                    @else
                                        <button disabled data-bs-dismiss="modal" aria-label="Close"
                                            class="dt-button add-new btn btn-danger ms-2 waves-effect waves-light"
                                            type="button">
                                            {{ __('Cancelled') }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12" style="text-align:center; color:red">
                                {{ __('No data') }}
                            </td>
                        </tr>
                    @endif
            </table>
            <div class="mt-3">
                {{ $list_deposit->links() }}
            </div>
        </div>
    </div>

</div>
