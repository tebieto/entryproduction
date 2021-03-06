@extends('layouts.app')
@section('content')
@include('inc.navbar')
<div class="links">
    @include('inc.links')   
</div>
<div class="main" id="app">
    <h2 class="page-header">EVENT MAINTENANCE</h2>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#create">CREATE</a></li>
        <li><a data-toggle="tab" href="#edit">EDIT</a></li>
        <li><a data-toggle="tab" href="#delete">DELETE</a></li>
    </ul>

    <div class="tab-content">
        <!-- create event tab starts here -->
            <div class="tab-pane fade in active" id="create">
                <h3>CREATE EVENT</h3><hr>
                <form class="cbranch" method="POST" action="/save/event">       
                    {{ csrf_field() }}
                    <div class="form-group col-sm-12">
                        <label for="eventName" class="col-sm-2 control-label">Name Of Event</label>                
                        <div class="col-sm-6 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-bookmark"></i></span>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="inputEvent" placeholder="e.g Sunday School Service">
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="eventDescription" class="col-sm-2 control-label">Description Of Event</label>                
                        <div class="col-sm-6 input-group">
                            <textarea name="description"  value="{{ old('description') }}"class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group col-sm-12 {{ $errors->has('month') ? ' has-error' : '' }}">
                            <label for="month" class="col-sm-2 control-label">Select Month:</label>
                            <div class="col-sm-6 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <select name="month"  class="form-control">
                                <option value="none" selected disabled><-- Please choose one --></option>
                                <option value="January" >January</option> 
                                <option value="February" >February</option>
                                <option value="March" >March</option>
                                <option value="April" >April</option> 
                                <option value="May" >May</option>
                                <option value="June" >June</option>
                                <option value="July" >July</option> 
                                <option value="August" >August</option>
                                <option value="September" >September</option>
                                <option value="October" >October</option> 
                                <option value="November" >November</option>
                                <option value="December" >December</option>
                            </select>
                            
                            <!--@if ($errors->has('month'))
                            <span class="help-block">
                            <strong>{{ $errors->first('month') }}</strong>
                            </span>
                            @endif-->
                        </div>
                    </div>
                    
                    <div class="form-group col-sm-12 {{ $errors->has('year') ? ' has-error' : '' }}">
                        <label for="year" class="col-sm-2 control-label">Select Year:</label>
                        <div class="col-sm-6 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-yen"></i></span>
                        <select name="year"  class="form-control">
                            <option value="0" selected disabled><-- Please choose one --></option>   
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                        </select>
                        <!--@if ($errors->has('year'))
                        <span class="help-block">
                        <strong>{{ $errors->first('year') }}</strong>
                        </span>
                        @endif-->
                        </div>
                    </div>

                    <div class="form-group col-sm-12 {{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-sm-2 control-label ">Country</label>                
                        <div class="col-sm-6 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                            <select class="input-medium bfh-countries form-control" data-country="NG" name="country"  id="inputCountry3" v-model="country" @change=getCountryBranches></select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group col-sm-12">
                        <label for="branch" class="col-sm-2 control-label">Select Branch:</label>
                        <div class="col-sm-6 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <select name="branch"  class="form-control"  v-model="activeBranch" @change="getActiveBranch">
                            <option value="0" selected disabled><-- Please choose one --></option>
                            <option v-for="branch in countryBranches" :value="branch.id">@{{branch.name}}</option>
                            <option v-if="countryBranches.length==0" value="">No branch to display</option>
                        </select>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <button type="button" class="btn btn-back pull-left"><i class="glyphicon glyphicon-arrow-left"></i><a href="/">BACK</a></button>
                        <button class="btn btn-create pull-right" type="submit">CREATE<i class="glyphicon glyphicon-send"></i></button>
                    </div>
                </form>
            </div> 
        <!-- create event tab ends here -->

        <!-- edit event tab starts here -->
            <div class="tab-pane fade" id="edit">
                <h3>EDIT EVENT</h3><hr>
                <form class="cbranch" method="POST" action="/edit/event">       
                    {{ csrf_field() }}

                    <div class="form-group col-sm-12 {{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-sm-2 control-label ">Country</label>                
                        <div class="col-sm-6 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                            <select class="input-medium bfh-countries form-control" data-country="NG" name="country"  id="inputCountry3" v-model="country" @change=getCountryBranches></select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group col-sm-12">
                        <label for="branch" class="col-sm-2 control-label">Select Branch:</label>
                        <div class="col-sm-6 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <select name="old"  class="form-control"  v-model="activeBranch" @change="getBranchEvents">
                            <option value="0" selected disabled><-- Please choose one --></option>
                            <option v-for="branch in countryBranches" :value="branch.id">@{{branch.name}}</option>
                            <option v-if="countryBranches.length==0" value="">No branch to display</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="event" class="col-sm-2 control-label">Select Event:</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-bookmark"></i></span>
                            <select name="event"  class="form-control" v-model="activeEvent" @change="getActiveEvent">
                            <option value="0" selected disabled><-- Please choose one --></option>
                            <option v-for="event in branchEvents" :value="event.id">@{{event.name}}</option>
                            <option v-if="branchEvents.length==0" value="">No event to display</option>
                            </select>
                        </div>
                    </div>

                    <p v-if="activeEventDetails.length>0">Now, Edit:</p>
                    <div v-if="activeEventDetails.length>0" class="form-group col-sm-12">
                        <label for="eventName" class="col-sm-2 control-label">Name Of Event</label>                
                        <div class="col-sm-6 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                            <input type="text" name="name" v-model="activeEventName" class="form-control" id="inputEvent" placeholder="e.g Sunday School Service">
                        </div>
                    </div>

                    <div class="form-group col-sm-12" v-if="activeEventDetails.length>0">
                        <label for="eventDescription" class="col-sm-2 control-label">Description Of Event</label>                
                        <div class="col-sm-6 input-group">
                            <textarea name="description" v-model="activeEventDescription" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group col-sm-12 {{ $errors->has('month') ? ' has-error' : '' }}" v-if="activeEventDetails.length>0">
                            <label for="month" class="col-sm-2 control-label">Edit Month:</label>
                            <div class="col-sm-6 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                            <select name="month"  class="form-control" v-model="activeMonth">
                                <option value="none" selected disabled>-- Please choose one--</option>
                                <option value="January" >January</option> 
                                <option value="February" >February</option>
                                <option value="March" >March</option>
                                <option value="April" >April</option> 
                                <option value="May" >May</option>
                                <option value="June" >June</option>
                                <option value="July" >July</option> 
                                <option value="August" >August</option>
                                <option value="September" >September</option>
                                <option value="October" >October</option> 
                                <option value="November" >November</option>
                                <option value="December" >December</option>
                            </select>
                            
                            <!--@if ($errors->has('month'))
                            <span class="help-block">
                            <strong>{{ $errors->first('month') }}</strong>
                            </span>
                            @endif-->
                        </div>
                    </div>
                    
                    <div class="form-group col-sm-12 {{ $errors->has('year') ? ' has-error' : '' }}" v-if="activeEventDetails.length>0">
                        <label for="year" class="col-sm-2 control-label">Edit Year:</label>
                        <div class="col-sm-6 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-yen"></i></span>
                        <select name="year"  class="form-control" v-model="activeYear">
                            <option value="0" selected disabled><-- Please choose one --></option>   
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                        </select>
                        
                        <!--@if ($errors->has('year'))
                        <span class="help-block">
                        <strong>{{ $errors->first('year') }}</strong>
                        </span>
                        @endif-->
                        </div>
                    </div>

                    <div class="form-group col-sm-12" v-if="activeEventDetails.length>0">
                        <label for="branch" class="col-sm-2 control-label">Edit Branch:</label>
                        <div class="col-sm-6 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <select name="branch"  class="form-control" v-model="oldBranch">
                            <option value="0" selected disabled><-- Please choose one --></option>
                            <option v-for="branch in countryBranches" :value="branch.id">@{{branch.name}}</option>
                            <option v-if="countryBranches.length==0" value="">No branch to display</option>
                        </select>
                        </div>
                    </div>

                <div class="col-sm-8" v-if="activeEventDetails.length>0">
                    <h5><strong>Modify Event?</strong></h5>
                    <button class="btn btn-create pull-right" type=" ">YES<i class="glyphicon glyphicon-pencil"></i></button>
                    <button type="button" class="btn btn-back pull-left"><i class="glyphicon glyphicon-arrow-left"></i><a href="/cevent">NO</a></button> 
                </div>
                </form>
            </div>
        <!-- edit event tab ends here -->

        <!-- delete event tab starts here -->
            <div class="tab-pane fade" id="delete">
                <h3>DELETE EVENT</h3><hr>
                <form class="cbranch" method="POST" action="/delete/event">       
                    {{ csrf_field() }}

                <div class="form-group col-sm-12 {{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-sm-2 control-label ">Country</label>                
                        <div class="col-sm-6 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                            <select class="input-medium bfh-countries form-control" data-country="NG" name="country"  id="inputCountry3" v-model="country" @change=getCountryBranches></select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group col-sm-12">
                        <label for="branch" class="col-sm-2 control-label">Select Branch:</label>
                        <div class="col-sm-6 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <select name="old"  class="form-control"  v-model="activeBranch" @change="getBranchEvents">
                            <option value="0" selected disabled><-- Please choose one --></option>
                            <option v-for="branch in countryBranches" :value="branch.id">@{{branch.name}}</option>
                            <option v-if="countryBranches.length==0" value="">No branch to display</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="event" class="col-sm-2 control-label">Select Event:</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-bookmark"></i></span>
                            <select name="event"  class="form-control" v-model="activeEvent" @change="getActiveEvent">
                            <option value="0" selected disabled><-- Please choose one --></option>
                            <option v-for="event in branchEvents" :value="event.id">@{{event.name}}</option>
                            <option v-if="branchEvents.length==0" value="">No event to display</option>
                            </select>
                        </div>
                    </div>
                
                <div class="col-sm-8">
                    <h5><strong>Delete Forever?</strong></h5>
                    <button class="btn btn-create pull-right" type=" ">YES<i class="glyphicon glyphicon-trash"></i></button>
                    <button type="button" class="btn btn-back pull-left"><i class="glyphicon glyphicon-arrow-left"></i><a href="/cevent">NO</a></button> 
                </div>

                </form>
            </div>
        <!-- delete event tab ends here -->
    </div>
</div>
@endsection