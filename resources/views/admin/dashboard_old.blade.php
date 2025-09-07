@include('layouts.admin.header')

      <!-- sa-app__body -->
            <div class="sa-app__body px-2 px-lg-4" id="top">
                <div class="container pb-6">
                    <div class="py-5">
                        <div class="row g-4 align-items-center">
                            <div class="col">
                                <h1 class="h3 m-0">Dashboard</h1>
                            </div>
                          
                        </div>
                    </div>
                    <div class="row g-4 g-xl-5">

                    	<div class="col-12 col-md-4 d-flex">
                            <div class="card saw-indicator flex-grow-1" data-sa-container-query="{&quot;340&quot;:&quot;saw-indicator--size--lg&quot;}">
                                <div class="sa-widget-header saw-indicator__header">
                                    <h2 class="sa-widget-header__title">Total Users</h2>
                                    
                                </div>
                                <div class="saw-indicator__body">
                                    <div class="saw-indicator__value">
                                        {{$users}}
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card saw-indicator flex-grow-1" data-sa-container-query="{&quot;340&quot;:&quot;saw-indicator--size--lg&quot;}">
                                <div class="sa-widget-header saw-indicator__header">
                                    <h2 class="sa-widget-header__title">Total orders</h2>
                                    
                                </div>
                                <div class="saw-indicator__body">
                                    <div class="saw-indicator__value">
                                        {{$orders}}
                                    </div>
                                   
                                </div>
                            </div>
                        </div>

                         <div class="col-12 col-md-4 d-flex">
                            <div class="card saw-indicator flex-grow-1" data-sa-container-query="{&quot;340&quot;:&quot;saw-indicator--size--lg&quot;}">
                                <div class="sa-widget-header saw-indicator__header">
                                    <h2 class="sa-widget-header__title">Total Amount</h2>
                                    
                                </div>
                                <div class="saw-indicator__body">
                                    <div class="saw-indicator__value">
                                        ${{$orders_amount}}
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-12 col-xxl-9 d-flex">
                            <div class="card flex-grow-1 saw-table">
                                <div class="sa-widget-header saw-table__header">
                                    <h2 class="sa-widget-header__title">Recent orders</h2>
                                    <div class="sa-widget-header__actions">
                                        
                                    </div>
                                </div>
                                <div class="saw-table__body sa-widget-table text-nowrap">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                
                                                
                                                <th>Date</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentOrders as $recentOrder)
                                            <tr>
                                                <td>
                                                <div class="d-flex fs-6">
                                                    <div class="{{ $recentOrder->status == 'Approved' ? 'badge badge-sa-success' : 'badge badge-sa-danger' }}">
                                                        {{$recentOrder->status}}
                                                    </div>
                                                </div>
                                                </td>
                                             
                                                <td>{{$recentOrder->date}}</td>
                                                <td>${{$recentOrder->total}}</td>
                                            </tr>
                                           @endforeach
                               
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                        
                    </div>
                </div>
            </div>

            <!-- sa-app__body / end -->



@include('layouts.admin.footer')

</body>
</html>