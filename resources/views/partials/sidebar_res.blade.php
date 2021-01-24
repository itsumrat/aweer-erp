        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="{{ route('dashboard') }}">Aweer Inventory</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="logo">
                        <img class="img-responsive img-rounded" src="{{ asset('assets/img/logo-xs.png') }}" alt="User picture">
                    </div>
                </div>

                <div class="sidebar-menu" id="nav">
                    <ul>
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="fa fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Inventory</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="{{ route('items.index') }}">All Items</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('items.create') }}">Add Items</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('item.price.edit') }}">Price update</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('item.promotion.create') }}">Add Promotional Product</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('offer.create') }}">Set offer</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('adjustment.index') }}">All Adjustments</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('adjustment.create') }}">Add Adjustments</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('damage.index') }}">All Damage</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('damage.create') }}">Add Damage</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('item.anatomy.index') }}">Items Anatomy</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('item.detail') }}">Items Details</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('stock_calculation.create') }}">Stock calculation</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('stock_calculation.index') }}">zone count history</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <span>Settings</span>
                            </a>
                            <div class="sidebar-submenu">
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
                                        <a href="{{ route('vendors.index') }}">Vendors</a>
                                    </li>
                                    <li>
                                        <a href="users.php">Users</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
        </nav>