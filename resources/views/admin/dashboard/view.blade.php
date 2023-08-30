<div class="crm sales">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">
                                <ul class="atbd-breadcrumb nav">
                                    <li class="atbd-breadcrumb__item">
                                        <span>{{ Helper::getCurrentUrlAdmin() }}</span>
                                    </li>
                                </ul>
                                <br>
                                Good {{ Ucfirst($time_of_day) }} {{ ucfirst(Auth::guard('admin')->user()->name) }}, what
                                can
                                i
                                do to help you?
                                <br>
                                <small>{{ $now->isoFormat('dddd, Do MMMM Y') }}, <label id="clock"></label>
                                </small>
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- ends: .row -->
                <div class="row">
                    <div class="col-xxl-4">
                        <div class="row">
                            <div class="col-xxl-12 col-md-6">
                                <!-- Card 2 End  -->
                                <div
                                    class="ap-po-details ap-po-details--2 p-30 radius-xl bg-white d-flex justify-content-between mb-25">
                                    <div>
                                        <div class="overview-content overview-content3">
                                            <div class="d-flex">
                                                <div class="revenue-chart-box__Icon mr-20 order-bg-opacity-primary">
                                                    <img src="{{ asset('img/svg/customer.svg') }}" alt="img"
                                                        class="svg">
                                                </div>
                                                <div>
                                                    <h2>{{ number_format($participant_total, 0, ',', ',') }}</h2>
                                                    <p class="mb-3 mt-1">Participants</p>
                                                    <div class="ap-po-details-time">
                                                        <span class="color-success">
                                                            <strong>{{ number_format($participant_hadir, 0, ',', ',') }}
                                                                Orang Hadir</strong></span>
                                                        {{-- <small>Since last week</small> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Card 2 End  -->
                            </div>
                            {{-- <div class="col-xxl-12 col-md-6">
                                <!-- Card 1 -->

                                <!-- Card 1 End -->
                            </div> --}}
                            {{-- <div class="col-xxl-12 col-md-6">
                                <!-- Card 3 -->
                                <div
                                    class="ap-po-details ap-po-details--2 p-30 radius-xl bg-white d-flex justify-content-between mb-25">
                                    <div>
                                        <div class="overview-content overview-content3">
                                            <div class="d-flex">
                                                <div class="revenue-chart-box__Icon mr-20 order-bg-opacity-success">
                                                    <img src="{{ asset('img/svg/profit.svg') }}" alt="img"
                                                        class="svg">
                                                </div>
                                                <div>
                                                    <h2>$40.2k</h2>
                                                    <p class="mb-3 mt-1">Profit</p>
                                                    <div class="ap-po-details-time">
                                                        <span class="color-danger"><i class="las la-arrow-down"></i>
                                                            <strong>8.2%</strong></span>
                                                        <small>Since last week</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Card 3 End -->
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-6 mb-25">
                        <div
                            class="ap-po-details ap-po-details--2 p-30 radius-xl bg-white d-flex justify-content-between mb-25">
                            <div>
                                <div class="overview-content overview-content3">
                                    <div class="d-flex">
                                        <div class="revenue-chart-box__Icon mr-20 order-bg-opacity-secondary">
                                            <img src="{{ asset('img/svg/revenue.svg') }}" alt="img" class="svg">
                                        </div>
                                        <div>
                                            <h2>{{ number_format($event_total, 0, ',', ',') }}</h2>
                                            <p class="mb-3 mt-1">Events</p>
                                            <div class="ap-po-details-time">
                                                <span class="color-success">
                                                    <strong>{{ number_format($event_active, 0, ',', ',') }} Event
                                                        Active</strong></span>
                                                {{-- <small>Since last week</small> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
