@extends('layout.main')
@section('content')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Group Permission')}}</h4>
                    </div>
                    {!! Form::open(['route' => 'role.setPermission', 'method' => 'post']) !!}
                    <div class="card-body">
                    	<input type="hidden" name="role_id" value="{{$lims_role_data->id}}" />
						<div class="table-responsive">
						    <table class="table table-bordered permission-table">
						        <thead>
						        <tr>
						            <th colspan="6" class="text-center">{{$lims_role_data->name}} {{trans('file.Group Permission')}}</th>
						        </tr>
						        <tr>
						            <th rowspan="2" class="text-center">Module Name</th>
						            <th colspan="5" class="text-center">
						            	<div class="checkbox">
						            		<input type="checkbox" id="select_all">
						            		<label for="select_all">{{trans('file.Permissions')}}</label>
						            	</div>
						            </th>
						        </tr>
						        <tr>
						            <th class="text-center">{{trans('file.View')}}</th>
						            <th class="text-center">{{trans('file.add')}}</th>
						            <th class="text-center">{{trans('file.edit')}}</th>
						            <th class="text-center">{{trans('file.delete')}}</th>
						            <th class="text-center">{{trans('file.Miscellaneous')}}</th>
						        </tr>
						        </thead>
						        <tbody>
						        <tr>
						            {{-- <td></td> --}}
                                    <td >
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("master-parent", $all_permission))
								                <input type="checkbox" value="1" id="master-parent" name="master-parent" checked />
								                @else
								                <input type="checkbox" value="1" id="master-parent" name="master-parent" />
								                @endif
								                <label for="master-parent">
                                                    {{trans('file.Master')}}
                                                </label>
							            	</div>
						            	</div>
						            </td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if(in_array("master-parent", $all_permission))
                                                        @if(in_array("category", $all_permission))
                                                        <input type="checkbox" value="1" id="category" name="category" checked>
                                                        @else
                                                        <input type="checkbox" value="1" id="category" name="category">
                                                        @endif
                                                        <label for="category" class="padding05">{{trans('file.Product Category')}} &nbsp;&nbsp;</label>
                                                    @else
                                                        @if(in_array("category", $all_permission))
                                                        <input type="checkbox" value="1" id="category" name="category" checked disabled>
                                                        @else
                                                        <input type="checkbox" value="1" id="category" name="category" disabled>
                                                        @endif
                                                        <label for="category" class="padding05">{{trans('file.Product Category')}} &nbsp;&nbsp;</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
                                                    @if(in_array("master-parent", $all_permission))
                                                        @if(in_array("master-tagging", $all_permission))
                                                        <input type="checkbox" value="1" id="master-tagging" name="master-tagging" checked>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-tagging" name="master-tagging">
                                                        @endif
                                                        <label for="master-tagging" class="padding05">{{ __('file.Tagging Type')}} &nbsp;&nbsp;</label>
                                                    @else
                                                        @if(in_array("master-tagging", $all_permission))
                                                        <input type="checkbox" value="1" id="master-tagging" name="master-tagging" checked disabled>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-tagging" name="master-tagging" disabled>
                                                        @endif
                                                        <label for="master-tagging" class="padding05">{{ __('file.Tagging Type')}} &nbsp;&nbsp;</label>
                                                    @endif
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
                                                    @if(in_array("master-parent", $all_permission))
                                                        @if(in_array("master-product-property", $all_permission))
                                                        <input type="checkbox" value="1" id="master-product-property" name="master-product-property" checked>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-product-property" name="master-product-property">
                                                        @endif
                                                        <label for="master-product-property" class="padding05">{{__('file.Product Property')}} &nbsp;&nbsp;</label>
                                                    @else
                                                        @if(in_array("master-product-property", $all_permission))
                                                        <input type="checkbox" value="1" id="master-product-property" name="master-product-property" checked disabled>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-product-property" name="master-product-property" disabled>
                                                        @endif
                                                        <label for="master-product-property" class="padding05">{{__('file.Product Property')}} &nbsp;&nbsp;</label>
                                                    @endif
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
                                                    @if(in_array("master-parent", $all_permission))
                                                        @if(in_array("master-product-tipe", $all_permission))
                                                        <input type="checkbox" value="1" id="master-product-tipe" name="master-product-tipe" checked>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-product-tipe" name="master-product-tipe">
                                                        @endif
                                                        <label for="master-product-tipe" class="padding05">{{__('file.Product Type')}} &nbsp;&nbsp;</label>
                                                    @else
                                                        @if(in_array("master-product-tipe", $all_permission))
                                                        <input type="checkbox" value="1" id="master-product-tipe" name="master-product-tipe" checked disabled>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-product-tipe" name="master-product-tipe" disabled>
                                                        @endif
                                                        <label for="master-product-tipe" class="padding05">{{__('file.Product Type')}} &nbsp;&nbsp;</label>
                                                    @endif

								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
                                                    @if(in_array("master-parent", $all_permission))
                                                        @if(in_array("master-gramasi", $all_permission))
                                                        <input type="checkbox" value="1" id="master-gramasi" name="master-gramasi" checked>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-gramasi" name="master-gramasi">
                                                        @endif
                                                        <label for="master-gramasi" class="padding05">{{ __('file.Gramasi List')}} &nbsp;&nbsp;</label>
                                                    @else
                                                        @if(in_array("master-gramasi", $all_permission))
                                                        <input type="checkbox" value="1" id="master-gramasi" name="master-gramasi" checked disabled>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-gramasi" name="master-gramasi" disabled>
                                                        @endif
                                                        <label for="master-gramasi" class="padding05">{{ __('file.Gramasi List')}} &nbsp;&nbsp;</label>
                                                    @endif
								                </div>
								            </div>
						                </span>
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if(in_array("master-parent", $all_permission))
                                                        @if(in_array("master-price", $all_permission))
                                                            <input type="checkbox" value="1" id="master-price" name="master-price" checked>
                                                        @else
                                                            <input type="checkbox" value="1" id="master-price" name="master-price">
                                                        @endif
                                                        <label for="master-price" class="padding05">{{__('file.Price')}} &nbsp;&nbsp;</label>
                                                    @else
                                                        @if(in_array("master-price", $all_permission))
                                                            <input type="checkbox" value="1" id="master-price" name="master-price" checked disabled>
                                                        @else
                                                            <input type="checkbox" value="1" id="master-price" name="master-price" disabled>
                                                        @endif
                                                        <label for="master-price" class="padding05">{{__('file.Price')}} &nbsp;&nbsp;</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
                                                    @if(in_array("master-parent", $all_permission))
                                                        @if(in_array("master-promo", $all_permission))
                                                        <input type="checkbox" value="1" id="master-promo" name="master-promo" checked>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-promo" name="master-promo">
                                                        @endif
                                                        <label for="master-promo" class="padding05">{{__('file.promo')
                                                        }} &nbsp;&nbsp;</label>
                                                    @else
                                                        @if(in_array("master-promo", $all_permission))
                                                        <input type="checkbox" value="1" id="master-promo" name="master-promo" checked disabled>
                                                        @else
                                                        <input type="checkbox" value="1" id="master-promo" name="master-promo" disabled>
                                                        @endif
                                                        <label for="master-promo" class="padding05">{{__('file.promo')
                                                        }} &nbsp;&nbsp;</label>
                                                    @endif
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr>
						        <tr>
						            {{-- <td></td> --}}
                                    <td >
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                                @if(in_array("product-stock-parent", $all_permission))
                                                <input type="checkbox" value="1" id="product-stock-parent" name="product-stock-parent" checked />
                                                @else
                                                <input type="checkbox" value="1" id="product-stock-parent" name="product-stock-parent" />
                                                @endif
                                                <label for="product-stock-parent">
                                                    {{trans('file.product_stock')}}
                                                </label>
							            	</div>
						            	</div>
						            </td>
                                    <td class="product-stock-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if(in_array("master-parent", $all_permission))
                                                        @if(in_array("product-stock", $all_permission))
                                                        <input type="checkbox" value="1" id="product-stock" name="product-stock" checked>
                                                        @else
                                                        <input type="checkbox" value="1" id="product-stock" name="product-stock">
                                                        @endif
                                                        <label for="product-stock" class="padding05">{{trans('file.product_stock')}} &nbsp;&nbsp;</label>
                                                    @else
                                                        @if(in_array("product-stock", $all_permission))
                                                        <input type="checkbox" value="1" id="product-stock" name="product-stock" checked disabled>
                                                        @else
                                                        <input type="checkbox" value="1" id="product-stock" name="product-stock" disabled>
                                                        @endif
                                                        <label for="product-stock" class="padding05">{{trans('file.product_stock')}} &nbsp;&nbsp;</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </span>
						            </td>
						        </tr>
						        <tr>
						            {{-- <td></td> --}}
                                    <td >
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("products-parent", $all_permission))
								                <input type="checkbox" value="1" id="products-parent" name="products-parent" checked />
								                @else
								                <input type="checkbox" value="1" id="products-parent" name="products-parent" />
								                @endif
								                <label for="products-parent">
                                                    {{trans('file.product')}}
                                                </label>
							            	</div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                                @if(in_array("products-parent", $all_permission))
                                                    @if(in_array("products-index", $all_permission))
                                                    <input type="checkbox" value="1" id="products-index" name="products-index" checked />
                                                    @else
                                                    <input type="checkbox" value="1" id="products-index" name="products-index" />
                                                    @endif
                                                    <label for="products-index"></label>
                                                @else
                                                    @if(in_array("products-index", $all_permission))
                                                    <input type="checkbox" value="1" id="products-index" name="products-index" checked disabled/>
                                                    @else
                                                    <input type="checkbox" value="1" id="products-index" name="products-index" disabled/>
                                                    @endif
                                                    <label for="products-index"></label>
                                                @endif
							            	</div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                                @if(in_array("products-parent", $all_permission))
                                                    @if(in_array("products-add", $all_permission))
                                                    <input type="checkbox" value="1" id="products-add" name="products-add" checked>
                                                    @else
                                                    <input type="checkbox" value="1" id="products-add" name="products-add">
                                                    @endif
                                                    <label for="products-add"></label>
                                                @else
                                                    @if(in_array("products-add", $all_permission))
                                                    <input type="checkbox" value="1" id="products-add" name="products-add" checked disabled>
                                                    @else
                                                    <input type="checkbox" value="1" id="products-add" name="products-add" disabled>
                                                    @endif
                                                    <label for="products-add"></label>
                                                @endif
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                                @if(in_array("products-parent", $all_permission))
                                                    @if(in_array("action-edit", $all_permission))
                                                    <input type="checkbox" value="1" id="action-edit" name="action-edit" checked />
                                                    @else
                                                    <input type="checkbox" value="1" id="action-edit" name="action-edit" />
                                                    @endif
                                                    <label for="action-edit"></label>
                                                @else
                                                    @if(in_array("action-edit", $all_permission))
                                                    <input type="checkbox" value="1" id="action-edit" name="action-edit" checked disabled/>
                                                    @else
                                                    <input type="checkbox" value="1" id="action-edit" name="action-edit" disabled/>
                                                    @endif
                                                    <label for="action-edit"></label>
                                                @endif
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                                @if(in_array("products-parent", $all_permission))
                                                    @if(in_array("action-delete", $all_permission))
                                                    <input type="checkbox" value="1" id="action-delete" name="action-delete" checked />
                                                    @else
                                                    <input type="checkbox" value="1" id="action-delete" name="action-delete" />
                                                    @endif
                                                    <label for="action-delete"></label>
                                                @else
                                                    @if(in_array("action-delete", $all_permission))
                                                    <input type="checkbox" value="1" id="action-delete" name="action-delete" checked disabled/>
                                                    @else
                                                    <input type="checkbox" value="1" id="action-delete" name="action-delete" disabled/>
                                                    @endif
                                                    <label for="action-delete"></label>
                                                @endif
							                </div>
							            </div>
						            </td>
                                    <td>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("warehouse-transfer", $all_permission))
							                    	<input type="checkbox" value="1" id="warehouse-transfer" name="warehouse-transfer" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="warehouse-transfer" name="warehouse-transfer">
							                    	@endif
								                    <label for="warehouse-transfer" class="padding05">{{trans('file.warehouse_transfer')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("action-parent", $all_permission))
							                    	<input type="checkbox" value="1" id="action-parent" name="action-parent" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="action-parent" name="action-parent">
							                    	@endif
								                    <label for="action-parent" class="padding05">{{trans('file.action')}} {{ trans('file.product') }} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                    </td>
						        </tr>

                                {{-- HIDE ACM PURCHASE --}}
						        {{-- <tr>
						            <td>{{trans('file.Purchase')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("purchases-index", $all_permission))
								                <input type="checkbox" value="1" id="purchases-index" name="purchases-index" checked>
								                @else
								                <input type="checkbox" value="1" id="purchases-index" name="purchases-index">
								                @endif
								                <label for="purchases-index"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("purchases-add", $all_permission))
								                <input type="checkbox" value="1" id="purchases-add" name="purchases-add" checked>
								                @else
								                <input type="checkbox" value="1" id="purchases-add" name="purchases-add">
								                @endif
								                <label for="purchases-add"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("purchases-edit", $all_permission))
								                <input type="checkbox" value="1" id="purchases-edit" name="purchases-edit" checked />
								                @else
								                <input type="checkbox" value="1" id="purchases-edit" name="purchases-edit">
								                @endif
								                <label for="purchases-edit"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("purchases-delete", $all_permission))
								                <input type="checkbox" value="1" id="purchases-delete" name="purchases-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="purchases-delete" name="purchases-delete">
								                @endif
								                <label for="purchases-delete"></label>
							            	</div>
						            	</div>
						            </td>
						        </tr> --}}

						        <tr>
                                    <td >
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("sales-parent", $all_permission))
								                <input type="checkbox" value="1" id="sales-parent" name="sales-parent" checked />
								                @else
								                <input type="checkbox" value="1" id="sales-parent" name="sales-parent" />
								                @endif
								                <label for="sales-parent">
                                                    {{trans('file.Sale')}}
                                                </label>
							            	</div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                            @if(in_array("sales-parent", $all_permission))
								                @if(in_array("sales-index", $all_permission))
								                <input type="checkbox" value="1" id="sales-index" name="sales-index" checked />
								                @else
								                <input type="checkbox" value="1" id="sales-index" name="sales-index">
								                @endif
								                <label for="sales-index"></label>
                                            @else
                                                @if(in_array("sales-index", $all_permission))
                                                <input type="checkbox" value="1" id="sales-index" name="sales-index" checked disabled/>
                                                @else
                                                <input type="checkbox" value="1" id="sales-index" name="sales-index" disabled>
                                                @endif
                                                <label for="sales-index"></label>
                                            @endif
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                            @if(in_array("sales-parent", $all_permission))
								                @if(in_array("sales-add", $all_permission))
								                <input type="checkbox" value="1" id="sales-add" name="sales-add" checked />
								                @else
								                <input type="checkbox" value="1" id="sales-add" name="sales-add">
								                @endif
								                <label for="sales-add"></label>
                                            @else
								                @if(in_array("sales-add", $all_permission))
								                <input type="checkbox" value="1" id="sales-add" name="sales-add" checked disabled/>
								                @else
								                <input type="checkbox" value="1" id="sales-add" name="sales-add" disabled>
								                @endif
								                <label for="sales-add"></label>
                                            @endif
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                            @if(in_array("sales-parent", $all_permission))
								                @if(in_array("sales-edit", $all_permission))
								                <input type="checkbox" value="1" id="sales-edit" name="sales-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="sales-edit" name="sales-edit">
								                @endif
								                <label for="sales-edit"></label>
                                            @else
								                @if(in_array("sales-edit", $all_permission))
								                <input type="checkbox" value="1" id="sales-edit" name="sales-edit" checked disabled>
								                @else
								                <input type="checkbox" value="1" id="sales-edit" name="sales-edit" disabled>
								                @endif
								                <label for="sales-edit"></label>
                                            @endif
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                            @if(in_array("sales-parent", $all_permission))
								                @if(in_array("sales-delete", $all_permission))
								                <input type="checkbox" value="1" id="sales-delete" name="sales-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="sales-delete" name="sales-delete">
								                @endif
								                <label for="sales-delete"></label>
                                            @else
                                                @if(in_array("sales-delete", $all_permission))
                                                <input type="checkbox" value="1" id="sales-delete" name="sales-delete" checked disabled>
                                                @else
                                                <input type="checkbox" value="1" id="sales-delete" name="sales-delete" disabled>
                                                @endif
                                                <label for="sales-delete"></label>
                                            @endif
								            </div>
						            	</div>
						            </td>
						        </tr>

						        {{-- <tr>
						            <td>{{trans('file.Expense')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("expenses-index", $all_permission))
								                <input type="checkbox" value="1" id="expenses-index" name="expenses-index" checked />
								                @else
								                <input type="checkbox" value="1" id="expenses-index" name="expenses-index">
								                @endif
								                <label for="expenses-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("expenses-add", $all_permission))
								                <input type="checkbox" value="1" id="expenses-add" name="expenses-add" checked />
								                @else
								                <input type="checkbox" value="1" id="expenses-add" name="expenses-add">
								                @endif
								                <label for="expenses-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("expenses-edit", $all_permission))
								                <input type="checkbox" value="1" id="expenses-edit" name="expenses-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="expenses-edit" name="expenses-edit">
								                @endif
								                <label for="expenses-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("expenses-delete", $all_permission))
								                <input type="checkbox" value="1" id="expenses-delete" name="expenses-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="expenses-delete" name="expenses-delete">
								                @endif
								                <label for="expenses-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr> --}}

						        {{-- <tr>
						            <td>{{trans('file.Quotation')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("quotes-index", $all_permission))
								                <input type="checkbox" value="1" id="quotes-index" name="quotes-index" checked>
								                @else
								                <input type="checkbox" value="1" id="quotes-index" name="quotes-index">
								                @endif
								                <label for="quotes-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("quotes-add", $all_permission))
								                <input type="checkbox" value="1" id="quotes-add" name="quotes-add" checked>
								                @else
								                <input type="checkbox" value="1" id="quotes-add" name="quotes-add">
								                @endif
								                <label for="quotes-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("quotes-edit", $all_permission))
								                <input type="checkbox" value="1" id="quotes-edit" name="quotes-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="quotes-edit" name="quotes-edit">
								                @endif
								                <label for="quotes-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("quotes-delete", $all_permission))
								                <input type="checkbox" value="1" id="quotes-delete" name="quotes-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="quotes-delete" name="quotes-delete">
								                @endif
								                <label for="quotes-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr> --}}

						        {{-- <tr>
						            <td>{{trans('file.Transfer')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("transfers-index", $all_permission))
								                <input type="checkbox" value="1" id="transfers-index" name="transfers-index" checked>
								                @else
								                <input type="checkbox" value="1" id="transfers-index" name="transfers-index">
								                @endif
								                <label for="transfers-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("transfers-add", $all_permission))
								                <input type="checkbox" value="1" id="transfers-add" name="transfers-add" checked>
								                @else
								                <input type="checkbox" value="1" id="transfers-add" name="transfers-add">
								                @endif
								                <label for="transfers-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("transfers-edit", $all_permission))
								                <input type="checkbox" value="1" id="transfers-edit" name="transfers-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="transfers-edit" name="transfers-edit">
								                @endif
								                <label for="transfers-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("transfers-delete", $all_permission))
								                <input type="checkbox" value="1" id="transfers-delete" name="transfers-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="transfers-delete" name="transfers-delete">
								                @endif
								                <label for="transfers-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr> --}}
{{--
						        <tr>
						            <td>{{trans('file.Sale Return')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("returns-index", $all_permission))
								                <input type="checkbox" value="1" id="returns-index" name="returns-index" checked>
								                @else
								                <input type="checkbox" value="1" id="returns-index" name="returns-index">
								                @endif
								                <label for="returns-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("returns-add", $all_permission))
								                <input type="checkbox" value="1" id="returns-add" name="returns-add" checked>
								                @else
								                <input type="checkbox" value="1" id="returns-add" name="returns-add">
								                @endif
								                <label for="returns-add"></label>
							                </div>
							            </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("returns-edit", $all_permission))
								                <input type="checkbox" value="1" id="returns-edit" name="returns-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="returns-edit" name="returns-edit">
								                @endif
								                <label for="returns-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("returns-delete", $all_permission))
								                <input type="checkbox" value="1" id="returns-delete" name="returns-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="returns-delete" name="returns-delete">
								                @endif
								                <label for="returns-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr> --}}
						        <tr>
						            <td>{{trans('file.buy back')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("buyback-edit", $all_permission))
								                <input type="checkbox" value="1" id="buyback-edit" name="buyback-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="buyback-edit" name="buyback-edit">
								                @endif
								                <label for="buyback-edit"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>

						        {{-- <tr>
						            <td>{{trans('file.Purchase Return')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("purchase-return-index", $all_permission))
								                <input type="checkbox" value="1" id="purchase-return-index" name="purchase-return-index" checked>
								                @else
								                <input type="checkbox" value="1" id="purchase-return-index" name="purchase-return-index">
								                @endif
								                <label for="purchase-return-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("purchase-return-add", $all_permission))
								                <input type="checkbox" value="1" id="purchase-return-add" name="purchase-return-add" checked>
								                @else
								                <input type="checkbox" value="1" id="purchase-return-add" name="purchase-return-add">
								                @endif
								                <label for="purchase-return-add"></label>
								            </div>
						                </div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("purchase-return-edit", $all_permission))
								                <input type="checkbox" value="1" id="purchase-return-edit" name="purchase-return-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="purchase-return-edit" name="purchase-return-edit">
								                @endif
								                <label for="purchase-return-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
						                	<div class="checkbox">
								                @if(in_array("purchase-return-delete", $all_permission))
								                <input type="checkbox" value="1" id="purchase-return-delete" name="purchase-return-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="purchase-return-delete" name="purchase-return-delete">
								                @endif
								                <label for="purchase-return-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr> --}}
						        {{-- <tr>
						            <td>{{trans('file.Employee')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("employees-index", $all_permission))
								                <input type="checkbox" value="1" id="employees-index" name="employees-index" checked>
								                @else
								                <input type="checkbox" value="1" id="employees-index" name="employees-index">
								                @endif
								                <label for="employees-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("employees-add", $all_permission))
								                <input type="checkbox" value="1" id="employees-add" name="employees-add" checked>
								                @else
								                <input type="checkbox" value="1" id="employees-add" name="employees-add">
								                @endif
								                <label for="employees-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("employees-edit", $all_permission))
								                <input type="checkbox" value="1" id="employees-edit" name="employees-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="employees-edit" name="employees-edit">
								                @endif
								                <label for="employees-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("employees-delete", $all_permission))
								                <input type="checkbox" value="1" id="employees-delete" name="employees-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="employees-delete" name="employees-delete">
								                @endif
								                <label for="employees-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr> --}}
						        <tr>
						            <td>
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("users-parent", $all_permission))
								                <input type="checkbox" value="1" id="users-parent" name="users-parent" checked />
								                @else
								                <input type="checkbox" value="1" id="users-parent" name="users-parent" />
								                @endif
								                <label for="users-parent">
                                                    {{trans('file.User')}}
                                                </label>
							            	</div>
						            	</div>
                                    </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                            @if(in_array("users-parent", $all_permission))
								                @if(in_array("users-index", $all_permission))
								                <input type="checkbox" value="1" id="users-index" name="users-index" checked>
								                @else
								                <input type="checkbox" value="1" id="users-index" name="users-index">
								                @endif
								                <label for="users-index"></label>
                                            @else
								                @if(in_array("users-index", $all_permission))
								                <input type="checkbox" value="1" id="users-index" name="users-index" checked disabled>
								                @else
								                <input type="checkbox" value="1" id="users-index" name="users-index" disabled>
								                @endif
								                <label for="users-index"></label>
                                            @endif
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                            @if(in_array("users-parent", $all_permission))
								                @if(in_array("users-add", $all_permission))
								                <input type="checkbox" value="1" id="users-add" name="users-add" checked>
								                @else
								                <input type="checkbox" value="1" id="users-add" name="users-add">
								                @endif
								                <label for="users-add"></label>
                                            @else
								                @if(in_array("users-add", $all_permission))
								                <input type="checkbox" value="1" id="users-add" name="users-add" checked disabled>
								                @else
								                <input type="checkbox" value="1" id="users-add" name="users-add" disabled>
								                @endif
								                <label for="users-add"></label>
                                            @endif
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                            @if(in_array("users-parent", $all_permission))
								                @if(in_array("users-edit", $all_permission))
								                <input type="checkbox" value="1" id="users-edit" name="users-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="users-edit" name="users-edit">
								                @endif
								                <label for="users-edit"></label>
                                            @else
                                                @if(in_array("users-edit", $all_permission))
                                                <input type="checkbox" value="1" id="users-edit" name="users-edit" checked disabled>
                                                @else
                                                <input type="checkbox" value="1" id="users-edit" name="users-edit" disabled>
                                                @endif
                                                <label for="users-edit"></label>
                                            @endif
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                            @if(in_array("users-parent", $all_permission))
								                @if(in_array("users-delete", $all_permission))
								                <input type="checkbox" value="1" id="users-delete" name="users-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="users-delete" name="users-delete">
								                @endif
								                <label for="users-delete"></label>
                                            @else
								                @if(in_array("users-delete", $all_permission))
								                <input type="checkbox" value="1" id="users-delete" name="users-delete" checked disabled>
								                @else
								                <input type="checkbox" value="1" id="users-delete" name="users-delete" disabled>
								                @endif
								                <label for="users-delete"></label>
                                            @endif
								            </div>
						            	</div>
						            </td>
						        </tr>
						        {{-- <tr>
						            <td>{{trans('file.customer')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("customers-index", $all_permission))
								                <input type="checkbox" value="1" id="customers-index" name="customers-index" checked>
								                @else
								                <input type="checkbox" value="1" id="customers-index" name="customers-index">
								                @endif
								                <label for="customers-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("customers-add", $all_permission))
								                <input type="checkbox" value="1" id="customers-add" name="customers-add" checked>
								                @else
								                <input type="checkbox" value="1" id="customers-add" name="customers-add">
								                @endif
								                <label for="customers-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("customers-edit", $all_permission))
								                <input type="checkbox" value="1" id="customers-edit" name="customers-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="customers-edit" name="customers-edit">
								                @endif
								                <label for="customers-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("customers-delete", $all_permission))
								                <input type="checkbox" value="1" id="customers-delete" name="customers-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="customers-delete" name="customers-delete">
								                @endif
								                <label for="customers-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        <tr>
						            <td>{{trans('file.Biller')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("billers-index", $all_permission))
								                <input type="checkbox" value="1" id="billers-index" name="billers-index" checked>
								                @else
								                <input type="checkbox" value="1" id="billers-index" name="billers-index">
								                @endif
								                <label for="billers-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("billers-add", $all_permission))
								                <input type="checkbox" value="1" id="billers-add" name="billers-add" checked>
								                @else
								                <input type="checkbox" value="1" id="billers-add" name="billers-add">
								                @endif
								                <label for="billers-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("billers-edit", $all_permission))
								                <input type="checkbox" value="1" id="billers-edit" name="billers-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="billers-edit" name="billers-edit">
								                @endif
								                <label for="billers-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("billers-delete", $all_permission))
								                <input type="checkbox" value="1" id="billers-delete" name="billers-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="billers-delete" name="billers-delete">
								                @endif
								                <label for="billers-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        <tr>
						            <td>{{trans('file.Supplier')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("suppliers-index", $all_permission))
								                <input type="checkbox" value="1" id="suppliers-index" name="suppliers-index" checked>
								                @else
								                <input type="checkbox" value="1" id="suppliers-index" name="suppliers-index">
								                @endif
								                <label for="suppliers-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("suppliers-add", $all_permission))
								                <input type="checkbox" value="1" id="suppliers-add" name="suppliers-add" checked>
								                @else
								                <input type="checkbox" value="1" id="suppliers-add" name="suppliers-add">
								                @endif
								                <label for="suppliers-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("suppliers-edit", $all_permission))
								                <input type="checkbox" value="1" id="suppliers-edit" name="suppliers-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="suppliers-edit" name="suppliers-edit">
								                @endif
								                <label for="suppliers-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("suppliers-delete", $all_permission))
								                <input type="checkbox" value="1" id="suppliers-delete" name="suppliers-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="suppliers-delete" name="suppliers-delete">
								                @endif
								                <label for="suppliers-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        						        <tr>
						            <td>{{trans('file.Accounting')}}</td>
						            <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("account-index", $all_permission))
							                    	<input type="checkbox" value="1" id="account-index" name="account-index" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="account-index" name="account-index">
							                    	@endif
								                    <label for="account-index" class="padding05">{{trans('file.Account')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("money-transfer", $all_permission))
							                    	<input type="checkbox" value="1" id="money-transfer" name="money-transfer" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="money-transfer" name="money-transfer">
							                    	@endif
								                    <label for="money-transfer" class="padding05">{{trans('file.Money Transfer')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("balance-sheet", $all_permission))
							                    	<input type="checkbox" value="1" id="balance-sheet" name="balance-sheet" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="balance-sheet" name="balance-sheet">
							                    	@endif
								                    <label for="balance-sheet" class="padding05">{{trans('file.Balance Sheet')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
						                    	<div class="checkbox">
							                    	@if(in_array("account-statement", $all_permission))
							                    	<input type="checkbox" value="1" id="account-statement-permission" name="account-statement" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="account-statement-permission" name="account-statement">
							                    	@endif
								                    <label for="account-statement-permission" class="padding05">{{trans('file.Account Statement')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr> --}}
						        {{-- <tr>
						            <td>HRM</td>
						            <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("department", $all_permission))
							                    	<input type="checkbox" value="1" id="department" name="department" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="department" name="department">
							                    	@endif
								                    <label for="department" class="padding05">{{trans('file.Department')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("attendance", $all_permission))
							                    	<input type="checkbox" value="1" id="attendance" name="attendance" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="attendance" name="attendance">
							                    	@endif
								                    <label for="attendance" class="padding05">{{trans('file.Attendance')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("payroll", $all_permission))
							                    	<input type="checkbox" value="1" id="payroll" name="payroll" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="payroll" name="payroll">
							                    	@endif
								                    <label for="payroll" class="padding05">{{trans('file.Payroll')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("holiday", $all_permission))
							                    	<input type="checkbox" value="1" id="holiday" name="holiday" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="holiday" name="holiday">
							                    	@endif
								                    <label for="holiday" class="padding05">{{trans('file.Holiday Approve')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr> --}}
                                <tr>
						            {{-- <td></td> --}}
                                    <td >
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
                                                @if(in_array("report-parent", $all_permission))
                                                <input type="checkbox" value="1" id="report-parent" name="report-parent" checked />
                                                @else
                                                <input type="checkbox" value="1" id="report-parent" name="report-parent" />
                                                @endif
                                                <label for="report-parent">
                                                    {{trans('file.Reports')}}
                                                </label>
							            	</div>
						            	</div>
						            </td>
                                    <td class="report-permissions" colspan="5">
                                        <span>
                                            <div aria-checked="false" aria-disabled="false">
                                                <div class="checkbox">
                                                    @if(in_array("report-parent", $all_permission))
                                                        @if(in_array("purchase-report", $all_permission))
                                                        <input type="checkbox" value="1" id="purchase-report" name="purchase-report" checked>
                                                        @else
                                                        <input type="checkbox" value="1" id="purchase-report" name="purchase-report">
                                                        @endif
                                                        <label for="purchase-report" class="padding05">{{trans('file.sale_report')}} &nbsp;&nbsp;</label>
                                                    @else
                                                        @if(in_array("purchase-report", $all_permission))
                                                        <input type="checkbox" value="1" id="purchase-report" name="purchase-report" checked disabled>
                                                        @else
                                                        <input type="checkbox" value="1" id="purchase-report" name="purchase-report" disabled>
                                                        @endif
                                                        <label for="purchase-report" class="padding05">{{trans('file.sale_report')}} &nbsp;&nbsp;</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </span>
						            </td>
						        </tr>
						        <tr>
						            <td>{{trans('file.settings')}}</td>
						            <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("warehouse", $all_permission))
							                    	<input type="checkbox" value="1" id="warehouse" name="warehouse" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="warehouse" name="warehouse">
							                    	@endif
								                    <label for="warehouse" class="padding05">{{trans('file.Warehouse')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("customer_group", $all_permission))
							                    	<input type="checkbox" value="1" id="customer_group" name="customer_group" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="customer_group" name="customer_group">
							                    	@endif
								                    <label for="customer_group" class="padding05">{{trans('file.Customer Group')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
								            <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("tax", $all_permission))
							                    	<input type="checkbox" value="1" id="tax" name="tax" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="tax" name="tax">
							                    	@endif
								                    <label for="tax" class="padding05">{{trans('file.Tax')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						                <span>
								            <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("general_setting", $all_permission))
							                    	<input type="checkbox" value="1" id="general_setting" name="general_setting" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="general_setting" name="general_setting">
							                    	@endif
								                    <label for="general_setting" class="padding05">{{trans('file.General Setting')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr>
                                <tr>

                                </tr>
						        </tbody>
						    </table>
						</div>
						<div class="form-group">
	                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
	                    </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

	$("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #role-menu").addClass("active");

	$("#select_all").on("change", function() {
        if ($(this).is(':checked')) {
            $("tbody input[type='checkbox']:enabled").prop('checked', true);
        } else {
            $("tbody input[type='checkbox']:enabled").prop('checked', false);
        }
    });

</script>
@endsection
