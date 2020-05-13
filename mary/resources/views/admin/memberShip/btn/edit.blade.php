<button   data-toggle="modal" data-target="#edit" class="btn btn-sm btn-success edit"><i class="fa fa-edit"></i> {{_i('edit')}} </button>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{_i('edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('memberships.update',$id)}}" method="post" id="editform">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <?php $membership = \App\Models\Membership::findOrFail($id); ?>
                    <div class="form-group">
                        <label>{{_i('language')}}</label>
                        <select name="language" class="form-control">

                            @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                <option value="{{$key}}">{{$lang}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group">
                        <label>{{_i('title')}}</label>
                        <input type="text" name="title" class="form-control" value="{{$membership->name}}">
                    </div>

                    <div class="form-group">
                        <label>{{_i('cost')}}</label>
                        <input type="number" name="cost" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>{{_i('Duration')}}</label>
                        <input type="number" name="years" class="form-control">{{_i('years')}}
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                <button type="button" class="btn btn-primary" id="edit">{{_i('save')}}</button>
            </div>
        </div>
    </div>
</div>
