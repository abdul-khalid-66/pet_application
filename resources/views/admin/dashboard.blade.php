

<x-app-layout>
    <x-slot name="page_title">Dashboard</x-slot>

    <div class="row">
        <!-- Sales Card -->
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Today's Sales</h6>
                            <h4 class="mb-0">$12,345</h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-cash-coin fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-success">+12%</span>
                        <span class="text-muted ms-2">from yesterday</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animals Card -->
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Animals</h6>
                            <h4 class="mb-0">1,234</h4>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-egg-fill fs-3 text-info"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-success">+5%</span>
                        <span class="text-muted ms-2">last 7 days</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Registered Users</h6>
                            <h4 class="mb-0">5,678</h4>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-people-fill fs-3 text-warning"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-success">+8%</span>
                        <span class="text-muted ms-2">last month</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Pending Orders</h6>
                            <h4 class="mb-0">42</h4>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-cart fs-3 text-danger"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-danger">-3%</span>
                        <span class="text-muted ms-2">from yesterday</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Sales</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Animal</th>
                                    <th>Buyer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#PM-1234</td>
                                    <td>Golden Retriever</td>
                                    <td>John Smith</td>
                                    <td>$1,200</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>#PM-1233</td>
                                    <td>Persian Cat</td>
                                    <td>Sarah Johnson</td>
                                    <td>$850</td>
                                    <td><span class="badge bg-warning">Shipping</span></td>
                                </tr>
                                <tr>
                                    <td>#PM-1232</td>
                                    <td>African Grey Parrot</td>
                                    <td>Michael Brown</td>
                                    <td>$1,500</td>
                                    <td><span class="badge bg-info">Processing</span></td>
                                </tr>
                                <tr>
                                    <td>#PM-1231</td>
                                    <td>Bearded Dragon</td>
                                    <td>Emily Davis</td>
                                    <td>$300</td>
                                    <td><span class="badge bg-danger">Cancelled</span></td>
                                </tr>
                                <tr>
                                    <td>#PM-1230</td>
                                    <td>Holland Lop Rabbit</td>
                                    <td>David Wilson</td>
                                    <td>$450</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Activities</h5>
                </div>
                <div class="card-body">
                    <div class="activity-feed">
                        <div class="feed-item">
                            <div class="feed-item-icon bg-primary">
                                <i class="bi bi-cart-check"></i>
                            </div>
                            <div class="feed-item-content">
                                <p class="mb-1">New order placed #PM-1234</p>
                                <small class="text-muted">15 minutes ago</small>
                            </div>
                        </div>
                        <div class="feed-item">
                            <div class="feed-item-icon bg-success">
                                <i class="bi bi-coin"></i>
                            </div>
                            <div class="feed-item-content">
                                <p class="mb-1">Payment received from John Smith</p>
                                <small class="text-muted">1 hour ago</small>
                            </div>
                        </div>
                        <div class="feed-item">
                            <div class="feed-item-icon bg-info">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="feed-item-content">
                                <p class="mb-1">New seller registered: PetLovers Inc.</p>
                                <small class="text-muted">3 hours ago</small>
                            </div>
                        </div>
                        <div class="feed-item">
                            <div class="feed-item-icon bg-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="feed-item-content">
                                <p class="mb-1">Report received about order #PM-1228</p>
                                <small class="text-muted">5 hours ago</small>
                            </div>
                        </div>
                        <div class="feed-item">
                            <div class="feed-item-icon bg-danger">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div class="feed-item-content">
                                <p class="mb-1">Order #PM-1225 cancelled</p>
                                <small class="text-muted">Yesterday</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>