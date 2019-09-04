@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Goal')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('goal.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    @foreach ($goals as $goal)
                    <div class="card-body">
                        <form method="post" action="{{ route('goal.update', $goal->id) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">{{ __('Amount') }}</label>
                                    <input type="text" name="amount" id="input-name" class="form-control" placeholder="{{ __('Amount') }}" value="{{ $goal->goal }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-type">{{ __('Type') }}</label>
                                    <select name="type" class="form-control">
                                        <option value="Marriage" {{ ( $goal->type == "Marriage") ? 'selected' : '' }}>Marriage</option>
                                        <option value="Loan" {{ ( $goal->type == "Loan") ? 'selected' : '' }}>Loan</option>
                                        <option value="Car" {{ ( $goal->type == "Car") ? 'selected' : '' }}>Car</option>
                                        <option value="Saving" {{ ( $goal->type == "Saving") ? 'selected' : '' }}>Saving</option>
                                        <option value="Miscellaneous" {{ ( $goal->type == "Miscellaneous") ? 'selected' : '' }}>Miscellaneous</option>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection