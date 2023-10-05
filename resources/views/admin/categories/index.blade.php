@extends('admin_layout/master')
@section('content')

<div class="nk-block nk-block-lg">
                    <div class="nk-block-head d-flex justify-content-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Categories List</h4>
                        </div>
                        <div>
                            {{ Breadcrumbs::render('categories') }}
                        </div>
                    </div>
                    <div class="card card-bordered card-preview">
                        <table class="table table-tranx">
                   <thead>
                       <tr class="tb-tnx-head ">
                           <th class="tb-tnx-id"><span class="">#</span></th>
                           <th class="tb-tnx-info text-center">
                               <span class="tb-tnx-desc d-none d-sm-inline-block">
                                   <span>Name</span>
                               </span>
                           </th>
                           <th class="tb-tnx-info text-center">
                               <span class="tb-tnx-desc d-none d-sm-inline-block">
                                   <span>Slug</span>
                               </span>
                           </th>
                           <th class="tb-tnx-info text-center">
                               <span class="tb-tnx-desc d-none d-sm-inline-block">
                                   <span>Parent Category</span>
                               </span>
                           </th>
                           <th class="tb-tnx-action text-center">
                               <span>Action</span>
                           </th>
                       </tr>
                   </thead>
                   <tbody>
                    <?php $count = 1 ?>
                    @foreach($categories as $cat)
                    
                       <tr class="tb-tnx-item">
                           <td class="tb-tnx-id text-center">
                               <a href="#"><span>{{ $count++ }}</span></a>
                           </td>
                           <td class="tb-tnx-info text-center">
                               <div class="tb-tnx-desc">
                                   <span class="title">{{ $cat->name ?? '' }}</span>
                               </div>
                           </td>
                           <td class="tb-tnx-info text-center">
                               <div class="tb-tnx-desc">
                                   <span class="title">{{ $cat->slug ?? '' }}</span>
                               </div>
                           </td>
                           <td class="tb-tnx-info text-center">
                               <div class="tb-tnx-desc">
                                   <span class="title">{{ $cat->parent['name'] ?? '-' }}</span>
                               </div>
                           </td>
                           <td class="tb-tnx-amount is-alt text-center">
                         
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="{{ url('/admin-dashboard/categories-list/add-new/') }}/{{ $cat->slug }}">Edit</a></li>
                                        <li><a href="{{ url('/admin-dashboard/categories-list/delete') }}/{{ $cat->id }}">delete</a></li>
                                    </ul>
                                </div>
                            </div>
                           </td>
                          
                       </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>
  </div>
                                    
@endsection