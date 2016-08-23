    <div class="tab-pane active" id="summary">
		<div class="row widget-row">
		    <div class="col-md-3">
		        <!-- BEGIN WIDGET THUMB -->
		        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
		            <h4 class="widget-thumb-heading">ASSETS</h4>
		            <div class="widget-thumb-wrap">
		                <i class="widget-thumb-icon bg-green fa fa-plug"></i>
		                <div class="widget-thumb-body">
		                    <span class="widget-thumb-subtitle"></span>
		                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ count($assets) }}">{{ count($assets) }}</span>
		                </div>
		            </div>
		        </div>
		        <!-- END WIDGET THUMB -->
		    </div>
		    <div class="col-md-3">
		        <!-- BEGIN WIDGET THUMB -->
		        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
		            <h4 class="widget-thumb-heading">LICENSES</h4>
		            <div class="widget-thumb-wrap">
		                <i class="widget-thumb-icon bg-red fa fa-barcode"></i>
		                <div class="widget-thumb-body">
		                    <span class="widget-thumb-subtitle"></span>
		                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ count($licenses) }}">{{ count($licenses) }}</span>
		                </div>
		            </div>
		        </div>
		        <!-- END WIDGET THUMB -->
		    </div>
		    <div class="col-md-3">
		        <!-- BEGIN WIDGET THUMB -->
		        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
		            <h4 class="widget-thumb-heading">PROJECTS</h4>
		            <div class="widget-thumb-wrap">
		                <i class="widget-thumb-icon bg-purple icon-bulb"></i>
		                <div class="widget-thumb-body">
		                    <span class="widget-thumb-subtitle"></span>
		                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ count($projects) }}">{{ count($projects) }}</span>
		                </div>
		            </div>
		        </div>
		        <!-- END WIDGET THUMB -->
		    </div>
		    <div class="col-md-3">
		        <!-- BEGIN WIDGET THUMB -->
		        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
		            <h4 class="widget-thumb-heading">USERS</h4>
		            <div class="widget-thumb-wrap">
		                <i class="widget-thumb-icon bg-blue fa fa-users"></i>
		                <div class="widget-thumb-body">
		                    <span class="widget-thumb-subtitle"></span>
		                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{ count($users) }}">{{ count($users) }}</span>
		                </div>
		            </div>
		        </div>
		        <!-- END WIDGET THUMB -->
		    </div>
		</div>
        <div class="row">
			<div class="col-md-8">
				<div class="portlet light portlet-fit bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class=" icon-clock font-green"></i>
							<span class="caption-subject font-green bold uppercase">Total Worked Hours</span>
						</div>
					</div>
					<div class="portlet-body">
						<div id="morris_chart_1" style="height:300px;"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="portlet light portlet-fit bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class=" icon-clock font-green"></i>
							<span class="caption-subject font-green bold uppercase">Assigned Staff</span>
							@access('clientsadmins.create')
							@if (count($admins) > 1)
								<button id="attach_btn" class="btn btn-circle btn-icon-only blue" data-id="{{$client['data']['id']}}">
									<i class="fa fa-plus"></i>
								</button>
							@endif
							@endaccess
						</div>
					</div>
					<div class="portlet-body">
						<!-- BEGIN: Actions -->
						<div class="mt-actions">
						@foreach($assignedAdmins as $admin)
								<div class="mt-action">
									<div class="mt-action-img">
										@if ($admin->avatar && file_exists(avatar_path($admin->avatar)))
											<img src="{!! link_to_avatar($admin->avatar) !!}" width="45">
										@endif
									</div>
									<div class="mt-action-body">
										<div class="mt-action-row">
											<div class="mt-action-info ">
												<div class="mt-action-icon ">
												</div>
												<div class="mt-action-datetime ">
													<span class="mt-action-author">{!! $admin->first_name !!}</span>
													<p class="mt-action-desc">{!! $admin->position !!}</p>
												</div>
											</div>
                                            @access('clientsadmins.create')
											<div class="mt-action-buttons" data-form="detachForm">
												{{ Form::open(['method' => 'DELETE', 'action' => ['Modules\ClientController@detachUser', $client['data']['id'], $admin['id']], 'id' => 'detach_modal']) }}
												{{ Form::close() }}
												<button id="detach_btn" class="btn btn-circle btn-icon-only green"><i class="fa fa-minus"></i></button>
											</div>
                                            @endaccess
										</div>
									</div>
								</div>
						@endforeach
						</div>
					</div>
				</div>
				<div class="portlet light portlet-fit bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class=" icon-clock font-green"></i>
							<span class="caption-subject font-green bold uppercase">Assets by Category</span>
						</div>
					</div>
					<div class="portlet-body">
						<div id="morris_chart_1" style="height:300px;"></div>
					</div>
				</div>
			</div>
		</div>
    </div>


