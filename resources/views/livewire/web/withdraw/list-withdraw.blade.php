<div class="wrapper">
    @include('web.layouts.navbar')
    <section class="home-section">
        <style>
            tr th{
                text-align: center

            }
            tr{
                height: 55px !important;
            }
            tr td {
                text-align: center;
                color: #000 !important;
            }
        </style>
        <div class="headerall_top" wire:poll.10s>
            <div class="row">
                <div class="col-lg-3">
                    <a href="{{ url('/') }}" wire:navigate> <h2 class="pl-2 pt-3 items-center" style="font-size: 26px;text-transform: uppercase;font-weight: 700">
                            Stakingcoins</h2></a>
                </div>
                <div class="col-lg-5">
                    <div class="home-content">
                        <i class="ri-menu-line"></i>
                        <h1 class="head">Withdraw </h1> <br>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="home-content1">
                        <li>
                            <h3> <i class="ri-map-pin-user-line"></i> user :<span> {{ $investor->fullname }}</span></h3>
                            <h3> <i class="ri-mail-open-line"></i> Email: <span> {{ $investor->email }}</span> </h3>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8">
                    <div class="refer_copy">
                        <img src="images/acc_img3.png" class="img-fluid acc_img2">
                        <h3>
                            Referal link
                            <input type="text" wire:model.refer="ref" readonly id="myInput"
                                onclick="this.select();">
                            <button onclick="copyToClipboard()"><i class="ri-link-unlink-m"></i></button>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text_but">
                        <a href="{{ url('/deposit') }}" wire:navigate class="but2"> Deposit </a>
                        <a href="{{ url('/withdraw') }}" wire:navigate class="but"> Withdraw</a>
                        <a href="{{ url('logout') }}" wire:navigate class="but2"> logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin1_bg">
            <div class="container-fluid">
                <div class="depo_bg">
                    <h1 class="head3"> 01.Balance Details</h1>
                    <div class="form_block1">
                        <img src="images/acc_img4.png" class="acc_img4 img-fluid">
                        <h3> Account Balance</h3>
                        <h4>$<b>{{number_format($investor->balance, 4, '.', ',')}} </b></h4><b>
                    </div>
                    <div class="d-flex align-items-center">
                        <h1 class="head3"> 02.List Withdraw </h1>
                        <div data-id="" data-bs-toggle="modal" data-bs-target="#kt_modal_update"
                            class="text_but p-0"
                            style="margin-left: 20px;cursor: pointer; width: 120px; margin-top: 9px;">
                            <div class="but p-2  text-white font-weight-bold">
                                Withdraw
                            </div>
                        </div>
                    </div>
                    <div style="max-width: 1600px ; margin: auto">
                        <div class="row">
                            <div class="table-responsive mt-4">
                                <table cellspacing="0" cellpadding="1" class="form deposit_confirm" style="background: #fff !important;border:1px solid #ccc !important">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Amount Withdraw</th>
                                            <th scope="col">Withdrawal Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($list_withdraw) > 0)
                                            @foreach ($list_withdraw as $key => $withdraw)
                                                <tr>
                                                    <td scope="row" style="background: none;color: #fff">
                                                        {{ ++$key }}</td>
                                                    <td style="background: none;color: #fff">${{ $withdraw->amount }}
                                                    </td>
                                                    <td>{{ $withdraw->created_at }}</td>
                                                    <td
                                                        class="{{ $withdraw->status == 0 ? 'text-primary' : ($withdraw->status == 1 ? 'text-success' : ($withdraw->status == 2 ? 'text-danger' : 'text-danger')) }}">
                                                        {{ $withdraw->status == 0 ? 'Pending' : ($withdraw->status == 1 ? 'Success' : ($withdraw->status == 2 ? 'Cancel' : 'Cancel')) }}
                                                    <td style="max-width: 50px">
                                                        @if ($withdraw->status == 0)
                                                            <div class="text_but p-0"
                                                                wire:click="cancel({{ $withdraw->id }})"
                                                                style="margin-left: 20px;cursor: pointer;">
                                                                <div class="but p-2  text-white font-weight-bold">
                                                                    Cancel
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="12" style="text-align:center; color:white">
                                                    Chưa có dữ liệu.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $list_withdraw->links() }}
                                </div>
                            </div>
                            <livewire:web.withdraw.modal-withdraw />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
