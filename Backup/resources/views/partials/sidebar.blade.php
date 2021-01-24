        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="dashboard.php">Enterprise Intelligence<br><h5>EI-365</h5></a>
                    <div id="close-sidebar">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="logo">
                        <img class="img-responsive img-rounded" src="{{ asset('public/assets/img/logo-alt.png') }}" alt="User picture">
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul>
                        <li>
                            <span>Dashboard</span>
                        </li>
                        
                        <li>
                            <span>Inventory</span>
                            <ul>
                                <li>
                                    <a href="{{ route('items.index') }}">Manage Items</a>
                                </li>
                                <li>
                                    <a href="{{ route('items.create') }}">Add Item</a>
                                </li>
                                <li>
                                    <a href="{{ route('item.price.edit') }}">Price Change</a>
                                </li>
                                <li>
                                    <a href="{{ route('item.promotion.create') }}">Add Promo Item</a>
                                </li>
                                <li>
                                    <a href="{{ route('offer.create') }}">Create Offer</a>
                                </li>
                                <li>
                                    <a href="{{ route('adjustment.index') }}">Manage Adjustments</a>
                                </li>
                                <li>
                                    <a href="{{ route('adjustment.create') }}">Add Adjustments</a>
                                </li>
                                <li>
                                    <a href="{{ route('damage.index') }}">Manage Damage</a>
                                </li>
                                <li>
                                    <a href="{{ route('damage.create') }}">Add Damage</a>
                                </li>
                                <li>
                                    <a href="{{ route('item.anatomy.index') }}">Item Details</a>
                                </li>
                                <li>
                                    <a href="{{ route('item.detail') }}">Item Movement History</a>
                                </li>
                                <li>
                                    <a href="{{ route('stock_calculation.create') }}">Stock Calculation</a>
                                </li>
                                <li>
                                    <a href="{{ route('stock_calculation.index') }}">Zone Count History</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>requisition</span>
                            <ul>
                                <li>
                                    <a href="{{ route('vegetable_requisition.create') }}">Add requisition</a>
                                </li>
                                <li>
                                    <a href="{{ route('requisition_summery') }}">Requisition summary</a>
                                </li>
                                <li>
                                    <a href="{{ route('vegetable_requisition.index') }}">Manage F&V Requisition</a>
                                </li>
                                <li>
                                    <a href="{{ route('dc_requisition.index') }}">Manage DC Requisition</a>
                                </li>
                                <li>
                                    <a href="{{ route('dsd_requisition.index') }}">Manage DSD Requisition</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Purchase</span>
                            <ul>
                                <li>
                                    <a href="{{ route('purchase.create') }}">Create LPO</a>
                                </li>
                                <li>
                                    <a href="{{ route('purchase.index') }}">Manage LPO</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Transfer</span>
                            <ul>
                                <li>
                                    <a href="{{ route('transfer.index') }}">transfer list</a>
                                </li>
                                <li>
                                    <a href="{{ route('transfer.create') }}">add transfer</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Receivings</span>
                            <ul>
                                <li>
                                    <a href="{{ route('lpo_receive.create') }}" data-toggle="modal" data-target="#itemTrackModal">Receive LPO</a>
                                </li>
                                <li>
                                    <a href="{{ route('lpo_receive.index') }}">Manage GRN</a>
                                </li>
                                <li>
                                    <a href="{{ route('tnt_receive.create') }}" data-toggle="modal" data-target="#shopTrackModal">Receive TRN</a>
                                </li>
                                <li>
                                    <a href="{{ route('tnt_receive.index') }}">Manage Receive TRN</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Return</span>
                            <ul>
                                <li>
                                    <a href="{{ route('purchase_return.create') }}">Make GRV</a>
                                </li>
                                <li>
                                    <a href="{{ route('purchase_return.index') }}">Manage GRV</a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="{{ route('transfer_return.index') }}">transfer return list</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="{{ route('transfer_return.create') }}">add transfer return</a>-->
                                <!--</li>-->
                            </ul>
                        </li>
{{--                    <li>
                            <span>Vendor</span>
                            <ul>
                                <li>
                                    <a href="#">Manage Vendors</a>
                                </li>
                                <li>
                                    <a href="#">add Vendor</a>
                                </li>
                                <li>
                                    <a href="vendor-ledger.php">Vendor ledger</a>
                                </li>
                            </ul>
                        </li> --}}
                        <li>
                            <span>Accounts</span>
                            <ul>
                                <li>
                                    <a href="{{ route('unpaid_grn') }}">unpaid GRN</a>
                                </li>
                                <li>
                                    <a href="{{ route('paid_grn') }}">paid GRN</a>
                                </li>
                                <li>
                                    <a href="{{ route('vendor_trasaction') }}">vendor transaction</a>
                                </li>
                                <li>
                                    <a href="{{ route('payment_voucher') }}">payment voucher</a>
                                </li>
                                <li>
                                    <a href="{{ route('payment_advanced') }}">payment advanced</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Finance</span>
                            <ul>
                                <li>
                                    <a href="{{ route('ledger.index') }}">Ledgers</a>
                                </li>
                                <li>
                                    <a href="{{ route('subledger.index') }}">SubLedgers</a>
                                </li>
                                <li>
                                    <a href="{{ route('ledger_entry.index') }}">Transaction List</a>
                                </li>
                                <li>
                                    <a href="{{ route('ledger_entry.create') }}">Ledger Entry</a>
                                </li>
                                <li>
                                    <a href="{{ route('audit_hand_over.create') }}">Audit / Handing Over</a>
                                </li>
                                <li>
                                    <a href="{{ route('daily_cash_closing.create') }}">Daily Cash Closing</a>
                                </li>
                                <li>
                                    <a href="{{ route('petty_cash.create') }}">Petty Cash</a>
                                </li>
                                <li>
                                    <a href="{{ route('petty_cash.index') }}">Manage Petty Cash</a>
                                </li>
                                <li>
                                    <a href="{{ route('cash_flow') }}">Cash Flow</a>
                                </li>
                                <li>
                                    <a href="{{ route('bank_flow') }}">Bank Flow</a>
                                </li>
                                <li>
                                    <a href="{{ route('balance_sheet') }}">Balance Sheet</a>
                                </li>
                                <li>
                                    <a href="{{ route('trial_balance') }}">Trial Balance</a>
                                </li>
                                <li>
                                    <a href="{{ route('pnl_report') }}">P&L Report</a>
                                </li>
                                <li>
                                    <a href="{{ route('vat_return.index') }}">VAT Return</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Settings</span>
                            <ul>
                                <li>
                                    <a href="{{ route('department.index') }}">Department</a>
                                </li>
                                <li>
                                    <a href="{{ route('unit.index') }}">Unit</a>
                                </li>
                                <li>
                                    <a href="{{ route('stores.index') }}">store</a>
                                </li>
                                <li>
                                    <a href="{{ route('category.index') }}">category</a>
                                </li>
                                <li>
                                    <a href="{{ route('tax.create') }}">Tax</a>
                                </li>
                                <li>
                                    <a href="{{ route('vendors.index') }}">Vendors</a>
                                </li>
                                <li>
                                    <a href="users.php">Users</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
                <!-- sidebar-menu  -->

            </div>
                    <ul class="navbar-profile">
                        <li>
                            <div class="dropdown">
                                <img class="avatar" src="https://img.faceyourmanga.com/mangatars/1/506/1506353/large_1715077.png" alt="logo">
                                <div class="dropdown-content">
                                    <ul>
                                        <li>
                                            <a href="profile.php">Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="quick-search">
                            <a href="#">
                                <img src="{{ asset('public/assets/img/quick-search.png') }}" alt="Quick Search"/>
                            </a>
                        </li>
                    </ul>
        </nav>