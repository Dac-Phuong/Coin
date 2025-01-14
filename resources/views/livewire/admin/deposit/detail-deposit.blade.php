<div class="modal fade" id="kt_modal_update" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px" style="max-width: 1000px;">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body mb-3">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" class="form" action="#" wire:submit.prevent="submit"
                    enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <!--begin::Input group-->
                    <div class="mb-4">
                        <div class="card" style="box-shadow: none">
                            <div class="d-flex justify-between items-center">
                                <h5 class="card-header p-2 mt-1" style="padding-left: 0px">{{ __('Deposit details') }}
                                </h5>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary waves-effect waves-light"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ti ti-x"></i>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <div class="table-responsive ">
                                    <table cellspacing="0" cellpadding="2" class="form deposit_confirm relative">
                                        <tbody>
                                            <tr>
                                                <th>{{ __('Name plan') }}:</th>
                                                <td>{{ isset($detail) ? $detail->plan_name : '' }}</td>
                                                @if ($this->generateQrCode())
                                                    <td rowspan="6"
                                                        style="width: 150px !important; position: relative;">
                                                        {!! $this->generateQrCode() !!}
                                                        <span
                                                            style="position: absolute;  right: 60px; {{ isset($plan) && $plan->package_type == 1 ? 'bottom: 0' : 'bottom: 35px ;' }}">BSC</span>
                                                    </td>
                                                @endif
                                                @if ($this->generateQrCode1())
                                                    <td rowspan="6"
                                                        style="width: 150px !important;position: relative;">
                                                        {!! $this->generateQrCode1() !!}
                                                        <span
                                                            style="position: absolute; bottom: 35px; right: 60px; {{ isset($plan) && $plan->package_type == 1 ? 'bottom: 0' : 'bottom: 35px ;' }}">TRON</span>
                                                    </td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th>{{ __('Profit') }}:</th>
                                                <td>{{ isset($detail) ? $detail->profit : '' }}%</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Deposit amount') }}:</th>
                                                <td>${{ isset($detail) ? $detail->amount : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Amount received') }}:</th>
                                                <td>${{ isset($detail) ? $detail->total_amount : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Sender') }}:</th>
                                                <td>{{ isset($detail) ? $detail->investor_name : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Number of days sent') }}:</th>
                                                <td>{{ isset($detail) ? $detail->number_days : '' }} days</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Sent date') }}:</th>
                                                <td>{{ isset($detail) ? $detail->created_at : '' }}</td>
                                            </tr>
                                            @if (isset($detail) && $detail->wallet_address_bsc)
                                                <tr>
                                                    <th>{{ __('Wallet BSC') }}:</th>
                                                    <td>{{ $detail->wallet_address_bsc }}</td>
                                                </tr>
                                            @endif
                                            @if (isset($detail) && $detail->wallet_address_tron)
                                                <tr>
                                                    <th>{{ __('Wallet TRON') }}:</th>
                                                    <td>{{ $detail->wallet_address_tron }}</td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th>{{ __('Status') }}:</th>
                                                <td
                                                    class="{{ isset($detail) && $detail->status == 0 ? 'text-primary' : (isset($detail) && $detail->status == 1 ? 'text-warning' : (isset($detail) && $detail->status == 2 ? 'text-success' : 'text-danger')) }}">
                                                    {{ isset($detail) && $detail->status == 0 ? 'Pending' : (isset($detail) && $detail->status == 1 ? 'Running' : (isset($detail) && $detail->status == 2 ? 'Success' : 'Cancel')) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close"
                            wire:loading.attr="disabled">{{ __('Cancel') }}</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
