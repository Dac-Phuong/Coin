<div class="wrapper">
    @include('web.layouts.navbar')
    <section class="home-section">
        <style>
            tr th {
                text-align: center;
            }

            tr {
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
                        <h1 class="head">List deposit </h1> <br>
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
                        <a href="{{ url('/') }}" wire:navigate class="but2"> Deposit </a>
                        <a href="{{ url('/withdraw') }}" wire:navigate class="but"> Withdraw</a>
                        <a href="{{ url('/logout') }}" wire:navigate class="but2"> logout</a>
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
                        <h4>$<b>{{ number_format($investor->balance, 4, '.', ',') }} </b></h4><b>
                    </div>
                    <h1 class="head3"> 02.List Deposit</h1>
                    <div style="max-width: 1600px ; margin: auto">
                        <div class="row">
                            <div class="table-responsive mt-4">
                                <table cellspacing="0" cellpadding="1" class="form deposit_confirm"
                                    style="background: #FFF !important;border:1px solid #ccc !important ">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Plan</th>
                                            <th scope="col">number of days</th>
                                            <th scope="col">Profit</th>
                                            <th scope="col">Deposits Amount</th>
                                            <th scope="col">Amount Received</th>
                                            <th scope="col">Send date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($list_deposit) > 0)
                                            @foreach ($list_deposit as $key => $deposit)
                                                <tr>
                                                    <td scope="row" style="background: none;color: #fff">
                                                        {{ ++$key }}</td>
                                                    <td style="background: none;color: #fff">{{ $deposit->name }}</td>
                                                    <td>{{ $deposit->number_days }}</td>
                                                    <td>{{ $deposit->plan_discount }}%</td>
                                                    <td>${{ $deposit->amount }}</td>
                                                    <td>${{ $deposit->total_amount }}</td>

                                                    <td>{{$deposit->start_date ?? $deposit->from_date }}
                                                    </td>
                                                    @if ($deposit->investor_with_plants_status == 0)
                                                        <td class="text-primary">
                                                            Pending
                                                        </td>
                                                    @elseif($deposit->investor_with_plants_status == 1)
                                                        <td class="text-warning">
                                                            Running
                                                        </td>
                                                    @elseif($deposit->investor_with_plants_status == 2)
                                                        <td class="text-success">
                                                            Success
                                                        </td>
                                                    @else
                                                        <td class="text-danger">
                                                            Cancel
                                                        </td>
                                                    @endif
                                                    <td>
                                                        @if ($deposit->investor_with_plants_status == 0 || $deposit->investor_with_plants_status == 1)
                                                            <div class="text_but p-0" data-kt-action="update"
                                                                data-id={{ $deposit->Investor_with_plants_id }}
                                                                {{-- wire:click="cancel({{ $deposit->Investor_with_plants_id }})" --}} data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_update"
                                                                style="margin-left: 20px; cursor: pointer;">
                                                                <div class="but p-2 text-white font-weight-bold">
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
                                    {{ $list_deposit->links() }}
                                </div>
                            </div>
                            <livewire:web.deposit.confirm-modal />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
