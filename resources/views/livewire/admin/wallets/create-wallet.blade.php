<div class="modal fade" id="kt_modal_add" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <div class="card-header mt-2 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('Add New Wallet') }}</h4>
                </div>
                <!--end::Modal title-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </div>
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body mb-3">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" class="form" action="#" wire:submit.prevent="submit"
                    enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <!--begin::Input group-->
                    <div class="mb-4">
                        <div>
                            <label for="exampleFormControlTextarea1" class="form-label">{{ __('Enter list wallet') }}<i
                                    class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                    aria-label="{{ __('Note: Each wallet is 1 line') }}"
                                    data-bs-original-title="{{ __('Note: Each wallet is 1 line') }}"></i></label>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-country">{{ __('Name plan') }}</label>
                                <select class="form-select" required wire:model.defer="plan_id"
                                    id="basic-default-country">
                                    <option value="">{{ __('Select plan') }} </option>
                                    @foreach ($plan as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} - ${{ $item->min_deposit }}</option>
                                    @endforeach
                                </select>
                                @error('plan_id')
                                    <span class="error text-danger fs-7">{{ $message }}</span>
                                @enderror
                            </div>
                            <textarea class="form-control" placeholder="{{ __('Enter list wallet BSC') }}" wire:model.defer="address_wallet_bsc"
                                id="exampleFormControlTextarea1" rows="10"></textarea>
                            @error('address_wallet_bsc')
                                <span class="error text-danger fs-7">{{ $message }}</span>
                            @enderror
                            <textarea class="form-control  mt-2" placeholder="{{ __('Enter list wallet TRON') }}" wire:model.defer="address_wallet_tron"
                                id="exampleFormControlTextarea1" rows="10"></textarea>
                            @error('address_wallet_tron')
                                <span class="error text-danger fs-7">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close"
                            wire:loading.attr="disabled">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">{{ __('Save') }}</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                ...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
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
