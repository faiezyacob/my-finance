
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                @if ($goals->isEmpty())
                <div class="col-xl-12 col-lg-6 mt-3">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Wow, such empty!</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="mt-3 mb-0 text-muted text-m">Start adding your goal today so we can arrange things for you. What will you get when you add those goals?
                                        <ul class="mt-2 text-sm">
                                            <li>We will track your progress monthly</li>
                                            <li>We will show how many months/years you need to commit</li>
                                        </ul>
                                    </p>
                                    <p class="text-muted text-m">
                                        What are you waiting for? Click <a href="{{ route('goal.index') }}">here</a> to start!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                @foreach ($goals as $goal)
                
                <div class="col-xl-3 col-lg-6 mt-3">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{$goal->description}}
                                    @if ($total >= $goal->goal) 
                                    <span class="badge badge-success">Completed</span>
                                    @endif
                                    </h5>
                                    <span class="h2 font-weight-bold mb-0">RM {{number_format($total, 2)}}</span> from <br>
                                    <span class="h4 font-weight-bold mb-0">RM {{number_format($goal->goal, 2)}}</span>

                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                                @php if ($goal->goal != null) { @endphp
                                {{(number_format(($total/$goal->goal)*100,2))}}%</span>
                                <span class="text-nowrap">progress since last month</span>
                                @php } else {@endphp
                                0.0%</span>
                                <span class="text-nowrap">progress since last month</span>
                                @php } @endphp
                            </p>
                            @if (auth()->user()->monthly != null)
                            <p class="mt-3 mb-0 text-muted text-sm">If you save <b>RM{{ auth()->user()->monthly }}</b> each month, you have to commit for another {{number_format(($goal->goal-$total)/480,0)}} months  @if (($goal->goal-$total)/480 >= 12) or {{number_format(($goal->goal-$total)/480/12,0)}} years. @endif
                            </p>
                            @else
                            <p class="mt-3 mb-0 text-muted text-sm">Click <a href="{{ route('profile.edit') }}">here</a> to update your monthly commitment.
                            </p>
                            @endif
                        </div>
                    </div>
                </div>                
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>