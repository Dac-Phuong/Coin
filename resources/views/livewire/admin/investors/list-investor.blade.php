    <!-- Responsive Datatable -->
    <div>
        <h4 class="py-3 mb-2">
            <span class="text-muted fw-light">{{ __('Investor Manager') }} /</span> {{ __('List Investor') }}
        </h4>
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">{{ __('List Investor') }}</h5>
                <button class="dt-button add-new btn btn-primary ms-2 waves-effect waves-light" style="margin-right:24px"
                    type="button" data-bs-toggle="modal" data-bs-target="#kt_modal_add">
                    <span>
                        <i class="ti ti-plus ti-xs me-0 me-sm-2"></i>
                        <span class="d-none d-sm-inline-block">{{ __('Add New') }}</span>
                    </span>
                </button>
            </div>
            <div class="col-md-2 ml-auto mr-3" style="margin-left:auto;margin-right:25px">
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                    <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                        placeholder="{{ __('Search...') }}" aria-label="Search..."
                        aria-describedby="basic-addon-search31" fdprocessedid="pjzbzc">
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3 mb-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>{{ __('User Name') }}</th>
                            <th>{{ __('Email Address') }}</th>
                            <th>{{ __('Wallet address') }}</th>
                            <th>{{ __('Account Balance') }}</th>
                            <th>{{ __('Created Date') }}</th>
                            <th style="width:80px">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($list_investor) > 0)
                            @foreach ($list_investor as $key => $investor)
                                <tr class="odd cursor-pointer">
                                    <td data-kt-action="update" data-id={{ $investor->id }} data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_update1">{{ ++$key }}</td>
                                    <td data-kt-action="update" data-id={{ $investor->id }} data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_update1">{{ $investor->fullname }}</td>
                                    <td data-kt-action="update" data-id={{ $investor->id }} data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_update1">{{ $investor->email }}</td>
                                    <td data-kt-action="update" data-id={{ $investor->id }} data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_update1">{{ $investor->wallet_address }}</td>
                                    <td data-kt-action="update" data-id={{ $investor->id }} data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_update1">${{ $investor->balance }}</td>
                                    <td data-kt-action="update" data-id={{ $investor->id }} data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_update1">{{ $investor->created_at }}</td>
                                    <td>
                                        <div class="dropdown" wire:ignore>
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a href="{{ url('admin/history-deposit', ['id' => $investor->id]) }}"
                                                    class="dropdown-item"><i class="ti ti-history"></i>
                                                    {{ __('History Deposit') }}</a>
                                                <a href="{{ url('admin/history-withdraw', ['id' => $investor->id]) }}"
                                                    class="dropdown-item"><i class="ti ti-history"></i>
                                                    {{ __('History Withdrawals') }}</a>
                                                <button data-kt-action="update" data-id={{ $investor->id }}
                                                    data-bs-toggle="modal" data-bs-target="#kt_modal_update"
                                                    class="dropdown-item"><i class="ti ti-pencil me-1"></i>
                                                    {{ __('Update') }}</button>
                                                <button wire:click="delete({{ $investor->id }})" class="dropdown-item"
                                                    href="javascript:void(0);"><i class="ti ti-trash me-1"></i>
                                                    {{ __('Delete') }}</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12" style="text-align:center; color:red">
                                    {{ __('No data') }}.
                                </td>
                            </tr>
                        @endif
                </table>
                <div class="mt-3">
                    {{ $list_investor->links() }}
                </div>
            </div>

        </div>
    </div>
