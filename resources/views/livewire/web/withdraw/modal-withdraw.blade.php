<div class="modal fade" id="kt_modal_update" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-scrollable mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <div class="card-header d-flex align-items-center">
                    <h4 class="mb-0 text-white">Enter Amount
                    </h4>
                    <div class="check_box check_box2" style="margin-left: 10px;">
                        <label class="radio_btn">
                            <input type="radio" name="type" value="process_18" data-fiat="USD" checked=""
                                style="display:none">
                            <span class="checkmark1">
                                <p class="text-white font-weight-bold"><img src="images/18.png" class="pay">
                                    USDT</p>
                            </span>
                        </label>
                    </div>
                </div>
                <!--end::Modal title-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </div>
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body">
                <form action="#" wire:submit.prevent="submit">
                    <div class="tab-content wd_box" id="pills-tabContent">
                        @if (session('error'))
                            <div class="error">{{ session('error') }}</div>
                        @endif
                        <div class="form1">
                            <div class="form_box">
                                <h3> Enter withdrawal Amount ($) </h3>
                                <h4> <i class="ri-money-dollar-circle-line"></i> <input required type="text" name="amount"
                                        wire:model.defer="amount" size="15" class="inpts" id="inv_amount">
                                </h4>
                            </div>
                            <div class="form_but">
                                <button type="submit" class="sbmt">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
